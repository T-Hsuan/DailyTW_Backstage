<template>
    <div class="main_content">
        <h3>電子報訂閱者列表</h3>
        <div class="action_container">
            <div class="searchbar">
                <input type="text" name="search" id="search" placeholder="請輸入關鍵字" />
                <button class="btn">搜尋</button>
            </div>
            <button class="btn">
                <span>
                    <Icon type="md-add" />
                    匯出.csv
                </span>
            </button>
        </div>
        <div class="table_wrap">
            <table>
                <tr>
                    <th>
                        <button>
                            NO.
                            <Icon type="md-arrow-dropdown" />
                        </button>
                    </th>
                    <th>email</th>
                    <th>訂閱日期
                        <button>
                            <Icon type="md-arrow-dropdown" />
                        </button>
                    </th>
                    <th>取消</th>
                </tr>
                <tr v-for="(item, index) in tableData" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.email }}</td>
                    <td>{{ item.date }}</td>
                    <td>
                        <button><input type="checkbox"></button>
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
                { email: '123456@gmail.com', date: '2023-08-03' },
                { email: '123456@gmail.com', date: '2023-08-03' },
                { email: '123456@gmail.com', date: '2023-08-03' },
                { email: '123456@gmail.com', date: '2023-08-03' },
                { email: '123456@gmail.com', date: '2023-08-03' },
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
  