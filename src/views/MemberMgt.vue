<template>
    <div class="main_content">
        <h3>會員資料管理</h3>
        <div class="action_container">
            <div class="searchbar">
                <input type="text" name="search" id="search" placeholder="請輸入關鍵字" />
                <button class="btn">搜尋</button>
            </div>
        </div>
        <div class="table_wrap">
            <table>
                <tr>
                    <th>會員編號</th>
                    <th>會員姓名</th>
                    <th>聯絡電話</th>
                    <th>會員信箱</th>
                    <th>帳號狀態</th>
                </tr>
                <tr v-for="(item, index) in dataFromMySQL" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.mem_name }}</td>
                    <td>{{ item.mem_phone }}</td>
                    <td>
                        {{ item.mem_email }}
                    </td>
                    <td>
                    <Select v-model="selectedRegions[index]">
                        <Option v-for="region in regionList" :value="region.value" :key="region.value">{{ region.label }}</Option>
                    </Select>
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
            selectedRegions: [], // Each select's value is stored in this array
        };
    },
    methods: {
        deleteRow(index) {
            this.tableData.splice(index, 1);
        },
        // You can add other methods for handling backend data retrieval, update, etc.
    },
    mounted() {
        GET(`${this.$URL}/Member.php`)
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
  