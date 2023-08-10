<template>
    <div class="main_content">
        <h3>票券新增</h3>
        <div class="form_container">
            <!-- 上傳照片預覽及刪除 -->
            <div class="img_wrap">
                <div class="img_box">
                    <label for="place_img1">
                        <span>景點照片</span>
                        <div class="upload_click">
                            <Icon type="ios-camera" />
                            <img v-if="uploadedImage1" :src="uploadedImage1" width="200" />
                        </div>
                        <input type="file" name="place_img1" id="place_img1" ref="fileInput1" @change="onfile(1)">
                    </label>
                    <button v-if="uploadedImage1" class="delete_img" @click="deleteImage(1)">
                        <Icon type="md-close-circle" />
                    </button>
                </div>
            </div>
            <div class="text_wrap">
                <!-- 票券名稱 -->
                <label for="ticket_name">
                    <span>票券名稱</span>
                    <input type="text" name="ticket_name" id="ticket_name" placeholder="請輸入票券名稱">
                </label>
                <!-- 景點地區 -->
                <div class="selection_box">
                    <span>景點地區</span>
                    <Select v-model="selectRegion">
                        <Option v-for="name in region_name" :value="name" :key="name">{{ name }}</Option>
                    </Select>
                </div>
            </div>
            <!-- 景點類型 -->
            <div class="selection_box">
                <span>景點類型(多選)</span>
                <Select v-model="selectTags" multiple>
                    <Option v-for="tag in place_tag" :value="tag.place_tag_name" :key="tag.place_tag_name">{{
                        tag.place_tag_name
                    }}</Option>
                </Select>
            </div>
            <div class="selection_wrap">
                <label for="ticket_adult">
                    <span>全票售價</span>
                    <input type="number" name="ticket_adult" id="ticket_adult">
                </label>
                <label for="ticket_ex">
                    <span>優待票售價</span>
                    <input type="number" name="ticket_ex" id="ticket_ex">
                </label>
                <label for="ticket_discount">
                    <span>折扣</span>
                    <input type="number" name="ticket_discount" id="ticket_discount">
                </label>
            </div>
            <!-- 票券描述 -->
            <label for="ticket_desc">
                <span>票券描述</span>
                <textarea name="ticket_desc" id="ticket_desc" rows="10" placeholder="請輸入票券描述"></textarea>
            </label>

            <label for="ticket_notice">
                <span>注意事項</span>
                <textarea name="ticket_notice" id="ticket_notice" rows="10"
                    placeholder="請輸入票券描述">單日門票有效期：
請注意，此門票僅限於2023年12月31日前入園。請務必參閱官方時間表，確認景點的最新開放日期與時間，並確保在有效期內使用門票。
禁止轉售：
門票僅限持票人使用，不可進行轉售或嘗試轉售。任何發現的轉售行為，無論成功與否，將導致門票作廢，並可能面臨法律追究。
身份證明：
兌換門票或進入景點時，請攜帶有效的身份證明文件，以核實您的身份。根據本公司的要求，可能需要出示票券或購票憑據以及個人身份證明文件。請遵守以上注意事項，確保您的入場體驗順利且安全。如有其他驗證安排或細則，請查閱相關的官方公告以瞭解更多資訊。</textarea>
            </label>
        </div>
        <!-- 次頁右下角統一用取消及儲存按鈕 -->
        <div class="btn_wrap">
            <router-link to="/ticket_list">
                <button class="cancel_btn">取消</button>
            </router-link>
            <button class="btn">儲存</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            region_name: ["新北", "臺北", "基隆", "桃園", "新竹", "苗栗", "臺中", "彰化", "雲林", "嘉義", "南投", "臺南", "高雄", "屏東", "宜蘭", "花蓮", "臺東", "澎湖", "金門", "馬祖"],
            place_tag: [
                { place_tag_name: "#親子" },
                { place_tag_name: "#情侶" },
                { place_tag_name: "#小資" },
                { place_tag_name: "#風景" },
                { place_tag_name: "#樂園" },
                { place_tag_name: "#農場" },
                { place_tag_name: "#藝文" },
                { place_tag_name: "#山林" },
                { place_tag_name: "#海邊" },
                { place_tag_name: "#放鬆" },
                { place_tag_name: "#懷舊" },
            ],
            uploadedImage1: '',
            uploadedImages: [],
        }
    },
    methods: {
        onfile(imageNumber) {
            const inputRef = `fileInput${imageNumber}`;
            const imageProp = `uploadedImage${imageNumber}`;
            const newFile = this.$refs[inputRef].files[0];
            // Check if the file is already uploaded
            if (!this.isImageUploaded(newFile)) {
                this.file = newFile;
                let filereader = new FileReader();
                filereader.readAsDataURL(this.file);
                filereader.addEventListener("load", () => {
                    this[imageProp] = filereader.result;
                    this.uploadedImages.push(newFile); // Add the file to the list
                    console.warn(this[imageProp]);
                });
            } else {
                alert("請勿上傳重複照片");
            }
        },
        deleteImage(imageNumber) {
            const imageProp = `uploadedImage${imageNumber}`;
            const inputRef = `fileInput${imageNumber}`;
            const deletedFile = this.$refs[inputRef].files[0];
            // Remove the deleted file from the uploadedImages array
            this.uploadedImages = this.uploadedImages.filter(
                (file) => file !== deletedFile
            );
            this[imageProp] = '';
            this.$refs[inputRef].value = '';
        },
        isImageUploaded(file) {
            return this.uploadedImages.some(uploadedFile =>
                uploadedFile.name === file.name && uploadedFile.size === file.size
            );
        },
    },
    mounted() {

    }
}
</script>

<style lang="scss" scoped>
.main_content {
    .img_wrap .img_box label .upload_click {
        width: 275px;
        height: 177px;

        label {
            width: 100%;
        }
    }
}
</style>