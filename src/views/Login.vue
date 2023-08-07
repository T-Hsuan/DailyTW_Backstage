<template>
    <div class="main_content">
        <h2>登入</h2>
        <Login>
            <!-- <label for="username">帳號
                <UserName name="username" placeholder="請輸入帳號" clearable />
            </label>

            <label for="password">密碼
                <Password name="password" password placeholder="請輸入密碼" clearable>
                    <div class="ivu-form-item-error-tip">密碼！</div>
                </Password>
            </label> -->
            <label for="username">帳號
                <Input prefix="ios-contact-outline" name="username" placeholder="請輸入帳號" style="width: auto" clearable />
            </label>
            <label for="password">密碼
                <Input prefix="ios-lock-outline" name="password" type="password" placeholder="請輸入密碼" style="width: auto"
                    clearable />
            </label>
            <div class="demo-auto-login">
                <Checkbox v-model="autoLogin" size="large">記住我</Checkbox>
            </div>
            <router-link to="/trip_list">
                <button type="submit" class="btn">登入</button>
            </router-link>

        </Login>
    </div>
</template>
<script>
export default {
    data() {
        return {
            autoLogin: true
        }
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

