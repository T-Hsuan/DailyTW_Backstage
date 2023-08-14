<template>
    <div class="main_content">
        <h3>景點新增</h3>
        <div class="form_container">
            <form method="post" @submit="submitForm">
                <!-- 表單欄位用 label 包 -->
                <label for="place_name">
                    <span>景點名稱</span>
                    <input type="text" name="place_name" id="place_name" v-model="place_name">
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
                            <Option v-for="(item, index) in regionList" :value="item.region_id" :key="index">{{ item.region_name }}</Option>
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
                    <input type="text" name="place_addr" id="place_addr" v-model="place_addr">
                </label>
                <label for="place_link">
                    <span>景點連結</span>
                    <input type="text" name="place_link" id="place_link" v-model="place_link">
                </label>
                <label for="place_desc">
                    <span>景點描述</span>
                    <textarea name="place_desc" id="place_desc" rows="10" v-model="place_desc"></textarea>
                </label>
                <!-- 上傳照片預覽及刪除 -->
                <div class="img_wrap">
                    <div class="img_box">
                        <label for="place_img1">
                            <span>景點照片1(必選)</span>
                            <div class="upload_click">
                                <Icon type="ios-camera" />
                                <img v-if="uploadedImage1" :src="uploadedImage1"/>
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
                                <img v-if="uploadedImage2" :src="uploadedImage2"/>
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
                                <img v-if="uploadedImage3" :src="uploadedImage3"/>
                            </div>
                            <input type="file" name="place_img3" id="place_img3" ref="fileInput3" @change="onfile(3)">
                        </label>
                        <button v-if="uploadedImage3" class="delete_img" @click="deleteImage(3)">
                            <Icon type="md-close-circle" />
                        </button>
                    </div>
                </div>
                <!-- 次頁右下角統一用取消及儲存按鈕 -->
                <div class="btn_wrap">
                    <router-link to="/place_list">
                        <button class="cancel_btn">取消</button>
                    </router-link>
                    <button class="btn" type="submit" :disabled="!formValid">儲存</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { GET } from '@/plugin/axios';
import  axios  from "axios";

export default {
    data() {
        return {
            place_name: '',
            tagList: [],
            selectTags: [],
            regionList: [],
            selectRegion: '',
            timeList: [],
            selectTime: '',
            place_addr: '',
            place_link: '',
            place_desc: '',
            uploadedImage1: '',
            uploadedImage2: '',
            uploadedImage3: '',
            uploadedImages: [],
        }
    },
    computed:{
        formValid(){
            return(
                this.place_name !== '' &&
                this.selectTags !== [] &&
                this.selectRegion !== '' &&
                this.selectTime !== '' &&
                this.place_desc !== '' &&
                this.uploadedImage1 !== ''
            )
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
        async submitForm(event) {
            event.preventDefault();
            try {
                console.log('Sending request...');
                const formData = new FormData();
                formData.append('place_name', this.place_name);
                formData.append('place_stay', this.selectTime);
                formData.append('place_addr', this.place_addr);
                formData.append('place_link', this.place_link);
                formData.append('place_desc', this.place_desc);
                formData.append('region_id', this.selectRegion);
                formData.append('place_img1', this.uploadedImages[1]);
                formData.append('place_img2', this.uploadedImages[2]);
                formData.append('place_img3', this.uploadedImages[3]);

                const response = await axios.post(`${this.$URL}/PlaceAdd.php`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data', // Use multipart/form-data for form data
                    },
                });
                // window.alert('新增成功!');
                swal({
                    title: "新增成功!",
                    icon: "success",
                }).then((value) => {
                    console.log('Data sent successfully', response.data);
                    // Redirect to the "/place_tag" page
                    this.$router.push('/place_tag');
                });
                
                // // Redirect to the "/place_tag" page
                // this.$router.push('/place_tag');

            } catch (error) {
                console.log(error);
            }
        }
    },
    mounted() {
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