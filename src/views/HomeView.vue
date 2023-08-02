<template>
    <router-link to="/trip_list">行程列表</router-link>
    <router-link to="/place_add">景點新增</router-link>
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
