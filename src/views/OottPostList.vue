<template>
    <div class="main_content">
        <h3>穿搭管理</h3>
        <div class="action_container">
            <div class="selection_box">
                <span>審核狀態</span>
                <Select v-model="selectRegion">
                    <Option v-for="item in reviewList" :value="item.value" :key="item.value">{{ item.label }}</Option>
                </Select>
            </div>
            <div class="searchbar">
                <input type="text" name="search" id="search" placeholder="請輸入關鍵字" />
                <button class="btn">搜尋</button>
            </div>
            <!-- <button class="btn">
          <span>
            <Icon type="md-add" />
            新增穿搭
          </span>
        </button> -->
        </div>
        <div class="table_wrap">
            <table>
                <tr>
                    <th></th>
                    <th>
                        <button>
                            NO.
                            <Icon type="md-arrow-dropdown" />
                        </button>
                    </th>
                    <th>作者</th>
                    <th>更新日期</th>
                    <th>上架狀態</th>
                    <th>審核狀態</th>
                    <th>審核</th>
                </tr>
                <tr v-for="(item, index) in tableData" :key="index">
                    <td>
                        <button>
                            <Icon type="md-flag" />
                        </button>
                    </td>
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.mem_name }}</td>
                    <td>{{ item.oott_date }}</td>
                    <td>
                        <!-- 上架狀態 -->
                        <Switch size="large" v-model="item.status">
                            <template #open>
                                <span>ON</span>
                            </template>
                            <template #close>
                                <span>OFF</span>
                            </template>
                        </Switch>
                    </td>
                <!-- 審核狀態 -->
                    <td v-if="item.oott_review_status == 0" >
                        審核中
                    </td>
                    <td v-if="item.oott_review_status == 1" >
                        已通過
                    </td>
                    <td v-if="item.oott_review_status == 2" >
                        待修改
                    </td>

                    <td>
                        <router-link to="/oott_post_review" v-if="item.oott_review_status == 0">
                            <button>
                                <Icon type="md-eye" />
                            </button>
                        </router-link>
                    </td>
                </tr>
            </table>
        </div>
        <div class="post_popbox">
            <div class="post_wrap">
                <h4>檢視貼文</h4>
                <div class="post_content">
                    <div class="post_photo">
                        <img src="https://picsum.photos/279/369/?random=10">
                    </div>
                        <!-- 右方文字內容 -->
                    <div class="post_text">
                        <!-- 用戶資料 -->
                        <div class="post_profile">
                            <div class="profile_photo">
                                <img src="https://picsum.photos/200/200/?random=10">
                            </div>
                            <h5 class="profile_name">用戶暱稱</h5>
                        </div>
                        <div class="post_desc">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Autem iusto impedit modi accusamus veritatis ratione ut eaque similique illo optio provident suscipit natus temporibus nulla et, fugit qui adipisci earum.
                        </div>

                        <!-- 標籤，可以從前面的頁面拿過來 -->

                        <p class="post_date">2023年7月3日</p>
                    </div>
                </div>
                <div class="button_area">
                    <button class="btn">回列表</button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';


export default {
    data() {
        return {
            tableData: [
                { type: "休閒", description: "2023-08-03", state: "審核中" },
                { type: "休閒", description: "2023-08-03", state: "審核中" },
                { type: "休閒", description: "2023-08-03", state: "審核中" },
                { type: "休閒", description: "2023-08-03", state: "審核中" },
                { type: "休閒", description: "2023-08-03", state: "審核中" },
            ],
            reviewList: [
                {
                    value: "審核中",
                    label: "審核中",
                },
                {
                    value: "已通過",
                    label: "已通過",
                },
                {
                    value: "未通過",
                    label: "未通過",
                },
            ],
        };
    },
    methods: {
        deleteRow(index) {
            this.tableData.splice(index, 1);
        },
        // You can add other methods for handling backend data retrieval, update, etc.
        test(){
            console.log(this.tableData.oott_review_status);
        }
    },
    mounted() {
        axios
        .get(`${this.$URL}/OottPostList.php`)
            .then((res) => {
                console.log(res.data);
                this.tableData = res.data;
            })
            .catch((err) => {
                console.log(err);
            })
    }
};
</script>

<style lang="scss" scoped>
.action_container {
    padding-top: 20px;

    .selection_box {
        position: relative;
        width: 120px;

        span {
            position: absolute;
            bottom: 100%;
            left: 0;
        }
    }
}

.post_popbox {
    display: flex;
    // 完成功能之後拿掉
    display: none;
    
    width: 100%;
    height: 100vh;
    background-color: #6a5d4a80;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 9999;
    align-items: center;
    justify-content: center;
    .post_wrap{
        width: 1000px;
        background-color:#fefff5; 
        padding: 48px;
        margin: 80px; 
        .post_content{
            margin: 40px 0;
            display: flex;
            gap: 40px;
            .post_text{
                display: flex;
                flex-direction: column;
                .post_profile{
                    display: flex;
                    align-items: center;
                    gap: 22px;
                    .profile_photo{
                        width: 120px;
                        height: 120px;
                        border-radius: 50%;
                        overflow: hidden;
                        img{
                            width: 100%;
                        }
                    }
                }
                .post_desc{
                    margin-top: 20px;
                    flex-grow: 1;
                }
                .post_date{
                    margin-top: auto;
                }
            }
        }
        .button_area{
                display: flex;
                justify-content: end;
            }
    }
}
</style>
