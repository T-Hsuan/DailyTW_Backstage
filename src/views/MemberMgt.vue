<template>
    <div class="main_content">
        <h3>會員管理</h3>
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
                <tr v-for="(item, index) in tableData" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.member }}</td>
                    <td>{{ item.telephone }}</td>
                    <td>
                        {{ item.email }}
                    </td>
                    <td>
                        <Switch size="large" v-model="item.status">
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
export default {
    data() {
        return {
            tableData: [
                { member: '王小明', telephone: '09123456', email: '123456@gmail.com' },
                { member: '王小明', telephone: '09123456', email: '123456@gmail.com' },
                { member: '王小明', telephone: '09123456', email: '123456@gmail.com' },
                { member: '王小明', telephone: '09123456', email: '123456@gmail.com' },
                { member: '王小明', telephone: '09123456', email: '123456@gmail.com' },
            ],
        };
    },
    methods: {
        deleteRow(index) {
            this.tableData.splice(index, 1);
        },
        // You can add other methods for handling backend data retrieval, update, etc.
    },
};
</script>
  