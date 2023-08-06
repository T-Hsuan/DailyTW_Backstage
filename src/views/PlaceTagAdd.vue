<template>
    <div class="main_content">
        <h3>景點類型新增</h3>
        <div class="form_container">
            <!-- 表單欄位用 label 包 -->
            <label for="place_tag_name">
                <span>景點類型</span>
                <input type="text" name="place_tag_name" id="place_tag_name">
            </label>
            <label for="place_tag_desc">
                <span>描述</span>
                <textarea name="place_tag_desc" id="place_tag_desc" rows="10"></textarea>
            </label>
        </div>
        <!-- 次頁右下角統一用取消及儲存按鈕 -->
        <div class="btn_wrap">
            <router-link to="/place_tag">
                <button class="cancel_btn">取消</button>
            </router-link>
            <button class="btn">儲存</button>
        </div>
    </div>
</template>