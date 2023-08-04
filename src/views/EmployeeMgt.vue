<template>
    <div class="main_content">
        <h3>後台帳號管理</h3>
        <div class="action_container">
            <div class="searchbar">
                <input type="text" name="search" id="search" placeholder="請輸入關鍵字" />
                <button class="btn">搜尋</button>
            </div>
            <button class="btn">
                <span>
                    <Icon type="md-add" />
                    新增行程
                </span>
            </button>
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
                <tr v-for="(employee, index) in tableData" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ employee.name }}</td>
                    <td>
                        <div class="selection_box">
                            <Select v-model="selectRegion">
                                <Option v-for="item in accesstype" :value="item.value" :key="item.value">{{ item.label }}
                                </Option>
                            </Select>
                        </div>
                    </td>
                    <td>
                        {{ employee.email }}
                    </td>
                    <td>
                        <Switch size="large" v-model="employee.status">
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
                { name: '王小明', email: '123456@gmail.com' },
                { name: '王小明', email: '123456@gmail.com' },
                { name: '王小明', email: '123456@gmail.com' },
                { name: '王小明', email: '123456@gmail.com' },
                { name: '王小明', email: '123456@gmail.com' },
            ],
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
    methods: {
        deleteRow(index) {
            this.tableData.splice(index, 1);
        },
        // You can add other methods for handling backend data retrieval, update, etc.
    },
};
</script>
  