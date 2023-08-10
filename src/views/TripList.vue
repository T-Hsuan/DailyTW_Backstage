<template>
    <div class="main_content">
        <h3>行程列表</h3>
        <div class="action_container">
            <div class="searchbar">
                <input type="text" name="search" id="search" placeholder="請輸入關鍵字" />
                <button class="btn">搜尋</button>
            </div>
            <router-link to="/trip_add">
                <button class="btn">
                    <span>
                        <Icon type="md-add" />
                        新增行程
                    </span>
                </button>
            </router-link>
        </div>
        <div class="table_wrap">
            <table>
                <tr>
                    <th></th>
                    <th>
                        <button>
                            NO.
                            <Icon type="md-arrow-dropdown" />
                        </button>
                    </th>
                    <th>標題</th>
                    <th>更新日期
                        <button>
                            <Icon type="md-arrow-dropdown" />
                        </button>
                    </th>
                    <th>瀏覽數
                        <button>
                            <Icon type="md-arrow-dropdown" />
                        </button>
                    </th>
                    <th>狀態</th>
                    <th>編輯</th>
                    <th>刪除</th>
                </tr>
                <tr v-for="(item, index) in tableData" :key="index">
                    <td>
                        <button>
                            <Icon type="md-flag" />
                        </button>
                    </td>
                    <td>{{ item.trip_id }}</td>
                    <td>{{ item.trip_name }}</td>
                    <td>{{ item.trip_date }}</td>
                    <td>{{ item.trip_view }}</td>
                    <td>
                        <Switch size="large" v-model="item.trip_status">
                            <template #open>
                                <span>ON</span>
                            </template>
                            <template #close>
                                <span>OFF</span>
                            </template>
                        </Switch>
                    </td>
                    <td>
                        <router-link :to="{ name: 'trip_edit', params: { index } }">
                            <button>
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
        <!-- 切換分頁 -->
        <div class="pages">
            <Page 
            :total="page.total" 
            :current="page.index"
            :page-size="page.size"
            @on-change="pIndexChange"
            />
        </div>
    </div>
</template>
  
<script>
import {GET} from '@/plugin/axios';
export default {
    data() {

        return {
            rawData: [],
            tableData: [],
            page: {
                index: 1, //當前分頁
                size: 20, //一頁多少筆資料
                total: 0
            },
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
        getHome() {
            const startIdx = (this.page.index - 1) * this.page.size;
            const endIdx = startIdx + this.page.size;

            this.tableData = this.rawData.slice(startIdx, endIdx);
        },

        pIndexChange(i) {
            this.page.index = i;
            this.getHome();
        },
    },
    mounted() {
        GET(`${this.$URL}/TripList.php`)
            .then((res) => {
                console.log(res);
                this.rawData = res; // Store the raw fetched data
                this.page.total = this.rawData.length; // Set total based on raw data length
                this.getHome(); // Fetch initial paginated data
            })
            .catch((err) => {
                console.log(err);
            })
    },
};
</script>
  

<style lang="scss" scoped>
table{
    table-layout: fixed;

    tr th:nth-child(1),
    tr td:nth-child(1){
        width: 50px;
    }

    tr th:nth-child(2),
    tr td:nth-child(2){
        width: 50px;
    }

    tr th:nth-child(3),
    tr td:nth-child(3){
        width: 120px;
    }

    tr th:nth-child(4),
    tr td:nth-child(4){
        width: 180px;
    }

    tr th:nth-child(5),
    tr td:nth-child(5){
        width: 100px;
    }
}
</style>
  