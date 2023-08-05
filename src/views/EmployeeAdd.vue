<template>
    <div class="main_content">
        <h3>新增員工帳號</h3>
        <div class="form_container">
            <label for="employee_name">
                <span>姓名</span>
                <input type="text" name="employee_name" id="employee_name" v-width="200">
                <Icon type="md-create" class="ivu-p-16"/>
            </label>
            <div class="selection_box">
                <span>權限</span>
                <Select v-model="selectRegion" v-width="100">
                    <Option v-for="item in accesstype" :value="item.value" :key="item.value">{{ item.label }}
                    </Option>
                </Select>
            </div>
            <label for="manager_number">
                <span>管理者編號</span>
                <input type="text" name="manager_number" id="manager_number">
            </label>
            <label for="manager_account">
                <span>管理者帳號</span>
                <input type="text" name="manager_account" id="manager_account">
            </label>
        </div>
        
        <!-- 次頁右下角統一用取消及儲存按鈕 -->
        <div class="btn_wrap">
            <div class="cancel_btn">取消</div>
            <div class="btn">儲存</div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            
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
    
};
</script>