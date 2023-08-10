<template>
    <div class="main_content">
        <h3>景點列表</h3>
        <div class="action_container">
            <div class="searchbar">
                <input v-model="searchText" type="text" name="search" id="search" placeholder="請輸入關鍵字" />
                <button class="btn" @click="search">搜尋</button>
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
                        <button @click="sortBy('place_id', 'no')">
                            NO.
                            <Icon :type="sortType === 'no' ? sortIcon : 'md-arrow-dropdown'" />
                        </button>
                    </th>
                    <th>名稱</th>
                    <th>
                        <button @click="sortBy('place_date', 'updateDate')">
                            更新時間
                            <Icon :type="sortType === 'updateDate' ? sortIcon : 'md-arrow-dropdown'" />
                        </button>
                    </th>
                    <th>
                        <button @click="sortBy('place_stay', 'stayTime')">
                            停留時間
                            <Icon :type="sortType === 'stayTime' ? sortIcon : 'md-arrow-dropdown'" />
                        </button>
                    </th>
                    <th>狀態</th>
                    <th>編輯</th>
                    <th>刪除</th>
                </tr>
                <tr v-for="(item, index) in tableData" :key="index">
                    <td>{{ item.place_id }}</td>
                    <td>{{ item.place_name }}</td>
                    <td>{{ item.place_date }}</td>
                    <td>{{ item.place_stay }}</td>
                    <td>
                        <Switch size="large" v-model="item.place_status" true-value="1" false-value="0">
                            <template #open>
                                <span>ON</span>
                            </template>
                            <template #close>
                                <span>OFF</span>
                            </template>
                        </Switch>
                    </td>
                    <td>
                        <router-link :to="{ name: 'place_edit', params: { place_id: item.place_id } }">
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
            <Page :total="dataLength" v-model="page.index" :page-size="page.size"  />
        </div>
    </div>
</template>
  
<script>
import { GET, POST } from '@/plugin/axios'

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
                item.place_name.toLowerCase().includes(this.filterText.toLowerCase()) ||
                item.place_id.toString().includes(this.filterText.toLowerCase())
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
                } else if (this.sortType === 'updateDate' || this.sortType === 'stayTime') {
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

        // updateStatus(index) {
        //     const item = this.tableData[index];
        //     const newStatus = item.place_status === "1" ? "0" : "1";

        //     // Send a POST request to update the status
        //     POST("/PlaceList.php", { place_id: item.place_id, place_status: newStatus })
        //         .then(response => {
        //             // Update the status locally
        //             item.place_status = newStatus;
        //         })
        //         .catch(error => {
        //             console.error("Error updating status:", error);
        //         });
        // },
    },
    mounted() {
        GET(`${this.$URL}/PlaceList.php`)
            .then((res) => {
                console.log(res);
                this.rawData = res;
            })
            .catch((err) => {
                console.log(err);
            })
    },
};
</script>

<style lang="scss" scoped>
table {
    table-layout: fixed;

    tr th:nth-child(2),
    tr th:nth-child(3),
    tr td:nth-child(2),
    tr td:nth-child(3) {
        width: 180px;
    }

    tr th:nth-child(4),
    tr th:nth-child(5),
    tr td:nth-child(4),
    tr td:nth-child(5) {
        width: 100px;
    }
}
</style>
  