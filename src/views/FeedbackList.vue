<template>
    <div class="main_content">
        <h3>用戶回饋列表</h3>
        <div class="action_container">
            <button class="btn" @click="exportToCSV">
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
                        <button @click="sortBy('feedback_id', 'no')">
                            NO.
                            <Icon :type="sortType === 'no' ? sortIcon : 'md-arrow-dropdown'" />
                        </button>
                    </th>
                    <th>姓名</th>
                    <th>email</th>
                    <th>主旨</th>
                    <th>
                        <button @click="sortBy('feedback_date', 'Date')">
                            日期
                            <Icon :type="sortType === 'Date' ? sortIcon : 'md-arrow-dropdown'" />
                        </button>
                    </th>
                </tr>
                <tr v-for="(item, index) in tableData" :key="index" @click="showPopBox(item)">
                    <td>{{ item.feedback_id }}</td>
                    <td>{{ item.feedback_name }}</td>
                    <td>{{ item.feedback_email }}</td>
                    <td>{{ item.feedback_subject}}</td>
                    <td>{{ item.feedback_date}}</td>
                </tr>
            </table>
        </div>
        <div v-if="showFeedback" class="feedback_popbox">
            <div class="feedback_wrap">
                <div class="feedback_content">
                    <h3>用戶回饋</h3>
                    <div class="block">
                        <div class="row">
                            <h5>姓名</h5>
                            <p>{{ selectedFeedback.feedback_name }}</p>
                        </div>
                        <div class="row">
                            <h5>email</h5>
                            <p>{{ selectedFeedback.feedback_email }}</p>
                        </div>
                        <div class="row">
                            <h5>主旨</h5>
                            <p>{{ selectedFeedback.feedback_subject }}</p>
                        </div>
                        <div class="row">
                            <h5>內容說明</h5>
                            <p>{{ selectedFeedback.feedback_cont }}</p>
                        </div>
                    </div>
                </div>
                <button class="btn" @click="closePopBox">關閉</button>
            </div>
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
import {GET} from '@/plugin/axios'

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
            showFeedback: false,
            sortType: '',
            sortIcon: 'md-arrow-dropdown',
            selectedFeedback: null,
        };
    },
    methods: {
        showPopBox(item) {
            this.selectedFeedback = item;
            this.showFeedback = true;
        },
        closePopBox() {
            this.selectedFeedback = null;
            this.showFeedback = false;
        },
        exportToCSV() {
            // Prepare CSV content
            let csvContent = "data:text/csv;charset=utf-8,";

            // Add the table header (column names)
            const headerRow = ["NO.", "姓名", "email", "主旨", "內容說明", "日期"];
            csvContent += headerRow.join(",") + "\r\n";

            // Add table rows (data)
            this.tableData.forEach((item) => {
                const rowData = [item.feedback_id, item.feedback_name, item.feedback_email, item.feedback_subject, item.feedback_cont, item.feedback_date];
                csvContent += rowData.join(",") + "\r\n";
            });

            // Create a hidden link to trigger the file download
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "feedback_list.csv");
            document.body.appendChild(link);

            // Trigger the click event on the link to start the download
            link.click();

            // Remove the link from the document
            document.body.removeChild(link);
        },
        getHome() {
            const startIdx = (this.page.index - 1) * this.page.size;
            const endIdx = startIdx + this.page.size;

            this.tableData = this.rawData.slice(startIdx, endIdx);
        },

        pIndexChange(i) {
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
                } else if (this.sortType === 'Date') {
                    return this.sortIcon === 'md-arrow-dropdown' ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
                }
            });
            this.getHome(); // Refresh paginated data after sorting
        },
    },
    mounted() {
        GET(`${this.$URL}/FeedbackList.php`)
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
        tr{
            cursor: pointer;
        }
        tr:nth-child(1){
            cursor: default;
        }
    }
</style>