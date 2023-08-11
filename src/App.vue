<template>
    <Header></Header>
    <main>
        <Sidenavbar></Sidenavbar>
        <router-view />
    </main>
</template>
<script>
import Header from "@/components/Header.vue";
import Sidenavbar from "@/components/Sidenavbar.vue";
import swal from 'sweetalert';
export default {
    components: {
        Header,
        Sidenavbar,
    }
};
</script>
<style lang="scss">
#app {
    main {
        max-width: 1200px;
        margin: auto;
        display: flex;
    }
}
</style>
