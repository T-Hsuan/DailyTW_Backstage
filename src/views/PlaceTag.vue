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
                    <th>NO.</th>
                    <th>景點類型</th>
                    <th>描述</th>
                    <th>標籤狀態</th>
                    <th>刪除</th>
                </tr>
                <tr v-for="(item, index) in tableData" :key="index">
                    <td>{{ item.place_tag_id }}</td>
                    <td>{{ item.place_tag_name }}</td>
                    <td>{{ item.place_tag_desc }}</td>
                    <td>
                        <Switch size="large" v-model="item.place_tag_status" true-value="1" false-value="0" @on-change="updatePlaceTagStatus(item)">
                            <template #open>
                                <span>ON</span>
                            </template>
                            <template #close>
                                <span>OFF</span>
                            </template>
                        </Switch>
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
        };
    },
    computed: {
        //資料分頁
        tableData() {
            return this.rawData.slice((this.page.index - 1) * this.page.size, this.page.index * this.page.size);
        },
        dataLength() {
            return this.rawData.length;
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
        async deleteRow(rowIndex) {
            const rawDataIndex = (this.page.index - 1) * this.page.size + rowIndex;
            const placeTagId = this.rawData[rawDataIndex].place_tag_id;
            this.rawData.splice(rawDataIndex, 1);

            // Send a request to your server to update the database
            try {
                await this.deleteOnServer(placeTagId);
            } catch (error) {
                console.error('Error deleting place:', error);
            }
        },
        async deleteOnServer(placeTagId) {
            try {
                const response = await axios.get(`${this.$URL}/PlaceTagDelete.php?place_tag_id=${placeTagId}`);
                console.log('Place tag deleted on server:', response.data);
            } catch (error) {
                console.error('Error deleting place tag on server:', error);
            }
        },

        //更新資料狀態
        async updatePlaceTagStatus(item) {
            const newStatus = item.place_tag_status === '1' ? '1' : '0';
            const placeTagId = item.place_tag_id;
            try {
                const status = await axios.get(`${this.$URL}/PlaceTagStatus.php?place_tag_id=${placeTagId}&place_tag_status=${newStatus}`);
                console.log('Place tag status updated on server', status.data);
            } catch (error) {
                console.error('Error updating place tag status:', error);
            }
        },
    },
    mounted() {
        GET(`${this.$URL}/PlaceTag.php`)
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
  