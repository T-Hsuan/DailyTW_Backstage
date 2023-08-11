<template>
    <div class="main_content">
        <h3>票券列表</h3>
        <div class="action_container">
            <div class="searchbar">
                <input type="text" name="search" id="search" placeholder="請輸入關鍵字" />
                <button class="btn">搜尋</button>
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
                        <button @click="sortBy('ticket_id', 'no')">
                            NO.
                            <Icon :type="sortType === 'no' ? sortIcon : 'md-arrow-dropdown'" />
                        </button>
                    </th>
                    <th class="ticket_name">票券名稱</th>
                    <th class="ticket_date">
                        <button @click="sortBy('ticket_date', 'date')">上架時間
                            <Icon :type="sortType === 'date' ? sortIcon : 'md-arrow-dropdown'" />
                        </button>
                    </th>
                    <th class="ticket_status">
                        上架狀態
                    </th>
                    <th class="ticket_top">

                        <button @click="sortBy('ticket_top', 'top')">
                            置頂
                            <Icon :type="sortType === 'top' ? sortIcon : 'md-arrow-dropdown'" />
                        </button>
                    </th>
                    <th>編輯</th>
                    <th class="ticket_delete">刪除</th>
                </tr>
                <tr v-for="(item, index ) in ticketData" :key="item.ticket_id">
                    <td>{{ item.ticket_id }}</td>
                    <td>{{ item.ticket_name }}</td>
                    <td>{{ item.ticket_date }}</td>
                    <td>
                        <Switch size="large" v-model="item.ticket_status" :true-value=1 :false-value=0>
                            <template #open><span>ON</span></template>
                            <template #close><span>OFF</span></template>
                        </Switch>
                    </td>
                    <td>
                        <button><input type="checkbox" v-model="item.ticket_top" :true-value=1 :false-value=0></button>
                    </td>
                    <td>
                        <router-link :to="'/ticket_edit/' + item.ticket_id" title="票券編輯">
                            <button class="edit_btn">
                                <Icon type="md-create" />
                            </button>
                        </router-link>
                    </td>
                    <td>
                        <!-- @click="saveData()" -->
                        <button @click="saveData()">
                            <Icon type="md-trash" />
                        </button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>
  
<script>
import { mapActions, mapGetters } from 'vuex';
import axios from 'axios';
export default {
    data() {
        return {
            sortType: '',
            sortIcon: 'md-arrow-dropdown',
            searchText: '',
        };
    },
    methods: {
        ...mapActions(['fetchTicketData']),
        //排序
        sortBy(column, sortType) {
            this.sortType = sortType;
            this.sortIcon = this.sortIcon === 'md-arrow-dropdown' ? 'md-arrow-dropup' : 'md-arrow-dropdown';
            this.ticketData.sort((a, b) => {
                const aValue = a[column];
                const bValue = b[column];
                if (this.sortType === 'no') {
                    return this.sortIcon === 'md-arrow-dropdown' ? aValue - bValue : bValue - aValue;
                } else if (this.sortType === 'top') {
                    return this.sortIcon === 'md-arrow-dropdown' ? bValue - aValue : aValue - bValue;
                } else if (this.sortType === 'date') {
                    return this.sortIcon === 'md-arrow-dropdown' ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
                }
            });
        },
        // deleteRow(index) {
        //     const item = this.ticketData[index];
        //     axios.delete(`http://localhost/DailyTW_Backstage/public/phpfile/TicketList.php?id=${item.ticket_id}`)
        //         .then(response => {
        //             console.log('数据已从数据库删除', response.data);
        //             this.ticketData.splice(index, 1);
        //         })
        //         .catch(error => {
        //             console.error('删除数据时出错', error);
        //         });
        // },
        saveData() {
            const saveData = JSON.stringify(this.ticketData); // 将数据转换为 JSON 字符串
            // 发送 POST 请求以保存新数据
            axios.post('http://localhost/DailyTW_Backstage/public/phpfile/TicketList.php', saveData, {
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    swal("資料已保存", "", "success");
                    console.log('資料已保存', response.data);
                })
                .catch(error => {
                    console.error('儲存錯誤', error);
                });
        },
    },

    computed: {
        ...mapGetters(['ticketData']),
    },
    mounted() {
        this.fetchTicketData();// 调用 Vuex 的 fetchTicketData action
    }
};
</script>
  