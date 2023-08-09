<template>
    <div class="main_content">
        <h3>電子報訂閱者列表</h3>
        <div class="action_container">
            <div class="searchbar">
                <input v-model="searchText" type="text" name="search" id="search" placeholder="請輸入關鍵字" />
                <button class="btn" @click="search">搜尋</button>
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
                    <th>狀態</th>
                </tr>
                <tr v-for="(item, index) in dataFromMySQL" :key="index">
                    <td>{{ item.sub_id }}</td>
                    <td>{{ item.sub_email }}</td>
                    <td>{{ item.sub_date }}</td>
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
import {GET} from '@/plugin/axios'

export default {
    data() {
        return {
            dataFromMySQL:[],
            searchText: "",
        };
    },
    methods: {
        deleteRow(index) {
            this.tableData.splice(index, 1);
        },
        // You can add other methods for handling backend data retrieval, update, etc.
    },
    mounted() {
        GET(`${this.$URL}/SubscriberList.php`)
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
  