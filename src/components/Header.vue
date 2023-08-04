<template>
    <header :class="{ 'hidden': Hidden }">
        <div class="header">
            <router-link to="/">
                <img class="logo" :src="require('@/assets/img/logo.svg')" alt="logo" />
            </router-link>
            <div class="login_info">
                <p>職稱</p>
                <p>姓名</p>
                <button>登出</button>
            </div>
        </div>
    </header>
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
<style lang="scss" scoped>
@import "@/assets/scss/main.scss";

header {
    width: 100%;
    background-color: $textColor_default;

    .header {
        max-width: $xl;
        height: 70px;
        margin: 0 auto;
        padding: 0 $sp3;
        display: flex;
        justify-content: space-between;
        align-items: center;

        .logo {
            margin: 0 $sp2;
        }

        .login_info {
            display: flex;

            p {
                margin: 0 $sp2;
                color: $textColor_white;
            }

            button {
                margin: 0 $sp2;
                color: $textColor_white;
            }
        }
    }
}

.hidden {
    display: none;
}
</style>