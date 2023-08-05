<template>
    <div class="main_content">
        <div class="member_group">
            <h3>會員資料檢視</h3>
            
            <div class="selection_wrap" >
                <div class="selection_box" v-width="200">
                    <span v-width="150">帳號狀態</span>
                    <Select v-model="selectRegion" >
                        <Option v-for="item in regionList" :value="item.value" :key="item.value">{{ item.label }}</Option>
                    </Select>
                </div>
                <label for="member_number" >
                    <span class="ivu-p-8">會員編號</span>
                    <input type="text" name="member_number" id="member_number" v-width="100">
                </label>
            </div>   
        </div>
        <div class="form_container">
            <label for="member_name">
                <span>姓名</span>
                <input type="text" name="member_name" id="member_name">
            </label>
            <label for="member_birthday">
                <span>生日</span>
                <input type="text" name="member_birthday" id="member_birthday">
            </label>
        </div>
        <span>性別</span>
        <Space size="large" class="ivu-p-16">
            <RadioGroup v-model="gender">
                <Radio label="男" class="ivu-p-8"></Radio>
                <Radio label="女" class="ivu-p-8"></Radio>
                <Radio label="不告訴你" class="ivu-p-8"></Radio>
            </RadioGroup>
        </Space>
        
        <div class="form_container">
            <label for="member_email">
                <span>Email</span>
                <input type="text" name="member_email" id="member_email">
            </label>
            <label for="member_phone">
                <span>連絡電話</span>
                <input type="text" name="member_phone" id="member_phone">
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
        data(){
        return{
            regionList: [
                {
                    value: '待修改',
                    label: '待修改'
                },
                {
                    value: '審核中',
                    label: '審核中'
                },
                {
                    value: '已發布',
                    label: '已發布'
                },
                
            ],
            selectRegion: '',
            gender: '不告訴你',

        }
    },
    }
</script>

<style lang="scss">

.member_group{
    display: flex;
    justify-content: space-between;
    .selection_wrap{
        display: flex;
        align-items: center;
        .selection_box{
            display: flex;
            align-items: center;
        }
    }
}
</style>

