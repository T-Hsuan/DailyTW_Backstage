<template>
  <div class="main_content">
    <h3>審核貼文</h3>
    <form class="form_container" @submit="submitForm">
      <!-- 表單欄位用 label 包 -->
      <!-- 圖片區域 -->
      <label class="review_card">
        <h5>圖片</h5>
        <img src="https://picsum.photos/279/369/?random=10" />
        <span class="review_result">
          圖片審核結果:
          <label for="img_approve" class="radio-button approve">
            <input
              type="radio"
              id="img_approve"
              name="img_review"
              value="approve"
            />
            <Icon type="md-checkmark-circle" size="51"/>
          </label>
          <label for="img_reject" class="radio-button reject">
            <input
              type="radio"
              id="img_reject"
              name="img_review"
              value="reject"
            />
            <Icon type="md-close-circle" size="51"/>
          </label>
        </span>  
        <div class="review_text">
          <input
            type="text"
            placeholder="為什麼這張圖片不能出現在我們的網站? "
          />
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
            <input
              type="radio"
              id="desc_approve"
              name="desc_review"
              value="approve"
            />
            <Icon type="md-checkmark-circle" size="51"/>
          </label>
          <label for="desc_reject" class="radio-button reject">
            <input
              type="radio"
              id="desc_reject"
              name="desc_review"
              value="reject"
            />
            <Icon type="md-close-circle" size="51"/>
          </label>
        </span>  
        <div class="review_text">
          <input
            type="text"
            placeholder="為什麼穿搭描述不能這樣寫? "
          />
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
            <input
              type="radio"
              id="style_approve"
              name="style_review"
              value="approve"
            />
            <Icon type="md-checkmark-circle" size="51"/>
          </label>
          <label for="style_reject" class="radio-button reject">
            <input
              type="radio"
              id="style_reject"
              name="style_review"
              value="reject"
            />
            <Icon type="md-close-circle" size="51"/>
          </label>
        </span>  
        <div class="review_text">
          <input
            type="text"
            placeholder="建議選擇哪幾個穿搭風格?"
          />
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
            <input
              type="radio"
              id="place_approve"
              name="place_review"
              value="approve"
            />
            <Icon type="md-checkmark-circle" size="51"/>
          </label>
          <label for="place_reject" class="radio-button reject">
            <input
              type="radio"
              id="place_reject"
              name="place_review"
              value="reject"
            />
            <Icon type="md-close-circle" size="51"/>
          </label>
        </span>  
        <div class="review_text">
          <input
            type="text"
            placeholder="建議選擇哪幾個景點類型?"
          />
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
            <input
              type="radio"
              id="season_approve"
              name="season_review"
              value="approve"
            />
            <Icon type="md-checkmark-circle" size="51"/>
          </label>
          <label for="season_reject" class="radio-button reject">
            <input
              type="radio"
              id="season_reject"
              name="season_review"
              value="reject"
            />
            <Icon type="md-close-circle" size="51"/>
          </label>
        </span>  
        <div class="review_text">
          <input
            type="text"
            placeholder="建議選擇哪個穿搭季節? "
          />
        </div>
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
import axios from'axios';

export default {
  props:['oottId'],
  data() {
    return {
      oott:{},
    }
  },
  methods: {
    fetchPostDetails(){
      axios.get(`${this.$URL}/OottPostReview.php?oottId=${this.oottId}`)
      // axios.get(`OottPostReview.php?oottId=${this.oottId}`)
      .then(response =>{
        this.oott = response.data;
        console.log(this.oott)
      })
      .catch(error =>{
        console.error('Error fetching post details:', error);
      })
    },

    // 取得圖片的路徑
    getOottImgPath(){
            return `${this.$IMG_URL}/oottImg/${this.selectedUser.oott_img}.png`;  
        },  
  },
  created(){
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
    img {
      margin: 49px 204px;
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
      margin-left:10px;
      color: var(--text-default, #6a5d4a);
        input[type="radio"]{
          display: none;
        }
      }
      .approve input:checked + .ivu-icon-md-checkmark-circle {
        color: #19be6b; /* Green color for approve */
      }

      .reject input:checked + .ivu-icon-md-close-circle {
        color: #ed4014; /* Red color for reject */
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
