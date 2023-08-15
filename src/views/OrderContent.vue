<template>
    <div class="order">
        <div class="main_content">
            <h3>訂單內容</h3>
            <!-- <div class="cancel">
                <button class="btn">
                <span>取消訂單</span>
                </button>
            </div> -->
            <div class="order_content">
                <div class="text"><span class="number">訂單編號：</span>{{ ordInfo.ord_id }}</div>
                <div class="text"><span>訂購人：</span>{{ ordInfo.mem_name }}</div>
                <div class="text"><span>訂購人手機號碼：</span>{{ ordInfo.mem_phone }}</div>
                <div class="text"><span>收件人：</span>{{ ordInfo.ord_receiver }}</div>
                <div class="text"><span>收件人手機號碼：</span>{{ ordInfo.ord_phone }}</div>
                <div class="text"><span>收件人地址：</span>{{ ordInfo.ord_addr }}</div>
            </div>
            <div class="tickit_block">
                <div class="table_wrap" v-for="(item, index) in itemInfo" :key="index">
                    <table class="tickit_block">
                        <tr>
                            <th>票券{{ index + 1 }}</th>
                        </tr>
                        <tr>
                            <td><span>票券名稱:</span>{{ item.ticket_name }}</td>
                            <td><span>全票票數:</span>{{ item.ticket_adult_count }}張</td>
                            <td><span>優待票數:</span>{{ item.ticket_ex_count}}張</td>
                            <td class="subtotal"><span>金額:</span>{{ item.total }}元</td>
                        </tr>
                    </table>
                </div>
                <div class="total_price">總金額:<span>{{ totalPrice }}</span>元</div>
            </div>
        </div>
    </div>
</template>
<script>
import {GET} from '@/plugin/axios'
export default {
    data() {
        return {
            ordInfo: [],
            itemInfo:[],
            totalPrice: 0,
        };
    },
    mounted() {
        const ordId = this.$route.params.ord_id;
        GET(`${this.$URL}/OrderContent.php?ord_id=${ordId}`)
            .then((res) => {
                this.ordInfo = res;
                console.log(res);
            })
            .catch((err) => {
                console.log(err);
            });
        GET(`${this.$URL}/OrderContentItem.php?ord_id=${ordId}`)
            .then((res) => {
                this.itemInfo = res;
                console.log(res);
            })
            .catch((err) => {
                console.log(err);
            });
    },
    computed: {
        subtotalPrice() {
        return this.itemInfo.reduce(
            (total, item) => total + parseInt(item.total),
            0
        );
        },
    },
    watch: {
        subtotalPrice: {
        handler(newVal) {
            this.totalPrice = newVal;
        },
        immediate: true, 
        },
    },
    
};
</script>
<style lang="scss" scoped>
@import "@/assets/scss/main.scss";
.order{
    // .cancel{
    //     display: flex;
    //     justify-content: end;
    // }
    .order_content{
        .text{
            padding: $sp2 0;
            font-size: $xl_h5;
            span{
                font-size: $xl_h5;
                font-weight: bolder;
                padding: $sp2;
            }
        }

    }
    .table_wrap{
        margin: $sp3 0;
        .tickit_block{
            th{
                text-align: start;
                font-size: $xl_h4;
                font-weight: bolder;
            }
            tr{
                display: flex;
                flex-direction: column;
                td{
                    font-size: $xl_h5;
                    text-align: start;
                    padding: $sp2 $sp1 ;
                    letter-spacing: 1px;
                    span{
                        padding: 0 $sp2;
                        font-weight: bold;
                    }
                }
                .subtotal{
                    font-size: $xl_h4;
                    text-align: end;
                    padding-right: $sp1;
                    letter-spacing: 1px;
                    font-weight: bolder;
                    
                }
                
            }
        }
    }
    .total_price{
        text-align: end;
        font-size: $xl_h4;
        letter-spacing: 1px;
        font-weight: bolder;
        span{
            padding-left: $sp2;
            font-size: $xl_h3;
        }
    }
}
</style>