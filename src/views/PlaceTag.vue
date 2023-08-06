<template>
    <div class="main_content">
        <h3>景點類型管理</h3>
        <div class="action_container">
            <router-link to="/place_tag_add">
                <button class="btn">
                    <span>
                        <Icon type="md-add" />
                        新增類型
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
                    <th>景點類型</th>
                    <th>描述</th>
                    <th>標籤狀態</th>
                    <th>刪除</th>
                </tr>
                <tr v-for="(item, index) in tableData" :key="index">
                    <td>{{ item.no }}</td>
                    <td>{{ item.type }}</td>
                    <td>{{ item.description }}</td>
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
                            <Icon type="md-trash" />
                        </button>
                        <!-- <button><Icon type="md-trash" @click="deleteRow(index)" /></button> -->
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
                { no: '01', type: '親子', description: '適合兒童遊玩', status: true },
                { no: '02', type: '情侶', description: '適合情侶約會', status: true },
                { no: '03', type: '小資', description: '消費平價或不用門票', status: true },
                { no: '04', type: '風景', description: '戶外自然景觀', status: true },
                { no: '05', type: '樂園', description: '遊樂園', status: true },
                { no: '06', type: '藝文', description: '有展覽或人文歷史古蹟等', status: true },
                { no: '07', type: '山林', description: '登山步道或露營區或果園', status: true },
                { no: '08', type: '海邊', description: '海邊', status: true },
                { no: '09', type: '放鬆', description: '', status: true },
                { no: '10', type: '懷舊', description: '古蹟或復古場景', status: true },
                { no: '11', type: '農場', description: '有動物', status: true },
                // Add more data rows here
            ],
        };
    },
    methods: {
        // deleteRow(index) {
        //     this.tableData.splice(index, 1);
        // },
        // You can add other methods for handling backend data retrieval, update, etc.
    },
};
</script>
  