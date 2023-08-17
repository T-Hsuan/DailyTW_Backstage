<template>
    <div class="main_content">
        <h3>票券列表</h3>
        <div class="action_container">
            <div class="searchbar">
                <input v-model="searchText" type="text" name="search" id="search" placeholder="請輸入關鍵字" />
                <button class="btn" @click="search">搜尋</button>
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
                    <th class="ticket_id">
                        <button @click="sortBy('id', 'no')">
                            NO.
                            <Icon :type="sortType === 'no' ? sortIcon : 'md-arrow-dropdown'" />
                        </button>
                    </th>
                    <th class="ticket_name">票券名稱</th>
                    <th class="ticket_date">
                        <button @click="sortBy('date', 'date')">上架時間
                            <Icon :type="sortType === 'date' ? sortIcon : 'md-arrow-dropdown'" />
                        </button>
                    </th>
                    <th class="ticket_status">
                        上架狀態
                    </th>
                    <th class="ticket_top">

                        <button @click="sortBy('top', 'top')">
                            置頂
                            <Icon :type="sortType === 'top' ? sortIcon : 'md-arrow-dropdown'" />
                        </button>
                    </th>
                    <th>編輯</th>
                    <th class="ticket_delete">刪除</th>
                </tr>
                <tr v-for="item in tableData" :key="item.id">
                    <td>{{ item.id }}</td>
                    <td>{{ item.Name }}</td>
                    <td>{{ item.date }}</td>
                    <td>
                        <Switch size="large" v-model="item.status" :true-value="1" :false-value="0"
                            @click="updateStatus(item)">
                            <template #open><span>ON</span></template>
                            <template #close><span>OFF</span></template>
                        </Switch>
                    </td>
                    <td>
                        <button><input type="checkbox" v-model="item.top" :true-value="1" :false-value="0"
                                @click="updateStatus(item)"></button>
                    </td>
                    <td>
                        <router-link :to="'/ticket_edit/' + item.id" title="票券編輯">
                            <button class="edit_btn">
                                <Icon type="md-create" />
                            </button>
                        </router-link>
                    </td>
                    <td>
                        <!-- @click="saveData()" -->
                        <button @click="DeleteConfirmation(item.id)">
                            <Icon type="md-trash" />
                        </button>
                    </td>
                </tr>
            </table>
        </div>
        <!-- 切換分頁 -->
        <div class="pages">
            <Page :total="dataLength" v-model="page.index" :page-size="page.size" />
        </div>
    </div>
</template>
  
<script>
import { mapActions, mapGetters } from 'vuex';
import { GET } from '@/plugin/axios';
import axios from 'axios';
export default {
    data() {
        return {
            page: {
                index: 1, //當前分頁
                size: 20, //一頁多少筆資料
            },
            searchText: '',
            filterText: '',
            sortType: '',
            sortIcon: 'md-arrow-dropdown',
            sortColumn: '',
            ticketData: [],
        };
    },
    methods: {
        test(item) {
            console.log(typeof (item.status));
        },
        // ...mapActions(['fetchTicketData']),
        //搜尋
        search() {
            const searchTerm = this.searchText;
            this.filterText = searchTerm;
            this.page.index = 1;
        },
        //排序
        sortBy(column, sortType) {
            this.sortType = sortType;
            this.sortColumn = column;
            this.sortIcon = this.sortIcon === 'md-arrow-dropdown' ? 'md-arrow-dropup' : 'md-arrow-dropdown';
        },
        //更新資料狀態
        async updateStatus(item) {
            const ticketId = item.id;
            const newStatus = item.status === 1 ? 1 : 0;
            const newTop = item.top === 1 ? 0 : 1;
            console.log('[票券]Id:', ticketId, 'Name:', item.Name, 'Status:', newStatus, 'Top:', newTop);
            try {
                const status = await axios.get(`${this.$URL}/TicketStatus.php?ticket_id=${ticketId}&ticket_status=${newStatus}&ticket_top=${newTop}`);
                console.log('[票券]status updated on server:', status.data);
            } catch (error) {
                console.error('[票券]Error updating ticket status:', error);
            }
        },
        //刪除確認
        async DeleteConfirmation(itemId) {
            // Show the confirm message dialog
            const Confirmed = await swal("確定要刪除嗎？", {
                dangerMode: true,
                buttons: ["取消", "確定"],
            });
            if (Confirmed) {
                // If the user confirms, delete the row
                this.deleteRow(itemId);
            }
        },
        async deleteRow(itemId) {
            //因搜尋或排序後，刪除的資料index會不正確，因此需抓資料id
            const Index = this.ticketData.findIndex(item => item.id === itemId);

            if (Index !== -1) {
                const ticketId = this.ticketData[Index].id;
                this.ticketData.splice(Index, 1);
                console.log(ticketId);
                try {
                    await this.deleteOnServer(itemId);
                } catch (error) {
                    console.error('Error deleting ticket:', error);
                }
            }
        },
        async deleteOnServer(ticketId) {
            try {
                const response = await axios.get(`${this.$URL}/TicketDelete.php?ticket_id=${ticketId}`);
                console.log('ticketId deleted on server:', response.data);
            } catch (error) {
                console.error('Error deleting ticketId on server:', error);
            }
        },
    },
    computed: {
        // ...mapGetters(['ticketData']),
        //搜尋結果資料
        searchData() {
            return this.ticketData.filter(item => {
                const itemName = item.Name || ''; // 使用默认值处理未定义的情况
                const itemId = item.id || ''; // 使用默认值处理未定义的情况

                return itemName.includes(this.filterText) ||
                    itemId.toString().includes(this.filterText.toLowerCase());
            });
        },

        // //排序
        sortData() {
            const arr = [...this.searchData];
            return arr.sort((a, b) => {
                const aValue = a[this.sortColumn];
                const bValue = b[this.sortColumn];
                if (this.sortType === 'no') {
                    return this.sortIcon === 'md-arrow-dropdown' ? aValue - bValue : bValue - aValue;
                } else if (this.sortType === 'date') {
                    return this.sortIcon === 'md-arrow-dropdown' ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
                } else if (this.sortType === 'top') {
                    return this.sortIcon === 'md-arrow-dropdown' ? bValue - aValue : aValue - bValue;
                }
            });
        },
        // //資料分頁
        tableData() {
            return this.sortData.slice((this.page.index - 1) * this.page.size, this.page.index * this.page.size);
        },
        dataLength() {
            return this.searchData.length;
        },
    },
    mounted() {
        // this.fetchTicketData();// 调用 Vuex 的 fetchTicketData action
        GET(`${this.$URL}/TicketList.php`)
            .then((res) => {
                this.ticketData = res;
                this.$store.commit('SET_TICKET_DATA', res);
                console.log('[票券]成功連接資料庫', this.ticketData);
                console.log('[store][票券]成功連接資料庫', this.$store.state.ticketData);
            })
            .catch((err) => {
                console.log(err);
            })
    },
}
</script>
  