<template>
    <div class="order">
        <div class="main_content">
            <h3>訂單內容</h3>
            <div class="cancel">
                <button class="btn">
                <span>取消訂單</span>
                </button>
            </div>
            <div class="order_content" v-for="(item, index) in tableData" :key="index">
                <div class="text"><span class="number">訂單編號：</span>{{ item.order_number }}</div>
                <div class="text"><span>訂購人：</span>{{ item.order_name }}</div>
                <div class="text"><span>訂購人手機號碼：</span>{{ item.order_phone }}</div>
                <div class="text"><span>訂購人地址：</span>{{ item.order_adderss }}</div>
                <div class="text"><span>收件人：</span>{{ item.recipient_name }}</div>
                <div class="text"><span>收件人手機號碼：</span>{{ item.recipient_phone }}</div>
                <div class="text"><span>收件人地址：</span>{{ item.recipient_address }}</div>
            </div>
            <div class="tickit_block">
                <div class="table_wrap" v-for="(item, index) in ticketData" :key="index">
                    <table class="tickit_block">
                        <tr>
                            <th>票券{{ index + 1 }}</th>
                        </tr>
                        <tr>
                            <td><span>票券名稱:</span>{{ item.tickit }}</td>
                            <td><span>全票票數:</span>{{ item.adult }}張</td>
                            <td><span>優待票數:</span>{{ item.discount }}張</td>
                            <td class="subtotal"><span>金額:</span>{{ item.price }}元</td>
                        </tr>
                    </table>
                </div>
                <div class="total_price">總金額:<span>450</span>元</div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            tableData: [
                {   order_number: 'ghguhr12344564', 
                    order_name: '陳小妮', 
                    order_phone: '0912345678', 
                    order_adderss: '320桃園市中壢區復興路46號9樓', 
                    recipient_name: '陳小妮', 
                    recipient_phone: '0912345678' ,
                    recipient_address: '320桃園市中壢區復興路46號9樓' 
                },

            ],
            ticketData:[
                {
                    tickit:'班比山丘門票',
                    adult:'1',
                    discount:'2',
                    price:'200',
                },
                {
                    tickit:'茶山房肥皂文化體驗',
                    adult:'1',
                    discount:'0',
                    price:'250',
                },
            ],
        };
    },
    methods: {
    },
};
</script>
<style lang="scss" scoped>
@import "@/assets/scss/main.scss";
.order{
    .cancel{
        display: flex;
        justify-content: end;
    }
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