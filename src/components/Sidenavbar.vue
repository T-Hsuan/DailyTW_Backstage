<template>
    <!-- <nav :class="'SideNav', { 'hidden': Hidden }">
        <dl class="menu">
            <dt class="title">
                <Icon type="md-car" />行程管理
            </dt>
            <dd class="link"><router-link to="/trip_list">行程列表</router-link></dd>
            <dd class="link"><router-link to="/place_list">景點列表</router-link></dd>
            <dd class="link"><router-link to="/place_add">景點新增</router-link></dd>
            <dd class="link"><router-link to="/place_type_mgt">景點類型管理</router-link></dd>

            <dt class="title">
                <Icon type="ios-shirt" />穿搭管理
            </dt>
            <dd class="link"><router-link to="/oott_post_list">穿搭列表</router-link></dd>
            <dd class="link"><router-link to="/style_mgt">穿搭風格管理</router-link></dd>

            <dt class="title">
                <Icon type="md-cash" />票券管理
            </dt>
            <dd class="link"><router-link to="/ticket_list">票券列表</router-link></dd>


            <dt class="title">
                <Icon type="ios-megaphone" />行銷管理
            </dt>
            <dd class="link"><router-link to="/feedback_list">用戶回饋列表</router-link></dd>
            <dd class="link"><router-link to="/subscriber_list">電子報訂閱者列表</router-link></dd>

            <dt class="title">
                <Icon type="md-contact" />會員管理
            </dt>
            <dd class="link"><router-link to="/member_mgt">會員資料管理</router-link></dd>
            <dd class="link"><router-link to="/member_view">會員資料檢視</router-link></dd>
            <dd class="link"><router-link to="/order_list">訂單列表</router-link></dd>

            <dt class="title">
                <Icon type="ios-key" />帳號管理
            </dt>
            <dd class="link"><router-link to="/employee_mgt">帳號權限管理</router-link></dd>
            <dd class="link"><router-link to="/employee_add">新增員工帳號</router-link></dd>
        </dl>
    </nav> -->
    <Menu active-name="1-1" :open-names="['1']" width="278px" :class="{ 'hidden': Hidden }">
        <Submenu name="1">
            <template #title>
                <Icon type="md-car" />
                行程管理
            </template>
            <MenuItem name="1-1"><router-link to="/trip_list">行程列表</router-link></MenuItem>
            <MenuItem name="1-2"><router-link to="/place_list">景點列表</router-link></MenuItem>
            <MenuItem name="1-3"><router-link to="/place_tag">景點類型管理</router-link></MenuItem>

        </Submenu>
        <Submenu name="2">
            <template #title>
                <Icon type="ios-shirt" />
                穿搭管理
            </template>
            <MenuItem name="2-1"><router-link to="/oott_post_list">穿搭列表</router-link></MenuItem>
            <MenuItem name="2-2"><router-link to="/style_mgt">穿搭風格管理</router-link></MenuItem>
        </Submenu>
        <Submenu name="3">
            <template #title>
                <Icon type="md-cash" />
                票券管理
            </template>
            <MenuItem name="3-1"><router-link to="/ticket_list">票券列表</router-link></MenuItem>
        </Submenu>
        <Submenu name="4">
            <template #title>
                <Icon type="ios-megaphone" />
                行銷管理
            </template>
            <MenuItem name="4-1"><router-link to="/feedback_list">用戶回饋列表</router-link></MenuItem>
            <MenuItem name="4-2"><router-link to="/subscriber_list">電子報訂閱者列表</router-link></MenuItem>
        </Submenu>
        <Submenu name="5">
            <template #title>
                <Icon type="md-contact" />
                會員管理
            </template>
            <MenuItem name="5-1"><router-link to="/member_mgt">會員資料管理</router-link></MenuItem>
            <MenuItem name="5-2"><router-link to="/member_view">會員資料檢視</router-link></MenuItem>
            <MenuItem name="5-3"><router-link to="/order_list">訂單列表</router-link></MenuItem>
        </Submenu>
        <Submenu name="6">
            <template #title>
                <Icon type="ios-key" />
                帳號管理
            </template>
            <MenuItem name="6-1"><router-link to="/employee_mgt">帳號權限管理</router-link></MenuItem>
            <MenuItem name="6-2"><router-link to="/employee_add">新增員工帳號</router-link></MenuItem>

        </Submenu>
    </Menu>
</template>
<script>
export default {
    computed: {
        // 判斷是否處於首頁
        Hidden() {
            return this.$route.path === '/';
        }
    }
}
</script>
<style lang="scss">
@import "@/assets/scss/main.scss";

.ivu-menu-vertical {
    width: 278px;
    height: 100vh;
    background: $textColor_default !important;

    // &:hover {
    //     color: $textColor_white;
    //     background: $default_yellow;
    // }

    .ivu-menu-submenu {
        width: 278px;
        background: $textColor_default;
        color: $textColor_white;

        .ivu-menu-submenu-title {
            padding: $sp3;
            font-size: 24px;
            color: $textColor_white;

            &:hover {
                color: $textColor_tint;
            }
        }

        .ivu-menu-submenu-title-active {
            background: $mid_yellow;
        }

        //副選單(連結)
        .ivu-menu {
            .ivu-menu-item {
                width: 278px;
                padding: 0;
                padding-left: 0 !important;
                font-size: 20px;
                font-weight: normal;
                color: $textColor_white;

                &:hover {
                    color: $textColor_tint;
                }

                a {
                    display: inline-block;
                    width: 278px;
                    padding: $sp2 $sp3;
                    padding-left: 43px;
                    color: $textColor_white;
                }
            }

            .ivu-menu-item-active {
                color: $textColor_white !important;
                background: $mid_yellow !important;

                &::after {
                    background: $textColor_white !important;
                }
            }
        }
    }
}

// .SideNav {
//     width: 278px;
//     // height: 100vh;
//     padding-top: $sp3;
//     display: flex;
//     flex-direction: column;
//     background: $textColor_default;

//     .menu {
//         width: 100%;

//         .title {
//             margin: $sp2 0;
//             padding-left: 52px;
//             font-size: 24px;
//             color: $textColor_white;

//             .ivu-icon {
//                 font-size: 24px;
//                 margin-right: $sp2;
//             }
//         }

//         .link {

//             a {
//                 display: inline-block;
//                 width: 100%;
//                 line-height: 50px;
//                 padding-left: 57px;
//                 font-size: 20px;
//                 color: $textColor_white;

//                 &:hover {
//                     background: $mid_yellow;
//                 }
//             }
//         }
//     }
// }

.hidden {
    display: none !important;
    ;
}
</style>