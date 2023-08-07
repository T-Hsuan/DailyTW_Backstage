<template>
    <div class="main_content">
        <h3>景點編輯</h3>
        <div class="form_container">
            <form @submit.prevent="saveChanges">
                <!-- 表單欄位用 label 包 -->
                <label for="place_name">
                    <span>景點名稱</span>
                    <input type="text" v-model="placeData.name" name="place_name" id="place_name">
                </label>
                <!-- 下拉選單用 .select_box 包 -->
                <div class="selection_box">
                    <span>景點類型(多選)</span>
                    <Select v-model="selectTags" multiple>
                        <Option v-for="item in tagList" :value="item.value" :key="item.value">{{ item.label }}</Option>
                    </Select>
                </div>
                <!-- 在同一列的下拉選單用 .selection_wrap 包 -->
                <div class="selection_wrap">
                    <div class="selection_box">
                        <span>地區</span>
                        <Select v-model="selectRegion">
                            <Option v-for="item in regionList" :value="item.value" :key="item.value">{{ item.label }}</Option>
                        </Select>
                    </div>
                    <div class="selection_box">
                        <span>停留時間(hr)</span>
                        <Select v-model="selectTime">
                            <Option v-for="item in timeList" :value="item.value" :key="item.value">{{ item.label }}</Option>
                        </Select>
                    </div>
                </div>
                <label for="place_addr">
                    <span>景點地址</span>
                    <input type="text" name="place_addr" id="place_addr">
                </label>
                <label for="place_link">
                    <span>景點連結</span>
                    <input type="text" name="place_link" id="place_link">
                </label>
                <label for="place_desc">
                    <span>景點描述</span>
                    <textarea name="place_desc" id="place_desc" rows="10"></textarea>
                </label>
                <!-- 上傳照片預覽及刪除 -->
                <div class="img_wrap">
                    <div class="img_box">
                        <label for="place_img1">
                            <span>景點照片1(必選)</span>
                            <div class="upload_click">
                                <Icon type="ios-camera" />
                                <img
                                    v-if="uploadedImage1"
                                    :src="uploadedImage1" 
                                    width="200"
                                />
                            </div>
                            <input type="file" name="place_img1" id="place_img1" ref="fileInput1" @change="onfile(1)">
                        </label>
                        <button v-if="uploadedImage1" class="delete_img" @click="deleteImage(1)">
                            <Icon type="md-close-circle" />
                        </button>
                    </div>
                    <div class="img_box">
                        <label for="place_img2">
                            <span>景點照片2</span>
                            <div class="upload_click">
                                <Icon type="ios-camera" />
                                <img
                                    v-if="uploadedImage2"
                                    :src="uploadedImage2" 
                                    width="200"
                                />
                            </div>
                            <input type="file" name="place_img2" id="place_img2" ref="fileInput2" @change="onfile(2)">
                        </label>
                        <button v-if="uploadedImage2" class="delete_img" @click="deleteImage(2)">
                            <Icon type="md-close-circle" />
                        </button>
                    </div>
                    <div class="img_box">
                        <label for="place_img3">
                            <span>景點照片3</span>
                            <div class="upload_click">
                                <Icon type="ios-camera" />
                                <img
                                    v-if="uploadedImage3"
                                    :src="uploadedImage3" 
                                    width="200"
                                />
                            </div>
                            <input type="file" name="place_img3" id="place_img3" ref="fileInput3" @change="onfile(3)">
                        </label>
                        <button v-if="uploadedImage3" class="delete_img" @click="deleteImage(3)">
                            <Icon type="md-close-circle" />
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- 次頁右下角統一用取消及儲存按鈕 -->
        <div class="btn_wrap">
            <router-link to="/place_list">
                <button class="cancel_btn">取消</button>
            </router-link>
            <button type="submit" class="btn">儲存</button>
        </div>
    </div>
</template>

<script>
export default{
    data(){
        return{
            placeData: {
                name: '',
                // Add other fields here as needed
            },
            tagList: [
                {
                    value: '親子',
                    label: '親子'
                },
                {
                    value: '情侶',
                    label: '情侶'
                },
                {
                    value: '小資',
                    label: '小資'
                },
                {
                    value: '風景',
                    label: '風景'
                },
                {
                    value: '樂園',
                    label: '樂園'
                },
                {
                    value: '藝文',
                    label: '藝文'
                },
                {
                    value: '山林',
                    label: '山林'
                },
                {
                    value: '海邊',
                    label: '海邊'
                },
                {
                    value: '放鬆',
                    label: '放鬆'
                },
                {
                    value: '懷舊',
                    label: '懷舊'
                },
                {
                    value: '農場',
                    label: '農場'
                },
            ],
            selectTags: [],
            regionList: [
                {
                    value: '台北',
                    label: '台北'
                },
                {
                    value: '新北',
                    label: '新北'
                },
                {
                    value: '基隆',
                    label: '基隆'
                },
                {
                    value: '宜蘭',
                    label: '宜蘭'
                },
                {
                    value: '桃園',
                    label: '桃園'
                },
                {
                    value: '新竹',
                    label: '新竹'
                },
                {
                    value: '苗栗',
                    label: '苗栗'
                },
                {
                    value: '台中',
                    label: '台中'
                },
                {
                    value: '彰化',
                    label: '彰化'
                },
                {
                    value: '南投',
                    label: '南投'
                },
                {
                    value: '雲林',
                    label: '雲林'
                },
                {
                    value: '嘉義',
                    label: '嘉義'
                },
                {
                    value: '台南',
                    label: '台南'
                },
                {
                    value: '高雄',
                    label: '高雄'
                },
                {
                    value: '屏東',
                    label: '屏東'
                },
                {
                    value: '花蓮',
                    label: '花蓮'
                },
                {
                    value: '台東',
                    label: '台東'
                },
                {
                    value: '金門',
                    label: '金門'
                },
                {
                    value: '馬祖',
                    label: '馬祖'
                },
                {
                    value: '澎湖',
                    label: '澎湖'
                }
            ],
            selectRegion: '',
            timeList: [
                {
                    value: '0.5',
                    label: '0.5'
                },
                {
                    value: '1',
                    label: '1'
                },
                {
                    value: '1.5',
                    label: '1.5'
                },
                {
                    value: '2',
                    label: '2'
                },
                {
                    value: '2.5',
                    label: '2.5'
                },
                {
                    value: '3',
                    label: '3'
                },
                {
                    value: '3.5',
                    label: '3.5'
                },
                {
                    value: '4',
                    label: '4'
                },
                {
                    value: '4.5',
                    label: '4.5'
                },
                {
                    value: '5',
                    label: '5'
                },
                {
                    value: '5.5',
                    label: '5.5'
                },
                {
                    value: '6',
                    label: '6'
                },
            ],
            selectTime: '',
            uploadedImage1: '',
            uploadedImage2: '',
            uploadedImage3: '',
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
}
</script>