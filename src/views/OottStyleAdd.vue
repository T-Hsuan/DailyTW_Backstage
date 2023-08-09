<template>
    <div class="main_content">
        <h3>穿搭類型新增</h3>
        <div class="form_container">
            <!-- 表單欄位用 label 包 -->
            <label for="oott_tag_name">
                <span>穿搭類型</span>
                <input type="text" name="oott_tag_name" id="oott_tag_name">
            </label>
            <label for="oott_tag_desc">
                <span>描述</span>
                <textarea name="oott_tag_desc" id="oott_tag_desc" rows="10"></textarea>
            </label>
        </div>
        <!-- 次頁右下角統一用取消及儲存按鈕 -->
        <div class="btn_wrap">
            <router-link to="/style_mgt">
                <button class="cancel_btn">取消</button>
            </router-link>
            <button class="btn">儲存</button>
        </div>
    </div>
</template>

<script>
import {GET} from '@/plugin/axios'

export default{
    mounted() {
        GET(`${this.$URL}/test.php`)
            .then((res) => {
                console.log(res);
            })
            .catch((err) => {
                console.log(err);
            })
    },
}
</script>