<template>
    <div class="main_content">
        <h3>新增員工帳號</h3>
        <div class="form_container">
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
            <label for="manager_id">
                <span>管理者編號</span>
                <input type="text" name="manager_id" id="manager_id"  v-model="manager_id">
            </label>
            <label for="manager_account">
                <span>管理者帳號</span>
                <input type="text" name="manager_account" id="manager_account" v-model="manager_account">
            </label>
        </div>
        
        <!-- 次頁右下角統一用取消及儲存按鈕 -->
        <div class="btn_wrap">
            <button class="cancel_btn">取消</button>
            <button class="btn">儲存</button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            manager_name: '',
            // manager_desc: '',  // 可以删除或使用
            selectRegion: '無',  // 添加默认值
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
                this.manager_id !== '' &&
                this.manager_account !== ''
            );
        }
    },
    methods: {
        async submitForm(event) {
            event.preventDefault();
            try {
                console.log('Sending request...');
                const formData = new FormData();
                formData.append('manager_name', this.manager_name);
                formData.append('manager_type', this.selectRegion);
                formData.append('manager_id', this.manager_id);
                formData.append('manager_account', this.manager_account);

                const response = await axios.post(`${this.$URL_MAC}/phpfile/EmployeeAdd.php`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                window.alert('新增成功!');
                console.log('Data sent successfully', response.data);

                // Redirect to the "/manager" page
                this.$router.push('/manager');

            } catch (error) {
                console.log(error);
            }
        }
    },
};
</script>
