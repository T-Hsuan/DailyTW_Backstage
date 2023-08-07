<template>
    <div class="main_content">
        <h3>景點列表</h3>
        <div class="action_container">
            <div class="searchbar">
                <input type="text" name="search" id="search" placeholder="請輸入關鍵字" />
                <button class="btn">搜尋</button>
            </div>
            <router-link to="/place_add">
                <button class="btn">
                    <span>
                        <Icon type="md-add" />
                        新增景點
                    </span>
                </button>
            </router-link>
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
                    <th>名稱</th>
                    <th>
                        更新時間
                        <button>
                            <Icon type="md-arrow-dropdown" />
                        </button>
                    </th>
                    <th>
                        停留時間
                        <button>
                            <Icon type="md-arrow-dropdown" />
                        </button>
                    </th>
                    <th>狀態</th>
                    <th>編輯</th>
                    <th>刪除</th>
                </tr>
                <tr v-for="(item, index) in tableData" :key="index">
                    <td>{{ item.no }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.date }}</td>
                    <td>{{ item.stay }}</td>
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
                    <td>
                        <router-link :to="{ name: 'place_edit', params: { index } }">
                            <button class="edit_btn">
                                <Icon type="md-create" />
                            </button>
                        </router-link>
                    </td>
                    <td>
                        <button @click="showDeleteConfirmation(index)">
                            <Icon type="md-trash" />
                        </button>
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
                { no: '001', name: '合興車站', date: '2023-08-06', stay: '0.5'},
                { no: '002', name: '內灣愛情故事館', date: '2023-08-06', stay: '1'},
                { no: '003', name: '內灣老街', date: '2023-08-06', stay: '2'},
                { no: '004', name: '劉興欽漫畫館', date: '2023-08-06', stay: '3'},
                { no: '005', name: '內灣隱藏版咖啡', date: '2023-08-06', stay: '1.5'},
                { no: '006', name: '清水地熱', date: '2023-08-06', stay: '1.5'},
            ],
        };
    },
    methods: {
        showDeleteConfirmation(index) {
            // Show the confirm message dialog
            const isConfirmed = window.confirm('確定刪除此筆資料?');
            if (isConfirmed) {
                // If the user confirms, delete the row
                this.deleteRow(index);
            }
        },
        deleteRow(index) {
            this.tableData.splice(index, 1);
        },
        // You can add other methods for handling backend data retrieval, update, etc.
    },
};
</script>
  