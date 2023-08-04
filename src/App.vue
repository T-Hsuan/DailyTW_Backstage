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
export default {
    components: {
        Header,
        Sidenavbar,
    }
};
</script>
<style lang="scss">
#app {

    //   font-family: Avenir, Helvetica, Arial, sans-serif;
    //   -webkit-font-smoothing: antialiased;
    //   -moz-osx-font-smoothing: grayscale;
    //   text-align: center;
    //   color: #2c3e50;
    main {
        max-width: 1200px;
        margin: auto;
        display: flex;
    }
}

// nav {
//   padding: 30px;

//   a {
//     font-weight: bold;
//     color: #2c3e50;

//     &.router-link-exact-active {
//       color: #42b983;
//     }
//   }
// }
</style>
