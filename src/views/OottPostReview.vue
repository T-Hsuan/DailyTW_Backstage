<template>
    <div class="main_content">
        <h3>審核貼文</h3>
        <form class="form_container" @submit="submitForm">
            <!-- 表單欄位用 label 包 -->
            <label for="oott_tag_name">
                <span>穿搭類型</span>
                <img src="https://picsum.photos/279/369/?random=10">
            </label>
            <label for="oott_tag_desc">
                <span>描述</span>
                <textarea name="oott_tag_desc" id="oott_tag_desc" rows="10"></textarea>
            </label>
        </form>
        
        <!-- 最下方的送出 -->
        <div class="btn_wrap">
            <router-link to="/oott_post_list">
                <button class="cancel_btn">取消審核</button>
            </router-link>
            <button class="btn" type="submit">完成審核</button>
        </div>
    </div>
</template>

<script>
    export default{
        methods: {
        },
    }
</script>

<style lang="scss" scoped>

</style>