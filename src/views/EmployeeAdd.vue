<template>
    <div class="main_content">
        <h3>新增員工帳號</h3>
        <form method="post" @submit="submitForm" class="form_container">
            <label for="employee_name">
                <span>姓名</span>
                <input type="text" name="manager_name" id="manager_name" v-width="200" v-model="manager_name">
            </label>
            <div class="selection_box">
                <span>權限</span>
                <Select v-model="selectRegion" v-width="100">
                    <Option v-for="item in accesstype" :value="item.value" :key="item.value">{{ item.label }}</Option>
                </Select>
            </div>
            <label for="manager_account">
                <span>管理者帳號</span>
                <input type="text" name="manager_account" id="manager_account" v-model="manager_account">
            </label>

            <label for="manager_pwd">
                <span>管理者密碼</span>
                <input type="text" name="manager_pwd" id="manager_pwd" v-model="manager_pwd">
            </label>
            <div class="btn_wrap">
                <router-link to="/employee_mgt">
                    <button class="cancel_btn">取消</button>
                </router-link>
                <button class="btn" type="submit" :disabled="!formValid">儲存</button>
            </div>
        </form>

        <!-- 次頁右下角統一用取消及儲存按鈕 -->
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            manager_name: '',
            selectRegion: '無',
            manager_id: '',
            manager_account: '',
            accesstype: [
                {
                    value: '無',
                    label: '無'
                },
                {
                    value: 'A',
                    label: 'A'
                },
            ],
        };
    },
    computed: {
        formValid() {
            return (
                this.manager_name !== '' &&
                // this.manager_desc !== '' &&
                // this.manager_id !== '' &&
                // this.manager_type !== '' &&
                this.manager_pwd !== '' &&
                this.manager_account !== ''
            );
        }
    },
    methods: {
        async submitForm(event) {
            event.preventDefault();
            try {
                console.log('Se uest...');
                const formData = new FormData();
                formData.append('manager_name', this.manager_name);
                formData.append('manager_type', this.selectRegion);
                formData.append('manager_account', this.manager_account);
                formData.append('manager_pwd', this.manager_pwd);

                const response = await axios.post(`${this.$URL}/EmployeeAdd.php`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                swal({
                    title: "新增成功!",
                    icon: "success",
                }).then((value) => {
                    console.log('Data sended successfully', response.data);
                    // Redirect to the "/place_tag" page
                    this.$router.push('/employee_mgt');
                });
                
                // // Redirect to the "/place_tag" page
                // this.$router.push('/place_tag');
            } catch (error) {
                console.error('Error:', error);
            }
        }
    }
};
</script>