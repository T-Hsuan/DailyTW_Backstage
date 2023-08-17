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
                        <Switch size="large" v-model="item.place_status" :true-value="1" :false-value="0" @on-change="updateStatus(item)">
                            <template #open>
                                <span>ON</span>
                            </template>
                            <template #close>
                                <span>OFF</span>
                            </template>
                        </Switch>
                    </td>
                    <td>
                        <router-link :to="'/place_edit/' + item.place_id">
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
import { GET } from '@/plugin/axios';
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
            const rawDataIndex = this.rawData.findIndex(item => item.place_id === this.tableData[rowIndex].place_id);
            
            if (rawDataIndex !== -1) {
                const placeId = this.rawData[rawDataIndex].place_id;
                this.rawData.splice(rawDataIndex, 1);

                try {
                    await this.deleteOnServer(placeId);
                } catch (error) {
                    console.error('Error deleting place:', error);
                }
            }
        },
        async deleteOnServer(placeId) {
            try {
                const response = await axios.get(`${this.$URL}/PlaceDelete.php?place_id=${placeId}`);
                console.log('Place deleted on server:', response.data);
            } catch (error) {
                console.error('Error deleting place on server:', error);
            }
        },
        // deleteRow(index) {
        //     this.tableData.splice(index, 1);
        // },

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
            const newStatus = item.place_status === '1' ? '1' : '0';
            const placeId = item.place_id;
            try {
                const status = await axios.get(`${this.$URL}/PlaceStatus.php?place_id=${placeId}&place_status=${newStatus}`);
                console.log('Place status updated on server', status.data);
            } catch (error) {
                console.error('Error updating place status:', error);
            }
        },
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
        width: 200px;
    }

    tr th:nth-child(4),
    tr th:nth-child(5),
    tr td:nth-child(4),
    tr td:nth-child(5) {
        width: 110px;
    }
}
</style>
  