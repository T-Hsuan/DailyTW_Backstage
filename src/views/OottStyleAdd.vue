<template>
    <div class="main_content">
        <h3>穿搭類型新增</h3>
        <form method="post" @submit="submitForm">
            <div class="form_container">
                <!-- 表單欄位用 label 包 -->
                <label for="oott_tag_name">
                    <span>穿搭類型</span>
                    <input type="text" name="oott_tag_name" id="oott_tag_name" v-model="style_name" />
                </label>
                <label for="oott_tag_desc">
                    <span>描述</span>
                    <textarea name="oott_tag_desc" id="oott_tag_desc" rows="10" v-model="style_desc"></textarea>
                </label>
            </div>
            <!-- 次頁右下角統一用取消及儲存按鈕 -->
            <div class="btn_wrap">
                <router-link to="/style_mgt">
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
            style_name: '',
            style_desc: '',
        }
    },
    computed:{
        formValid(){
            return(
                this.style_name !== ''&&
                this.style_desc !== ''
            )
        }
    },
    methods: {
        async submitForm(event) {
            event.preventDefault();
            try {
                console.log('Sending request...');
                const formData = new FormData();
                formData.append('style_name', this.style_name);
                formData.append('style_desc', this.style_desc);

                const response = await axios.post(`${this.$URL}/OottStyleAdd.php`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data', // Use multipart/form-data for form data
                    },
                });
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Item has been added successfully.',
                });
                console.log('Data sended successfully', response.data);
            } catch (error) {
                console.log(error);
            }
        }
    },
};
</script>
