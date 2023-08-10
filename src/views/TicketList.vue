<template>
    <div class="main_content">
        <h3>票券列表</h3>
        <div class="action_container">
            <div class="searchbar">
                <input type="text" name="search" id="search" placeholder="請輸入關鍵字" />
                <button class="btn">搜尋</button>
            </div>
            <router-link to="/ticket_add">
                <button class="btn" name="ticket_id">
                    <span>
                        <Icon type="md-add" />
                        新增票券
                    </span>
                </button></router-link>
        </div>
        <div class="table_wrap">
            <table>
                <tr>
                    <th>
                        <button>NO.
                            <Icon type="md-arrow-dropdown" />
                        </button>
                    </th>
                    <th>票券名稱</th>
                    <th>全票價格</th>
                    <th>優待票價格</th>
                    <th>折扣標籤</th>
                    <th>上架時間</th>
                    <th>
                        上架狀態
                        <button>
                            <Icon type="md-arrow-dropdown" />
                        </button>
                    </th>
                    <th>
                        置頂
                        <button>
                            <Icon type="md-arrow-dropdown" />
                        </button>
                    </th>
                    <th>刪除</th>
                </tr>
                <tr v-for="(item, index) in tableData" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.type }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ item.description }}</td>
                    <td>
                        <Switch size="large" v-model="item.status">
                            <template #open><span>ON</span></template>
                            <template #close><span>OFF</span></template>
                        </Switch>
                    </td>
                    <td>
                        <button><input type="checkbox"></button>
                    </td>
                    <td>
                        <button>
                            <Icon type="md-trash" />
                        </button>
                    </td>
                    <td></td>
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
                { type: '小人國', description: '2023-08-03', state: '審核中' },
                { type: '小人國', description: '2023-08-03', state: '審核中' },
                { type: '小人國', description: '2023-08-03', state: '審核中' },
                { type: '小人國', description: '2023-08-03', state: '審核中' },
                { type: '小人國', description: '2023-08-03', state: '審核中' },
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
  