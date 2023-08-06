<template>
    <div class="main_content">
        <h3>景點新增</h3>
        <div class="form_container">
            <!-- 表單欄位用 label 包 -->
            <label for="place_name">
                <span>景點名稱</span>
                <input type="text" name="place_name" id="place_name">
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
            <!-- 套件多張照片上傳預覽及刪除 -->
            <label for="place_img">
                <span>景點照片(1~3張)</span>
                <div class="demo-upload-list" v-for="item in uploadList">
                    <template v-if="item.status === 'finished'">
                        <Image :src="item.url" fit="cover" width="100%" height="100%" />
                        <div class="demo-upload-list-cover">
                            <Icon type="ios-eye-outline" @click="handleView(item.name)"></Icon>
                            <Icon type="ios-trash-outline" @click="handleRemove(item)"></Icon>
                        </div>
                    </template>
                    <template v-else>
                        <Progress v-if="item.showProgress" :percent="item.percentage" hide-info></Progress>
                    </template>
                </div>
                <Upload
                    ref="upload"
                    :show-upload-list="false"
                    :default-file-list="defaultList"
                    :on-success="handleSuccess"
                    :format="['jpg','jpeg','png']"
                    :max-size="2048"
                    :on-format-error="handleFormatError"
                    :on-exceeded-size="handleMaxSize"
                    :before-upload="handleBeforeUpload"
                    multiple
                    type="drag"
                    action="//jsonplaceholder.typicode.com/posts/"
                    style="display: inline-block;width:58px;">
                    <div style="width: 58px;height:58px;line-height: 58px;">
                        <Icon type="ios-camera" size="24"></Icon>
                    </div>
                </Upload>
                <ImagePreview v-model="visible" :preview-list="['https://file.iviewui.com/images/' + imgName]" />
            </label>
        </div>
        <!-- 次頁右下角統一用取消及儲存按鈕 -->
        <div class="btn_wrap">
            <router-link to="/place_list">
                <button class="cancel_btn">取消</button>
            </router-link>
            <button class="btn">儲存</button>
        </div>
    </div>
</template>

<script>
export default{
    data(){
        return{
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
            defaultList: [
                {
                    'name': 'image-demo-1.jpg',
                    'url': 'https://file.iviewui.com/images/image-demo-1.jpg'
                },
                {
                    'name': 'image-demo-2.jpg',
                    'url': 'https://file.iviewui.com/images/image-demo-2.jpg'
                }
            ],
            imgName: '',
            visible: false,
            uploadList: []
        }
    },
    methods: {
        handleView (name) {
            this.imgName = name;
            this.visible = true;
        },
        handleRemove (file) {
            const fileList = this.$refs.upload.fileList;
            this.$refs.upload.fileList.splice(fileList.indexOf(file), 1);
        },
        handleSuccess (res, file) {
            file.url = 'https://file.iviewui.com/images/image-demo-3.jpg';
            file.name = 'image-demo-3.jpg';
        },
        handleFormatError (file) {
            this.$Notice.warning({
                title: 'The file format is incorrect',
                desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
            });
        },
        handleMaxSize (file) {
            this.$Notice.warning({
                title: 'Exceeding file size limit',
                desc: 'File  ' + file.name + ' is too large, no more than 2M.'
            });
        },
        handleBeforeUpload () {
            const check = this.uploadList.length < 3;
            if (!check) {
                this.$Notice.warning({
                    title: 'Up to three pictures can be uploaded.'
                });
            }
            return check;
        }
    },
    mounted () {
        this.uploadList = this.$refs.upload.fileList;
    }
}
</script>