<template>
    <div class="main_content">
        <h3>會員資料管理</h3>
        <div class="action_container">
            <div class="searchbar">
                <!-- v-model="searchText" -->
                <input  
                type="text" 
                name="search" 
                id="search" 
                placeholder="請輸入關鍵字" />
                <button class="btn" @click="applySearch">搜尋</button>
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
 
                <tr v-for="(item, index) in filteredItems" :key="index" >
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.mem_name }}</td>
                    <td>{{ item.mem_phone }}</td>
                    <td>{{ item.mem_email }}</td>
                    <td>
                        <Switch size="large" v-model="item.status">
                            <template #open>
                                <span>ON</span>
                            </template>
                            <template #close>
                                <span >OFF</span>
                            </template>
                        </Switch>
                    </td>
                </tr>
                <!-- <Select v-model="selectedRegions[index]">
                        <Option v-for="region in regionList" :value="region.value" :key="region.value">{{ region.label }}</Option>
                    </Select> -->
                
                    
                </table>
                <p v-if="filteredItems.length === 0" class="ivu-text-center ivu-m">
                    * 沒有找到符合搜尋條件的結果
                </p>
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
            rawData:[],
            tableData: [],
            page: {
                index: 1, //當前分頁
                size: 20, //一頁多少筆資料
                total: 0,
            },
            regionList: [
                {
                    value: '待修改',
                    label: '待修改'
                },
                {
                    value: '審核中',
                    label: '審核中'
                },
                {
                    value: '已發布',
                    label: '已發布'
                },
                
            ],
            selectedRegions: [], // Each select's value is stored in this array
            searchText: '',
        };
    },

    computed: {
    // search
    filteredItems() {
      if (this.searchText === "") {
        return this.rawData;
      }

      return this.rawData.filter((item) =>
        Object.values(item).some((val) => String(val).includes(this.searchText))
      );
    },
  },

    methods: {
        
        applySearch() {
            this.searchText = document.getElementById("search").value;
            this.getHome();
        },
        // deleteRow(index) {
        //     this.tableData.splice(index, 1);
        // },
        // You can add other methods for handling backend data retrieval, update, etc.
        
        getHome() {
            const startIdx = (this.page.index - 1) * this.page.size;
            const endIdx = startIdx + this.page.size;

            this.tableData = this.rawData.slice(startIdx, endIdx);
        },

        pIndexChange(i) {
            this.page.index = i;
            this.getHome();
        },
    },
    
    
    mounted() {
        GET(`${this.$URL}/MemberMgt.php`)
            .then((res) => {
                console.log(res);
                this.rawData = res;
                this.page.total = this.rawData.length;
                this.getHome();
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
  