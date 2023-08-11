<template>
    <div class="main_content">
        <h3>訂單列表</h3>
        <div class="action_container">
            <div class="searchbar">
                <input type="text" name="search" id="search" placeholder="請輸入關鍵字" />
                <button class="btn">搜尋</button>
            </div>
        </div>

        

        <div class="table_wrap">
            <table>
                <tr>
                    <th>會員編號</th>
                    <th>訂單編號</th>
                    <th>票券名稱</th>
                    <th>
                        下單時間
                        <button>
                            <Icon type="md-arrow-dropdown" />
                        </button>
                    </th>
                    <th>
                        總金額
                        <button>
                            <Icon type="md-arrow-dropdown" />
                        </button>
                    </th>
                    <th>狀態</th>
                </tr>
                <tr v-for="(item, index) in dataFromMySQL" :key="index">
                    <!-- 會員編號 -->
                    <td>{{ item.ord_mem }}</td>
                    <!-- 訂單編號 -->
                    <td>{{ item.ord_id }}</td>
                    <td>{{ item.ord_receiver }}</td>
                    <td>{{ item.ord_date }}</td>
                    <td>{{ item.ord_sum }}</td>
                    <td>{{ item.ord_status }}</td>
                </tr>
            </table>
        </div>
    </div>
</template>
  
<script>
import {GET} from '@/plugin/axios'

export default {
    data() {
        return {
            dataFromMySQL:[],

            //     { number: '1234', tickit: '台北101', member: '王小明', time: '2023-08-01', price: '1200元', state: '取消' },
            
        };
    },
    methods: {
        deleteRow(index) {
            this.tableData.splice(index, 1);
        },
        // You can add other methods for handling backend data retrieval, update, etc.
    },
    mounted() {
        GET(`${this.$URL}/phpfile/OrderList.php`)
            .then((res) => {
                this.dataFromMySQL = res;
                console.log(res);
            })
            .catch((err) => {
                console.log(err);
            })
    },
};
</script>
<style lang="scss">
@import "@/assets/scss/main.scss";

a {
    color: $textColor_default;
    border-bottom: 1px solid $textColor_default;
}</style>