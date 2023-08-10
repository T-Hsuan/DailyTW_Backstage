<template>
    <div class="main_content">
        <h3>景點類型新增</h3>
        <form method="post" @submit="submitForm">
            <div class="form_container">
                <!-- 表單欄位用 label 包 -->
                <label for="place_tag_name">
                    <span>景點類型</span>
                    <input type="text" name="place_tag_name" id="place_tag_name" v-model="place_tag_name">
                </label>
                <label for="place_tag_desc">
                    <span>描述</span>
                    <textarea name="place_tag_desc" id="place_tag_desc" rows="10" v-model="place_tag_desc"></textarea>
                </label>
            </div>
            <!-- 次頁右下角統一用取消及儲存按鈕 -->
            <div class="btn_wrap">
                <router-link to="/place_tag">
                    <button class="cancel_btn">取消</button>
                </router-link>
                <button class="btn" type="submit" :disabled="!formValid">儲存</button>
            </div>
        </form>
    </div>
</template>

<script>
import  axios  from "axios";

export default {
    data() {
        return {
            place_tag_name: '',
            place_tag_desc: '',
        }
    },
    computed:{
        formValid(){
            return(
                this.place_tag_name !== '' &&
                this.place_tag_desc !== ''
            )
        }
    },
    methods: {
        async submitForm(event) {
            event.preventDefault();
            try {
                console.log('Sending request...');
                const formData = new FormData();
                formData.append('place_tag_name', this.place_tag_name);
                formData.append('place_tag_desc', this.place_tag_desc);

                const response = await axios.post(`${this.$URL}/PlaceTagAdd.php`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data', // Use multipart/form-data for form data
                    },
                });
                window.alert('新增成功!');
                console.log('Data sent successfully', response.data);
                
                // Redirect to the "/place_tag" page
                this.$router.push('/place_tag');

            } catch (error) {
                console.log(error);
            }
        }
    },
};
</script>