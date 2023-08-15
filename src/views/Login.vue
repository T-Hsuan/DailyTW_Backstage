<template>
    <div class="main_content">
        <h2>登入</h2>
        <Login>
            <label for="account">帳號
                <Input prefix="ios-contact-outline" name="account" placeholder="請輸入帳號" v-model="account" style="width: auto"
                    clearable required />
            </label>
            <label for="password">密碼
                <Input prefix="ios-lock-outline" name="password" type="password" placeholder="請輸入密碼" v-model="psw"
                    style="width: auto" clearable required />
            </label>
            <div class="demo-auto-login">
                <Checkbox v-model="autoLogin" size="large">記住我</Checkbox>
            </div>
            <button type="submit" class="btn" @click="login">登入</button>
        </Login>
    </div>
</template>
<script>
import axios from "axios";
import { POST } from '../plugin/axios.js';
export default {
    data() {
        return {
            autoLogin: true,
            dataFromMySQL: [],

            account: '',
            psw: '',
            isemailValid: true,
            isPasswordValid: true,
            isActive: false,
            showError: false,
        }
    },
    methods: {
        login() {
            if (this.account !== "" && this.psw !== "") {
                let url = `${this.$URL}/login.php`;
                let params = new URLSearchParams();
                params.append("account", this.account);
                //"account"跟login.php的$account = $_POST["account"]; 做呼應
                params.append("psw", this.psw);

                POST(url, params).then((res) => {
                    console.log("res", res)
                    console.log("res.manager_name",res.manager_name)
                    if (res == 0) {
                        swal("帳號密碼錯誤", "請再試一次", "error")
                    } else {
                        this.$store.commit("setName", res.manager_name);
                        this.$store.state.isLogin = true;
                        // this.$store.commit('setIsLogin', true); // 使用 commit 來改變狀態
                        this.$store.commit("setLoginData", res);
                        swal("登入成功", "歡迎回來", "success")
                        this.$router.push('/place_list');
                        this.account = ''
                        this.psw = ''
                    }
                });
            } else if (this.account === "" && this.psw === "") {
                swal("請輸入帳號密碼", "", "error")
            }
            else if (this.account === "") {
                swal("請輸入帳號", "", "error")
            }
            else if (this.psw === "") {
                swal("請輸入密碼", "", "error")
            }
        },
    }
}
</script>
<style lang="scss">
@import "@/assets/scss/main.scss";

.main_content {
    display: flex;
    flex-direction: column;
    margin: 0 auto;

    h2 {
        margin: 40px;
        text-align: center;
    }

    .ivu-login {
        margin: 0 auto;
        padding: 30px 0;
        text-align: center;

        .ivu-form {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            margin: 40px;

            label {
                display: inline-flex;
                align-items: center;
                margin-bottom: 24px;

                .ivu-input-wrapper {
                    margin-left: 16px;

                    .ivu-input-prefix {
                        .ivu-icon {
                            line-height: 50px;
                            margin: 0 8px;
                            color: $textColor_default;
                        }
                    }

                    .ivu-input {
                        height: 50px;
                        padding-left: 36px;
                        color: $textColor_default;

                    }

                    .ivu-input-icon-clear {
                        line-height: 50px;
                        margin: 0 8px;
                    }
                }

                // .ivu-form-item {
                //     margin-bottom: 0;

                //     .ivu-input-wrapper {
                //         line-height: 50px;
                //         margin-left: 16px;

                //         .ivu-icon {
                //             margin: 0 8px;
                //             line-height: 50px;
                //         }

                //         .ivu-input {
                //             line-height: 50px;
                //             padding-left: 36px;
                //             color: $textColor_default;
                //         }
                //     }
                // }

            }

            .demo-auto-login {
                margin-bottom: 24px;
                text-align: left;

                .ivu-checkbox-wrapper {
                    margin-left: $sp7;

                    .ivu-checkbox {
                        .ivu-checkbox-inner {
                            background-color: $bgColor_tint;
                            border-color: $textColor_default;
                        }
                    }

                    .ivu-checkbox-checked {
                        .ivu-checkbox-inner {
                            background-color: $textColor_default;
                            border-color: $textColor_default;
                        }
                    }
                }
            }
        }

    }


}
</style>

