<template>
    <div class="main_content">
        <h3>用戶回饋列表</h3>
        <div class="action_container">
            <button class="btn">
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
                        <button>
                            NO.
                            <Icon type="md-arrow-dropdown" />
                        </button>
                    </th>
                    <th>姓名</th>
                    <th>email</th>
                    <th>主旨</th>
                    <th>
                        <button>
                            日期
                            <Icon type="md-arrow-dropdown" />
                        </button>
                    </th>
                </tr>
                <tr v-for="(item, index) in tableData" :key="index" @click="showPopBox">
                    <td>{{ item.no }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.email }}</td>
                    <td>{{ item.subject }}</td>
                    <td>{{ item.date }}</td>
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
                            <p>陳小妮</p>
                        </div>
                        <div class="row">
                            <h5>email</h5>
                            <p>123456@gmail.com</p>
                        </div>
                        <div class="row">
                            <h5>主旨</h5>
                            <p>旅遊與服裝推薦服務回饋</p>
                        </div>
                        <div class="row">
                            <h5>內容說明</h5>
                            <p>我寫這封信是要向你們表達對你們旅遊與服裝推薦服務的讚賞，我真的非常喜歡你們的服務！<br>首先，你們的網站設計非常好，簡潔明瞭，讓我輕鬆地瀏覽各種旅遊目的地和相關的服裝建議。這讓我能事先準備好適合目的地的穿搭，提升了我的旅行體驗。<br>感謝你們提供如此出色的服務，我會向我的朋友們強烈推薦你們的網站。期待未來更多的旅行冒險和時尚建議！</p>
                        </div>
                    </div>
                </div>
                <button class="btn" @click="closePopBox">關閉</button>
            </div>
        </div>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            tableData: [
                { no: '001', name: '陳小妮', email: '123456@gmail.com', subject: '旅遊與服裝推薦服務回饋', cont:'我寫這封信是要向你們表達對你們旅遊與服裝推薦服務的讚賞，我真的非常喜歡你們的服務！首先，你們的網站設計非常好，簡潔明瞭，讓我輕鬆地瀏覽各種旅遊目的地和相關的服裝建議。這讓我能事先準備好適合目的地的穿搭，提升了我的旅行體驗。感謝你們提供如此出色的服務，我會向我的朋友們強烈推薦你們的網站。期待未來更多的旅行冒險和時尚建議！', date: '2023-08-06' },
                { no: '002', name: '陳小妮', email: '123456@gmail.com', subject: '旅遊與服裝推薦服務回饋', cont:'', date: '2023-08-06' },
                { no: '003', name: '陳小妮', email: '123456@gmail.com', subject: '旅遊與服裝推薦服務回饋', cont:'', date: '2023-08-06' },
                { no: '004', name: '陳小妮', email: '123456@gmail.com', subject: '旅遊與服裝推薦服務回饋', cont:'', date: '2023-08-06' },
                { no: '005', name: '陳小妮', email: '123456@gmail.com', subject: '旅遊與服裝推薦服務回饋', cont:'', date: '2023-08-06' },
                { no: '006', name: '陳小妮', email: '123456@gmail.com', subject: '旅遊與服裝推薦服務回饋', cont:'', date: '2023-08-06' },
            ],
            showFeedback: false,
        };
    },
    methods: {
        showPopBox() {
            this.showFeedback = true;
        },
        closePopBox() {
            this.showFeedback = false;
        },
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