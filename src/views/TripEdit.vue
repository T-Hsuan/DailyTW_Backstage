<template>
    <div class="main_content">
        <h3>行程編輯</h3>
        <div class="form_container">
            <!-- 行程名稱 -->
            <label for="trip_name">
            <span>標題</span>
            <input
                type="text"
                name="trip_name"
                id="trip_name"
                placeholder="請輸入行程標題"
                v-model="tripInfo.trip_name"
            />
            </label>
            <!-- 行程作者 -->
            <label for="trip_author">
            <span>作者</span>
            <input
                type="text"
                name="trip_author"
                id="trip_author"
                placeholder="請輸入作者名稱"
                v-model="tripInfo.trip_author"
            />
            </label>
            <!-- 行程描述 -->
            <label for="trip_desc">
            <span>行程描述</span>
            <textarea
                class="trip_desc"
                name="trip_desc"
                id="trip_desc"
                rows="10"
                placeholder="請輸入行程描述"
                v-model="tripInfo.trip_desc"
            ></textarea>
            </label>
        </div>
        
        <!-- 景點列表 -->
        <div class="trip_place_list">
            <div class="trip_place" v-for="(place, index) in placeInfo" :key="index">
                <Divider />
                <div class="trip_place_title">
                    <h5>景點名稱：{{ place.place_name }}</h5>
                </div>
                <div class="trip_place_imgs">
                    <div class="trip_place_img" v-for="(image, imageIndex) in place.place_img" :key="imageIndex">
                        <img v-width="230" :src="getPlaceImg(image)" :alt="image.alt" />
                    </div>
                </div>
                <p class="trip_place_desc">{{ place.place_desc }}</p>
                <button @click="showDeleteConfirmation(index)" class="trip_place_delete">
                    <Icon type="md-trash" />
                </button>
            </div>
        </div>
        <Divider />

        <!-- 新增景點 -->
        <h5 class="trip_place_add_heading">新增景點</h5>
        <div class="trip_place_add">
            <div class="selection_box trip_place_region">
                <span>地區</span>
                <Select v-model="selectRegion" placeholder="請選擇景點所在地區" class="region_select">
                    <Option v-for="(item, index) in regionList" :value="item.region_name" :key="index">{{ item.region_name }}</Option>
                </Select>
            </div>
            <div class="selection_box trip_place_search">
                <span>關鍵字搜尋</span>
                <div class="searchbar">
                    <!-- <input type="text" name="search" id="search" placeholder="請輸入關鍵字" />
                    <button class="btn">搜尋</button> -->
                    <!-- v-model=""
                    :data="" -->
                    <AutoComplete
                        v-model="placeSelect"
                        :filter-method="filterMethod"
                        :data="placeSearch"
                        icon="ios-search"
                        placeholder="請輸入景點名稱"
                        style="height:46px">
                    </AutoComplete>
                </div>
            </div>
            <button class="btn">新增</button>
        </div>
        
        <!-- 次頁右下角統一用取消及儲存按鈕 -->
        <div class="btn_wrap">
            <router-link to="/trip_list">
                <button class="cancel_btn">取消</button>
            </router-link>
            <button class="btn">儲存</button>
        </div>
    </div>
</template>

<script>
import {GET} from '@/plugin/axios';
import  axios  from "axios";

export default{

    data(){
        return{
            tripInfo: [],
            placeInfo: [],
            regionList: [],
            selectRegion: '',
            placeSearch: [
                '清水地熱','三星落羽松秘境','梅花湖','斑比山丘','伯朗咖啡城堡','空ㄟ農場'
            ],
            placeSelect: '',
        }
    },

    methods: {
        showDeleteConfirmation(index) {
            // Show the confirm message dialog
            swal({
                title: "確定刪除此景點?",
                icon: "warning",
                buttons: ["取消", "確定"],
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    // If the user confirms, delete the row
                    this.deletePlace(index);
                }
            });
        },
        async deletePlace(index) {
            this.placeInfo.splice(index, 1);
        },
        filterMethod (value, option) {
            return option.toUpperCase().indexOf(value.toUpperCase()) !== -1;
        },

        getPlaceImg(placeImg){
            return `${this.$IMG_URL}/placeImg/${placeImg}`;  
        },
    },

    mounted () {
        const tripId = this.$route.params.trip_id;
        GET(`${this.$URL}/TripEditGetTrip.php?trip_id=${tripId}`)
            .then((res) => {
                console.log(res);
                this.tripInfo = res;
            })
            .catch((err) => {
                console.log(err);
            });
        GET(`${this.$URL}/TripEditGetPlaces.php?trip_id=${tripId}`)
            .then((res) => {
                console.log(res);
                this.placeInfo = res;
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
    }
}
</script>

<style lang="scss">
.ivu-divider{
    background: #6a5d4a;
}
.trip_desc{
    letter-spacing: 0.06rem;
    line-height: 1.8rem;
}
.trip_place_list{
    margin: 32px 0;
    .trip_place{
        position: relative;
        margin-bottom: 32px;
        .trip_place_title{
            margin-bottom: 16px;
        }
        .trip_place_imgs{
            margin-bottom: 16px;
            display: flex;
            gap: 15px;
        }
        .trip_place_desc{
            margin-bottom: 16px;
            letter-spacing: 0.06rem;
            line-height: 1.8rem;
        }
        .trip_place_delete{
            position: absolute;
            top: 24px;
            right: 0;
            .ivu-icon{
                color: #6a5d4a;
            }
        }
    }
}
.trip_place_add_heading{
    margin-bottom: 4px;
}
.trip_place_add{
    display: flex;
    gap: 16px;
    margin-bottom: 80px;
    .trip_place_region{
        width: 240px !important;
        .region_select{
            width: 240px;
        }
        span.ivu-select-placeholder {
            display: inline !important;
            color: #bab162;
            line-height: 34px;
        }
    }
    .trip_place_search{
        width: 360px;
        .searchbar{
            display: flex;
            .ivu-icon{
                margin: auto;
            }
            .ivu-input{
                height: 46px;
            }
            .ivu-input-icon{
                line-height: 46px;
            }
        }
    }
    .btn{
        height: 46px;
        align-self: end;
    }
}
</style>