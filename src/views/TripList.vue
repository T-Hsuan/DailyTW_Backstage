<template>
    <div class="main_content">
        <h3>行程列表</h3>
        <div class="action_container">
            <div class="searchbar">
                <input v-model="searchText" type="text" name="search" id="search" placeholder="請輸入關鍵字" />
                <button class="btn" @click="search">搜尋</button>
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
                        <button @click="sortBy('trip_id', 'no')">
                            NO.
                            <Icon :type="sortType === 'no' ? sortIcon : 'md-arrow-dropdown'" />
                        </button>
                    </th>
                    <th>標題</th>
                    <th>更新日期
                        <button @click="sortBy('trip_date', 'updateDate')">
                            <Icon :type="sortType === 'updateDate' ? sortIcon : 'md-arrow-dropdown'" />
                        </button>
                    </th>
                    <th>瀏覽數
                        <button @click="sortBy('trip_view', 'viewCount')">
                            <Icon :type="sortType === 'viewCount' ? sortIcon : 'md-arrow-dropdown'" />
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
                        <Switch size="large" v-model="item.trip_status" true-value="1" false-value="0">
                            <template #open>
                                <span>ON</span>
                            </template>
                            <template #close>
                                <span>OFF</span>
                            </template>
                        </Switch>
                    </td>
                    <td>
                        <router-link :to="{ name: 'trip_edit', params: { trip_id: item.trip_id } }">
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
        <!-- 切換分頁 -->
        <div class="pages">
            <Page 
            :total="dataLength" 
            :current="page.index"
            :page-size="page.size"
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
            page: {
                index: 1, //當前分頁
                size: 20, //一頁多少筆資料
            },
            sortType: '',
            sortColumn: '',
            sortIcon: 'md-arrow-dropdown',
            searchText: '',
            filterText: '',
        };
    },
    computed: {
        //搜尋結果資料
        searchData() {
            return this.rawData.filter(item => 
                item.trip_name.toLowerCase().includes(this.filterText.toLowerCase()) ||
                item.trip_id.toString().includes(this.filterText.toLowerCase())
            )
        },
        //資料排序
        sortData() {
            const arr= [...this.searchData];
            return arr.sort((a, b) => {
                const aValue = a[this.sortColumn];
                const bValue = b[this.sortColumn];
                if (this.sortType === 'no') {
                    return this.sortIcon === 'md-arrow-dropdown' ? aValue - bValue : bValue - aValue;
                } else if (this.sortType === 'updateDate' || this.sortType === 'viewCount') {
                    return this.sortIcon === 'md-arrow-dropdown' ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
                }
            });
        },
        //資料分頁
        tableData() {
            return this.sortData.slice((this.page.index - 1) * this.page.size, this.page.index * this.page.size);
        },
        dataLength() {
            return this.searchData.length;
        },
    },
    methods: {
        //刪除資料
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

        //排序
        sortBy(column, sortType) {
            this.sortType = sortType;
            this.sortColumn = column;
            this.sortIcon = this.sortIcon === 'md-arrow-dropdown' ? 'md-arrow-dropup' : 'md-arrow-dropdown';
        },

        //搜尋
        search() {
            const searchTerm = this.searchText.toLowerCase();
            this.filterText = searchTerm;
            this.page.index = 1;
        },
    },
    mounted() {
        GET(`${this.$URL}/TripList.php`)
            .then((res) => {
                console.log(res);
                this.rawData = res; // Store the raw fetched data
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
  