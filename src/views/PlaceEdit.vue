<template>
    <div class="main_content">
        <h3>景點編輯</h3>
        <div class="form_container">
            <form @submit.prevent="saveChanges" v-if="placeInfo">
                <!-- 表單欄位用 label 包 -->
                <label for="place_name">
                    <span>景點名稱</span>
                    <input type="text" name="place_name" id="place_name" v-model="placeInfo.place_name">
                </label>
                <!-- 下拉選單用 .select_box 包 -->
                <div class="selection_box">
                    <span>景點類型(多選)</span>
                    <Select v-model="selectTags" multiple>
                        <Option v-for="(item, index) in tagList" :value="item.place_tag_name" :key="index">{{ item.place_tag_name }}</Option>
                    </Select>
                </div>
                <!-- 在同一列的下拉選單用 .selection_wrap 包 -->
                <div class="selection_wrap">
                    <div class="selection_box">
                        <span>地區</span>
                        <Select v-model="selectRegion">
                            <Option v-for="(item, index) in regionList" :value="item.region_name" :key="index">{{ item.region_name }}</Option>
                        </Select>
                    </div>
                    <div class="selection_box">
                        <span>停留時間(hr)</span>
                        <Select v-model="selectTime">
                            <Option v-for="(item, index) in timeList" :value="item.place_stay" :key="index">{{ item.place_stay }}</Option>
                        </Select>
                    </div>
                </div>
                <label for="place_addr">
                    <span>景點地址</span>
                    <input type="text" name="place_addr" id="place_addr" v-model="placeInfo.place_addr">
                </label>
                <label for="place_link">
                    <span>景點連結</span>
                    <input type="text" name="place_link" id="place_link" v-model="placeInfo.place_link">
                </label>
                <label for="place_desc">
                    <span>景點描述</span>
                    <textarea name="place_desc" id="place_desc" rows="10" v-model="placeInfo.place_desc"></textarea>
                </label>
                <!-- 上傳照片預覽及刪除 -->
                <div class="img_wrap">
                    <div class="img_box">
                        <label for="place_img1">
                            <span>景點照片1(必選)</span>
                            <div class="upload_click">
                                <Icon type="ios-camera" />
                                <img
                                    v-if="uploadedImage1 || placeInfo.place_img1"
                                    :src="uploadedImage1 || getPlaceImg(placeInfo.place_img1)"
                                />
                            </div>
                            <input type="file" name="place_img1" id="place_img1" ref="fileInput1" @change="onfile(1)">
                        </label>
                        <button v-if="uploadedImage1 || placeInfo.place_img1" class="delete_img" @click="deleteImage(1)">
                            <Icon type="md-close-circle" />
                        </button>
                    </div>
                    <div class="img_box">
                        <label for="place_img2">
                            <span>景點照片2</span>
                            <div class="upload_click">
                                <Icon type="ios-camera" />
                                <img
                                    v-if="uploadedImage2 || placeInfo.place_img2"
                                    :src="uploadedImage2 || getPlaceImg(placeInfo.place_img2)"
                                />
                            </div>
                            <input type="file" name="place_img2" id="place_img2" ref="fileInput2" @change="onfile(2)">
                        </label>
                        <button v-if="uploadedImage2 || placeInfo.place_img2" class="delete_img" @click="deleteImage(2)">
                            <Icon type="md-close-circle" />
                        </button>
                    </div>
                    <div class="img_box">
                        <label for="place_img3">
                            <span>景點照片3</span>
                            <div class="upload_click">
                                <Icon type="ios-camera" />
                                <img
                                    v-if="uploadedImage3 || placeInfo.place_img3"
                                    :src="uploadedImage3 || getPlaceImg(placeInfo.place_img3)"
                                />
                            </div>
                            <input type="file" name="place_img3" id="place_img3" ref="fileInput3" @change="onfile(3)">
                        </label>
                        <button v-if="uploadedImage3 || placeInfo.place_img3" class="delete_img" @click="deleteImage(3)">
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
            <button type="button" class="btn" @click="saveChanges">儲存</button>
        </div>
    </div>
</template>

<script>
import { GET } from '@/plugin/axios';
import  axios  from "axios";

export default{
    data(){
        return{
            placeInfo: null,
            placeData: [],
            tagList: [],
            selectTags: [],
            regionList: [],
            selectRegion: '',
            timeList: [],
            selectTime: '',
            uploadedImage1: '',
            uploadedImage2: '',
            uploadedImage3: '',
            uploadedImages: [],
        }
    },
    methods: {
        //取得單一景點資料
        getPlaceContent(placeId) {
            console.log('[匯入]placeData:', this.placeData);
            return this.placeData.find(item => item.place_id == placeId);
        },
        //修正圖片路徑
        getPlaceImg(placeImg){
            return `${this.$IMG_URL}/placeImg/${placeImg}`;  
        },
        //上傳圖片預覽及刪除
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
            const placeImgProp = `place_img${imageNumber}`;
            const inputRef = `fileInput${imageNumber}`;
            
            if (this.placeInfo[placeImgProp]) {
                // If there's an existing place_img property, clear it
                this.placeInfo[placeImgProp] = null;
            } else {
                // If there's no existing place_img property, remove the uploaded image
                const deletedFile = this.$refs[inputRef].files[0];
                this.uploadedImages = this.uploadedImages.filter(
                    (file) => file !== deletedFile
                );
                this[imageProp] = '';
                this.$refs[inputRef].value = '';
            }
        },
        isImageUploaded(file) {
            return this.uploadedImages.some(uploadedFile =>
                uploadedFile.name === file.name && uploadedFile.size === file.size
            );
        },
        //更新資料庫資料
        // saveChanges() {
        //     // Prepare the data to send to the server
        //     const formData = new FormData();

        //     // Add your other form data here, like place_name, place_tag_group, etc.
        //     formData.append('place_name', this.placeInfo.place_name);
        //     formData.append('place_tag_group', this.selectTags.join(',')); // Convert array to comma-separated string
        //     // ... Add other form fields ...

        //     // Check if uploadedImage1 has changed and needs to be updated
        //     if (this.uploadedImage1) {
        //         formData.append('place_img1', this.uploadedImage1);
        //     } else if (this.placeInfo.place_img1) {
        //         // If there's a previous place_img1 value and no new image uploaded, retain the old value
        //         formData.append('place_img1', this.placeInfo.place_img1);
        //     }

        //     // Repeat the same pattern for uploadedImage2 and uploadedImage3

        //     // Make your API call to update the data
        //     axios.post('/your-update-api-endpoint', formData)
        //         .then(response => {
        //             // Handle the response as needed
        //             console.log('Data updated successfully:', response.data);
        //         })
        //         .catch(error => {
        //             // Handle errors
        //             console.error('Error updating data:', error);
        //         });
        // }
    },
    mounted() {
        GET(`${this.$URL}/PlaceEdit.php`)
            .then((res) => {
                console.log(res);
                this.placeData = res;
                const placeId = this.$route.params.id;
                console.log(placeId);
                this.placeInfo = this.getPlaceContent(placeId);
                console.log('[景點]Received placeInfo:', this.placeInfo);

                // Assign selectRegion only when placeInfo is not null
                if (this.placeInfo) {
                    this.selectTags = this.placeInfo.place_tag_group.split(',');
                    this.selectRegion = this.placeInfo.region_name;
                    this.selectTime = this.placeInfo.place_stay;
                }
            })
            .catch((err) => {
                console.log(err);
            });
        GET(`${this.$URL}/PlaceTag.php`)
            .then((res) => {
                console.log(res);
                this.tagList = res;
            })
            .catch((err) => {
                console.log(err);
            });
        GET(`${this.$URL}/PlaceRegion.php`)
            .then((res) => {
                console.log(res);
                this.regionList = res;
            })
            .catch((err) => {
                console.log(err);
            });
        GET(`${this.$URL}/PlaceStay.php`)
            .then((res) => {
                console.log(res);
                this.timeList = res;
            })
            .catch((err) => {
                console.log(err);
            });
    },
}
</script>