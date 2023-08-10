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
                        <Switch 
                            size="large" 
                            v-model="item.place_status" 
                            true-value="1" 
                            false-value="0"
                        >
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
import {GET, POST} from '@/plugin/axios'

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
            sortType: '',
            sortIcon: 'md-arrow-dropdown',
            searchText: '',
        };
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
        // You can add other methods for handling backend data retrieval, update, etc.
        
        //分頁資料呈現第幾筆到第幾筆
        getHome() {
            const startIdx = (this.page.index - 1) * this.page.size;
            const endIdx = startIdx + this.page.size;

            this.tableData = this.rawData.slice(startIdx, endIdx);
        },

        pIndexChange(i) {
            console.log('Pagination index change event:', i);
            this.page.index = i;
            this.getHome();
        },

        //排序
        sortBy(column, sortType) {
            this.sortType = sortType;
            this.sortIcon = this.sortIcon === 'md-arrow-dropdown' ? 'md-arrow-dropup' : 'md-arrow-dropdown';
            this.rawData.sort((a, b) => {
                const aValue = a[column];
                const bValue = b[column];
                if (this.sortType === 'no') {
                    return this.sortIcon === 'md-arrow-dropdown' ? aValue - bValue : bValue - aValue;
                } else if (this.sortType === 'updateDate' || this.sortType === 'stayTime') {
                    return this.sortIcon === 'md-arrow-dropdown' ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
                }
            });
            this.getHome(); // Refresh paginated data after sorting
        },

        //搜尋
        search() {
            const searchTerm = this.searchText.toLowerCase();
            
            if (searchTerm === '') {
                // If the search term is empty, restore rawData to its original state
                this.rawData = this.tableData;
            } else {
                // Filter the rawData and assign it to tableData
                this.tableData = this.rawData.filter(item =>
                    item.place_name.toLowerCase().includes(searchTerm) ||
                    item.place_id.toString().includes(searchTerm)
                );
                
                // Update rawData to match the filtered data
                this.rawData = this.tableData;
            }
            
            this.page.index = 1; // Reset the page index to the first page
            this.page.total = this.tableData.length; // Update total based on filtered data
            this.getHome(); // Refresh paginated data after filtering
        },

        updateStatus(index) {
            const item = this.tableData[index];
            const newStatus = item.place_status === "1" ? "0" : "1";

            // Send a POST request to update the status
            POST("/PlaceList.php", { place_id: item.place_id, place_status: newStatus })
                .then(response => {
                    // Update the status locally
                    item.place_status = newStatus;
                })
                .catch(error => {
                    console.error("Error updating status:", error);
                });
        },
        // updateStatus(index) {
        //     const item = this.tableData[index];
        //     const newStatus = item.place_status === "1" ? "0" : "1";

        //     POST("/PlaceList.php", { id: item.place_id, status: newStatus })
        //         .then(response => {
        //         // Update the tableData with the updated data from the response
        //         console.log("updateStatus method called");
        //         this.tableData = response;
        //         })
        //         .catch(error => {
        //         console.error("Error updating status:", error);
        //         });
        // },
    },
    mounted() {
        GET(`${this.$URL}/PlaceList.php`)
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
    tr th:nth-child(2),
    tr th:nth-child(3),
    tr td:nth-child(2),
    tr td:nth-child(3){
        width: 180px;
    }
    tr th:nth-child(4),
    tr th:nth-child(5),
    tr td:nth-child(4),
    tr td:nth-child(5){
        width: 100px;
    }
}
</style>
  