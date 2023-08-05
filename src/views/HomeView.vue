<template>
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
    <router-link to="/member_view">會員資料檢視</router-link><br>
    <router-link to="/employee_mgt">帳號權限管理</router-link><br>
    <router-link to="/employee_add">新增員工帳號</router-link><br>
    <router-link to="/backstage_login">後台登入</router-link><br>
</template>

<script>
// @ is an alias to /src
import HelloWorld from '@/components/HelloWorld.vue'

export default {
    name: 'HomeView',
    components: {
        HelloWorld
    }
}
</script>

