<template>
    <nav>
        <router-link to="/trip_list">行程列表</router-link><br>
        <router-link to="/oott_post_list">穿搭列表</router-link><br>
        <router-link to="/style_mgt">穿搭風格管理</router-link><br>
        <router-link to="/place_list">景點列表</router-link><br>
        <router-link to="/place_add">景點新增</router-link><br>
        <router-link to="/place_type_mgt">景點類型管理</router-link><br>
        <router-link to="/ticket_list">票券列表</router-link><br>
        <router-link to="/order_list">訂單列表</router-link><br>
        <router-link to="/feedback_list">用戶回饋列表</router-link><br>
        <router-link to="/subscriber_list">電子報訂閱者列表</router-link><br>
        <router-link to="/member_mgt">會員管理</router-link><br>
        <router-link to="/employee_mgt">帳號權限管理</router-link><br>
    </nav>
</template>
<style lang="scss" scoped>
@import "@/assets/scss/main.scss";

nav {
    width: 278px;
    height: 100vh;
    padding-top: $sp3;
    display: flex;
    flex-direction: column;
    align-items: center;
    background: $textColor_default;

    a {
        margin: $sp1;
        color: $textColor_white;
    }
}
</style>