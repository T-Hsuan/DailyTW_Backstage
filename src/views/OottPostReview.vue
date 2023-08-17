<template>
    <div class="main_content">
        <h3>審核貼文</h3>
        <form class="form_container" @submit="submitForm">
            <!-- 表單欄位用 label 包 -->
            <!-- 圖片區域 -->
            <label class="review_card">
                <h5>圖片</h5>
                <div class="img_area">
                    <img :src="getOottImgPath()" />
                </div>
                <span class="review_result">
                    圖片審核結果:
                    <label for="img_approve" class="radio-button approve">
                        <input type="radio" id="img_approve" name="img_review" value="approve" />
                        <Icon type="md-checkmark-circle" size="51" />
                    </label>
                    <label for="img_reject" class="radio-button reject">
                        <input type="radio" id="img_reject" name="img_review" value="reject" />
                        <Icon type="md-close-circle" size="51" />
                    </label>
                </span>
                <div class="review_text">
                    <input type="text" placeholder="為什麼這張圖片不能出現在我們的網站? " v-model="this.reviewData.oott_img_feedback" />
                </div>
            </label>

            <!-- 穿搭描述 -->
            <label class="review_card">
                <h5>穿搭描述</h5>
                <div class="oott_desc">
                    {{ oott.oott_desc }}
                </div>
                <span class="review_result">
                    穿搭描述審核結果:
                    <label for="desc_approve" class="radio-button approve">
                        <input type="radio" id="desc_approve" name="desc_review" value="approve" />
                        <Icon type="md-checkmark-circle" size="51" />
                    </label>
                    <label for="desc_reject" class="radio-button reject">
                        <input type="radio" id="desc_reject" name="desc_review" value="reject" />
                        <Icon type="md-close-circle" size="51" />
                    </label>
                </span>
                <div class="review_text">
                    <input type="text" placeholder="為什麼穿搭描述不能這樣寫? " v-model="this.reviewData.oott_desc_feedback" />
                </div>
            </label>

            <!-- 穿搭風格 -->
            <label class="review_card">
                <h5>穿搭風格</h5>
                <div class="oott_desc">
                    #{{ oott.concatenated_style_name }}
                </div>
                <span class="review_result">
                    穿搭風格審核結果:
                    <label for="style_approve" class="radio-button approve">
                        <input type="radio" id="style_approve" name="style_review" value="approve" />
                        <Icon type="md-checkmark-circle" size="51" />
                    </label>
                    <label for="style_reject" class="radio-button reject">
                        <input type="radio" id="style_reject" name="style_review" value="reject" />
                        <Icon type="md-close-circle" size="51" />
                    </label>
                </span>
                <div class="review_text">
                    <input type="text" placeholder="建議選擇哪幾個穿搭風格?" v-model="this.reviewData.oott_style_feedback" />
                </div>
            </label>

            <!-- 景點類型 -->
            <label class="review_card">
                <h5>景點類型</h5>
                <div class="oott_desc">
                    #{{ oott.concatenated_place_tag_name }}
                </div>
                <span class="review_result">
                    景點類型審核結果:
                    <label for="place_approve" class="radio-button approve">
                        <input type="radio" id="place_approve" name="place_review" value="approve" />
                        <Icon type="md-checkmark-circle" size="51" />
                    </label>
                    <label for="place_reject" class="radio-button reject">
                        <input type="radio" id="place_reject" name="place_review" value="reject" />
                        <Icon type="md-close-circle" size="51" />
                    </label>
                </span>
                <div class="review_text">
                    <input type="text" placeholder="建議選擇哪幾個景點類型?" v-model="this.reviewData.oott_type_feedback" />
                </div>
            </label>

            <!-- 穿搭季節 -->
            <label class="review_card">
                <h5>穿搭季節</h5>
                <div class="oott_desc">
                    {{ oott.oott_season }}
                </div>
                <span class="review_result">
                    穿搭季節審核結果:
                    <label for="season_approve" class="radio-button approve">
                        <input type="radio" id="season_approve" name="season_review" value="approve" />
                        <Icon type="md-checkmark-circle" size="51" />
                    </label>
                    <label for="season_reject" class="radio-button reject">
                        <input type="radio" id="season_reject" name="season_review" value="reject" />
                        <Icon type="md-close-circle" size="51" />
                    </label>
                </span>
                <div class="review_text">
                    <input type="text" placeholder="建議選擇哪個穿搭季節? " v-model="this.reviewData.oott_season_feedback" />
                </div>
            </label>

            <!-- 最下方的送出 -->
            <div class="btn_wrap">
                <router-link to="/oott_post_list">
                    <button class="cancel_btn">取消審核</button>
                </router-link>
                
                    <button class="btn" type="submit">完成審核</button>
               
            </div>

        </form>


    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['oottId'],
    data() {
        return {
            oott: {
                oott_img: ''
            },
            reviewData: {
                oott_status: 1,
                oott_review_status: 1,
                oott_img_feedback: '',
                oott_desc_feedback: '',
                oott_style_feedback: '',
                oott_type_feedback: '',
                oott_season_feedback: '',
            }
        }
    },
    computed: {
        // 如果全都沒有評論就回傳 true 
        checkFeedback() {
            return (
                this.reviewData.oott_img_feedback == '' &&
                this.reviewData.oott_desc_feedback == '' &&
                this.reviewData.oott_style_feedback == '' &&
                this.reviewData.oott_type_feedback == '' &&
                this.reviewData.oott_season_feedback == ''
            );
        },
    },
    watch: {
        //監看內容的改變
        reviewData: {
            deep: true,
            handler() {
                this.updateReviewStatus();
            }
        }
    },
    methods: {

        // 如果回傳 true，就設定成通過審核
        updateReviewStatus() {
            if (this.checkFeedback) {
                this.reviewData.oott_status = 1;
                this.reviewData.oott_review_status = 1;
            } else {
                this.reviewData.oott_status = 0;
                this.reviewData.oott_review_status = 2;
            }
        },
        // 取得資料
        fetchPostDetails() {
            axios.get(`${this.$URL}/OottPostReview.php?oottId=${this.oottId}`)
                .then(response => {
                    this.oott = response.data;
                })
                .catch(error => {
                    console.error('Error fetching post details:', error);
                })
        },

        // 取得圖片的路徑
        getOottImgPath() {
            return `${this.$IMG_URL}/oottImg/${this.oott.oott_img}`;
        },

        // 將資料送到後端
        async submitForm(event) {
            event.preventDefault();
            try {
                console.log('Sending request...');
                const formData = new FormData();
                formData.append('oott_id', this.oottId);
                formData.append('oott_status', this.reviewData.oott_status);
                formData.append('oott_review_status', this.reviewData.oott_review_status);
                formData.append('oott_img_feedback', this.reviewData.oott_img_feedback);
                formData.append('oott_desc_feedback', this.reviewData.oott_desc_feedback);
                formData.append('oott_style_feedback', this.reviewData.oott_style_feedback);
                formData.append('oott_type_feedback', this.reviewData.oott_type_feedback);
                formData.append('oott_season_feedback', this.reviewData.oott_season_feedback);

                const response = await axios.post(`${this.$URL}/oottPostReviewAdd.php`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data', // Use multipart/form-data for form data
                    },
                });
                swal({
                    title: "審核新增成功!",
                    icon: "success",
                }).then(()=>{
                    console.log('Data sended successfully', response.data);
                    this.$router.push('/oott_post_list');
                })
            } catch (error) {
                console.log(error);
            }
        }
    },
    created() {
        this.fetchPostDetails();
    },
};
</script>

<style lang="scss" scoped>
.form_container {
    .review_card {
        margin-bottom: 32px;
        border-radius: 10px;
        border: 3px solid var(--text-default, #6a5d4a);

        h5 {
            border-radius: 10px 10px 0px 0px;
            background: var(--yellow-default, #e3c451);
            border-bottom: 3px solid var(--text-default, #6a5d4a);
            line-height: 250%;
            padding-left: 18px;
        }

        .img_area {
            margin: 49px auto;
            width: 279px;
            height: 369px;

            img {
                width: 100%;
            }
        }

        .oott_desc {
            margin: 16px 19px;
            line-height: 150%;
        }

        .review_result {
            display: flex;
            align-items: center;
            justify-content: center;

            .radio-button {
                cursor: pointer;
                display: inline-block;
                margin-left: 10px;
                color: var(--text-default, #6a5d4a);

                input[type="radio"] {
                    display: none;
                }
            }

            .approve input:checked+.ivu-icon-md-checkmark-circle {
                color: #19be6b;
                /* Green color for approve */
            }

            .reject input:checked+.ivu-icon-md-close-circle {
                color: #ed4014;
                /* Red color for reject */
            }
        }

        .review_text {
            margin: 33px auto 30px auto;
            margin-top: 33px;
            width: 486px;
            display: block;
        }
    }
}
</style>
