<template>
    <div class="main_content">
        <h3>新增帳號</h3>
        <div class="employee_section">
            <div class="employee_block">
                <label for="employee_account">
                    <span class="name">姓名</span>
                    <input type="text" name="employee_account" id="employee_account">
                </label>
                <button class="create"><Icon type="md-create" /></button>
                <label for="employee_number">
                    <span>管理者編號</span>
                    <input type="text" name="employee_number" id="employee_number">
                </label>
            </div>
            <div class="selection_wrap">
                <div class="selection_box">
                    <span>權限</span>
                    <Select v-model="selectRegion">
                        <Option v-for="item in accesstype" :value="item.value" :key="item.value">{{ item.label }}
                        </Option>
                    </Select>
                </div>
                <label for="employee_account">
                    <span>管理者帳號</span>
                    <input type="text" name="employee_account" id="employee_account">
                </label>
            </div>
            <div class="btn_box">
                <div class="btn">儲存</div>
            </div>
            
        </div>
    </div>
</template>

<script>
export default{
    data(){
        return{
            accesstype: [
                {
                    value: '請選擇',
                    label: '請選擇'
                },
                {
                    value: 'A',
                    label: 'A'
                },
            ],
        }
    },
    methods: {
        
}
}
</script>
<style lang="scss" >
@import "@/assets/scss/main.scss";
.employee_section{
    border-top: 1px solid $textColor_default;
    padding: $sp3 0;
    .name{
        padding: $sp1 $sp5 $sp1 0;
    }
    span{
        padding: $sp1;
    }
    label{
        padding: $sp1;
    }
    .create{
        padding: $sp1 15px;
    }
    text-align: start;
    .employee_block{
        justify-content: space-between;
    }
    .selection_wrap{
        justify-content: space-between;
        align-items: end;
        .selection_box{
            span{
                padding: $sp1;
            }
        }
    }
    .btn_box{
        display: flex;
        justify-content: center;
        padding-top: 20%;
    }
}
</style>