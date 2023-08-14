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
                        <Switch size="large" v-model="item.trip_status" true-value="1" false-value="0"
                        @on-change="updateStatus(item)">
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
import  axios  from "axios";

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
            swal({
                title: "確定刪除此筆資料?",
                icon: "warning",
                buttons: ["取消", "確定"],
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    // If the user confirms, delete the row
                    this.deleteRow(index);
                }
            });
        },
        async deleteRow(rowIndex) {
            //因搜尋或排序後，刪除的資料index會不正確，因此需抓資料id
            const rawDataIndex = this.rawData.findIndex(item => item.trip_id === this.tableData[rowIndex].trip_id);
            
            if (rawDataIndex !== -1) {
                const tripId = this.rawData[rawDataIndex].trip_id;
                this.rawData.splice(rawDataIndex, 1);

                try {
                    await this.deleteOnServer(tripId);
                } catch (error) {
                    console.error('Error deleting trip:', error);
                }
            }
        },
        async deleteOnServer(tripId) {
            try {
                const response = await axios.get(`${this.$URL}/TripDelete.php?trip_id=${tripId}`);
                console.log('Trip deleted on server:', response.data);
            } catch (error) {
                console.error('Error deleting trip on server:', error);
            }
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
        //更新資料狀態
        async updateStatus(item) {
            const newStatus = item.trip_status === '1' ? '1' : '0';
            const tripId = item.trip_id;
            try {
                const status = await axios.get(`${this.$URL}/TripStatus.php?trip_id=${tripId}&trip_status=${newStatus}`);
                console.log('Trip status updated on server', status.data);
            } catch (error) {
                console.error('Error updating trip status:', error);
            }
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
        width: 180px;
    }

    tr th:nth-child(4),
    tr td:nth-child(4){
        width: 180px;
    }

    tr th:nth-child(5),
    tr td:nth-child(5){
        width: 120px;
    }
}
</style>
  