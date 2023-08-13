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
                    <th>會員編號</th>
                    <th>會員姓名</th>
                    <th>聯絡電話</th>
                    <th>會員信箱</th>
                    <th>帳號狀態</th>
                </tr>
 
                <tr v-for="(item, index) in tableData" :key="index" >
                    <td>{{ item.mem_id }}</td>
                    <td>{{ item.mem_name }}</td>
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
        <!-- 切換分頁 -->
        <div class="pages">
            <Page :total="dataLength" v-model="page.index" :page-size="page.size"  />
        </div>
    </div>
</template>
  
<script>
import { GET, POST } from '@/plugin/axios'

export default {
    data() {
        return {
            rawData:[],

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
        //item.mem_name.toLowerCase().includes(this.filterText.toLowerCase()) ||
        // searchData() {
        //     return this.rawData.filter(item => 
        //     item.mem_name.includes(this.filterText) ||
        //         item.mem_id.toString().includes(this.filterText.toLowerCase())
        //     )
        // },
        searchData() {
            return this.rawData.filter(item =>
                (item.mem_name && item.mem_name.includes(this.filterText)) ||
                (item.mem_id && item.mem_id.toString().includes(this.filterText.toLowerCase()))
            );
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
    },
    
    
    mounted() {
        GET(`${this.$URL}/MemberMgt.php`)
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

<!-- <style lang="scss" scoped>
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
</style> -->
  