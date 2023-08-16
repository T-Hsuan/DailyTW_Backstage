<template>
    <div class="main_content">
        <h3>會員資料管理</h3>
        <div class="action_container">
            <div class="searchbar">

                <input  v-model="searchText"
                type="text" 
                name="search" 
                id="search" 
                placeholder="請輸入關鍵字" />
                <button class="btn" @click="search">搜尋</button>
            </div>
        </div>
        <div class="table_wrap">
            <table>
                <tr>
                    <th>NO.</th>
                    <th>會員姓名</th>
                    <th>聯絡電話</th>
                    <th>會員信箱</th>
                    <th>帳號狀態</th>
                </tr>
 
                <tr v-for="(item, index) in tableData" :key="index" >
                    <td>{{ index + 1 }}</td>
                    <td class="member_name" @click="openLightbox(item)">{{ item.mem_name }}</td>
                    <td>{{ item.mem_phone }}</td>
                    <td>{{ item.mem_email }}</td>
                    <td>
                        <Switch size="large" v-model="item.mem_status" true-value="1" false-value="0">
                            <template #open>
                                <span>ON</span>
                            </template>
                            <template #close>
                                <span >OFF</span>
                            </template>
                        </Switch>
                    </td>
                </tr>
                
                
                    
                </table>    
        </div>
        <div class="feedback_popbox" v-if="lightboxVisible">
            <div class="feedback_wrap">
                <h3>會員資料檢視</h3>

                <div class="feedback_content">
                    <div class="profile_photo">
                                <img :src="getMemberProfilePath()">
                            </div>
                    <!-- <div class="post_text"> -->
                        <!-- 會員資料 -->
                        <!-- <div class="post_profile"> -->
                            
                            <div class="block">
                                <div class="row">
                                    <h5>姓名</h5>
                                <p class="profile_name">{{ selectedUser.mem_name }}</p>
                                </div>
                                <div class="row">
                                    <h5>電話</h5>
                                <p class="profile_name">{{ selectedUser.mem_phone }}</p>
                                </div>
                                <div class="row">
                                    <h5>Email</h5>
                                <p class="profile_name">{{ selectedUser.mem_email  }}</p>
                                </div>
                                <div class="row">
                                    <h5>會員狀態</h5>
                            <p class="profile_name">{{ selectedUser.mem_status }}</p>
                                </div>
                            </div>
                        <!-- </div> -->

                    <!-- </div> -->
                </div>
                <div class="button_area">
                    <button class="btn" @click="closeLightbox">回列表</button>
                </div>

            </div>
        </div>
        <!-- 切換分頁 -->
        <!-- <div class="pages">
            <Page :total="dataLength" v-model="page.index" :page-size="page.size"  />
        </div> -->
    </div>
</template>
  
<script>
import axios from 'axios';

export default {
    data() {
        return {
            rawData:[],

            // page: {
            //     index: 1, //當前分頁
            //     size: 20, //一頁多少筆資料
            // },
            // sortType: '',
            // sortColumn: '',
            // sortIcon: 'md-arrow-dropdown',
            // searchText: '',
            // filterText: '',
            //
            tableData: [],
            selectedUser: null,
            lightboxVisible: false,
        
        };
    },

    computed: {
        //搜尋結果資料
        //item.mem_name.toLowerCase().includes(this.filterText.toLowerCase()) ||
        // searchData() {
        //     return this.rawData.filter(item => 
        //     item.mem_name.includes(this.filterText) ||
        //         item.mem_id.toString().includes(this.filterText.toLowerCase())
        //     )
        // },
        // searchData() {
        //     return this.rawData.filter(item =>
        //         (item.mem_name && item.mem_name.includes(this.filterText)) ||
        //         (item.mem_id && item.mem_id.toString().includes(this.filterText.toLowerCase()))
        //     );
        // },
        //資料排序
        // sortData() {
        //     const arr= [...this.searchData];
        //     return arr.sort((a, b) => {
        //         const aValue = a[this.sortColumn];
        //         const bValue = b[this.sortColumn];
        //         if (this.sortType === 'no') {
        //             return this.sortIcon === 'md-arrow-dropdown' ? aValue - bValue : bValue - aValue;
        //         } else if (this.sortType === 'updateDate' || this.sortType === 'stayTime') {
        //             return this.sortIcon === 'md-arrow-dropdown' ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
        //         }
        //     });
        // },
        //資料分頁
        // tableData() {
        //     return this.sortData.slice((this.page.index - 1) * this.page.size, this.page.index * this.page.size);
        // },
        // dataLength() {
        //     return this.searchData.length;
        // },
    },

    methods: {
        
        //排序
        // sortBy(column, sortType) {
        //     this.sortType = sortType;
        //     this.sortColumn = column;
        //     this.sortIcon = this.sortIcon === 'md-arrow-dropdown' ? 'md-arrow-dropup' : 'md-arrow-dropdown';
        // },

        //搜尋
        // search() {
        //     const searchTerm = this.searchText.toLowerCase();
        //     this.filterText = searchTerm;
        //     this.page.index = 1;
        // },

        // lightbox control
        openLightbox(item) {
            this.selectedUser = item;
            this.lightboxVisible = true;
        },
        closeLightbox() {
            this.selectedUser = null;
            this.lightboxVisible = false;
        },

        deleteRow(index) {
            this.tableData.splice(index, 1);
        },


        getMemberProfilePath(){
            return `${this.$IMG_URL}/profileImg/${this.selectedUser.mem_img}.png`;  
        },
    },
    
    
    mounted() {
        axios
            .get(`${this.$URL}/MemberMgt.php`)
            .then((res) => {
                console.log(res.data);
                this.tableData = res.data;
            })
            .catch((err) => {
                console.log(err);
            })
    },
};
</script>

<style lang="scss" scoped>
.member_name {
    cursor: pointer;
    text-decoration: underline;
}


.feedback_content{
    display: flex;
    margin: auto;
    .profile_photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        
        img {
            width: 100%;
        }
    }
}

.button_area {
    width: 100%;
    text-align: right;

}
    



</style>
  