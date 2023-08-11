<template>
    <div class="main_content">
        <h3>後台帳號管理</h3>
        <div class="action_container">
            <!-- <div class="searchbar">
                <input type="text" name="search" id="search" placeholder="請輸入關鍵字" />
                <button class="btn">搜尋</button>
            </div> -->
            <router-link to="/employee_add" class="btn">
                <Icon type="md-add" />新增帳號
            </router-link>
        </div>
        <div class="table_wrap">
            <table>
                <tr>
                    <th>管理者編號</th>
                    <th>管理者姓名</th>
                    <th>權限</th>
                    <th>管理者帳號</th>
                    <th>狀態</th>
                </tr>
                <tr v-for="(item, index) in dataFromMySQL" :key="index">
                    <td>{{ item.manager_id }}</td>
                    <td>{{ item.manager_name }}</td>
                    <td>{{ item.manager_type }}</td>
                    <td>{{ item.manager_account }}</td>
                    <td>
                        <Switch size="large" v-model="item.place_status" true-value="1" false-value="0">
                            <template #open>
                                <span>ON</span>
                            </template>
                            <template #close>
                                <span>OFF</span>
                            </template>
                        </Switch>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>
  
<script>
import {GET} from '@/plugin/axios'

export default {
    data() {
        return {
            dataFromMySQL:[],
            
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
        };
    },
    methods: {
        deleteRow(index) {
            this.tableData.splice(index, 1);
        },
        // You can add other methods for handling backend data retrieval, update, etc.
    },
    mounted() {
        GET(`${this.$URL_MAC}/phpfile/EmployeeMgt.php`)
            .then((res) => {
                this.dataFromMySQL = res;
                console.log(res);
            })
            .catch((err) => {
                console.log(err);
            })
    },
};
</script>
<!-- <style lang="scss" scoped>
@import "@/assets/scss/main.scss";
    .btn{
        color: $textColor_white;
    }

</style> -->
  