<template>
    <div class="main_content">
        <h3>用戶回饋列表</h3>
        <div class="action_container">
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
                            <i class="fa-solid fa-sort"></i>
                        </button>
                    </th>
                    <th>姓名</th>
                    <th>email</th>
                    <th>主旨</th>
                    <th>日期<button><i class="fa-solid fa-sort"></i></button></th>
                </tr>
                <tr v-for="(item, index) in tableData" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.email }}</td>
                    <td>{{ item.text }}</td>
                    <td>
                        {{ item.date }}
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
                { name: '張君雅', email: '123456@gmail.com', text: '明天沒放颱風假...', date: '2023-08-03' },
                { name: '張君雅', email: '123456@gmail.com', text: '明天沒放颱風假...', date: '2023-08-03' },
                { name: '張君雅', email: '123456@gmail.com', text: '明天沒放颱風假...', date: '2023-08-03' },
                { name: '張君雅', email: '123456@gmail.com', text: '明天沒放颱風假...', date: '2023-08-03' },
                { name: '張君雅', email: '123456@gmail.com', text: '明天沒放颱風假...', date: '2023-08-03' },
                // Add more data rows here
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
  