<template>
    <div class="main_content">
        <h3>景點列表</h3>
        <div class="action_container">
            <div class="searchbar">
                <input type="text" name="search" id="search" placeholder="請輸入關鍵字" />
                <button class="btn">搜尋</button>
            </div>
            <button class="btn">
                <span>
                    <Icon type="md-add" />
                    新增景點
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
                    <th>標題</th>
                    <th>
                        更新時間
                        <button>
                            <i class="fa-solid fa-sort"></i>
                        </button>
                    </th>
                    <th>
                        停留時間
                        <button>
                            <i class="fa-solid fa-sort"></i>
                        </button>
                    </th>
                    <th>狀態</th>
                    <th>編輯</th>
                    <th>刪除</th>
                </tr>
                <tr v-for="(item, index) in tableData" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.type }}</td>
                    <td>{{ item.description }}</td>
                    <td>
                        {{ item.dwell }}
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
                    <td>
                        <button>
                            <Icon type="md-create" />
                        </button>
                    </td>
                    <td>
                        <button>
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
                { type: '休閒', description: '2023-08-03', dwell: '0.5hr', state: '審核中' },
                { type: '休閒', description: '2023-08-03', dwell: '0.5hr', state: '審核中' },
                { type: '休閒', description: '2023-08-03', dwell: '0.5hr', state: '審核中' },
                { type: '休閒', description: '2023-08-03', dwell: '0.5hr', state: '審核中' },
                { type: '休閒', description: '2023-08-03', dwell: '0.5hr', state: '審核中' },
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
  