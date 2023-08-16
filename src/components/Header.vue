<template>
    <header :class="{ 'hidden': Hidden }">
        <div class="header">
            <router-link to="/">
                <img class="logo" :src="require('@/assets/img/logo.svg')" alt="logo" />
            </router-link>
            <div class="login_info">
                <!-- 登入後顯示 -->
                <div v-if="isLogin">
                    <p @click="toggleUser">
                        {{ $store.state.name }}
                    </p>
                    <span class="separate">|</span>
                    <p class="logOut" @click="handleLogout">
                        登出
                    </p>
                </div>
                <!-- 未登入狀態 -->
                <!-- <div v-else>
                    <router-link to="/login">
                        <div>{{ $store.state.name }}</div>
                    </router-link>
                </div> -->
            </div>
        </div>
    </header>
</template>
<script>
import { POST } from '../plugin/axios.js';
export default {
    methods: {
        toggleUser() {
            this.$router.push({ path: "/employee_mgt" });
        },
        //登出
        handleLogout() {
            // this.$store.commit('setName', "manage_id");
            this.$store.state.isLogin = false;
            sessionStorage.removeItem("manager_id");
            this.$router.push("/");
            setTimeout(() => {
                this.$router.go(0);

            }, 10)
        },

        //檢查登入狀態
        checkLogin() {
            let managerId = sessionStorage.getItem("manager_id");
            let managerName = sessionStorage.getItem("manager_name");
            console.log("managerId", managerId);
            console.log("this.$store.state.isLogin", this.$store.state.isLogin);

            if (managerId) {
                let URL = `${this.$URL}/sessionLogin.php`;
                let params = new FormData();
                params.append("manager_id", managerId);
                this.$store.commit('setName', managerName);
                this.$store.state.isLogin = true;
                POST(URL, params).then((res) => {
                    console.log(res);
                    this.$store.commit("setLoginData", res);
                });
            } else {
                this.$store.commit('logOut');
            }
        },
    },
    computed: {
        // 判斷是否處於首頁
        Hidden() {
            return this.$route.path === '/';
        },
        isLogin() {
            return this.$store.state.isLogin;
        },
    },
    mounted() {
        this.checkLogin();
    },
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
            div {
                display: flex;
                color: $textColor_white;

                p {
                    cursor: pointer;
                    margin: 0 $sp2;

                }
            }


        }
    }
}

.hidden {
    display: none;
}</style>