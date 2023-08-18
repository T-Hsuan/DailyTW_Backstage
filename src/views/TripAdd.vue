<template>
    <div class="main_content">
        <h3>行程新增</h3>
        <div class="form_container">
            <!-- 行程名稱 -->
            <label for="trip_name">
                <span>標題</span>
                <input type="text" name="trip_name" id="trip_name" placeholder="請輸入行程標題">
            </label>
            <!-- 行程作者 -->
            <label for="trip_author">
                <span>作者</span>
                <input type="text" name="trip_author" id="trip_author" placeholder="請輸入作者名稱">
            </label>
            <!-- 行程描述 -->
            <label for="trip_desc">
                <span>行程描述</span>
                <textarea name="trip_desc" id="trip_desc" rows="10" placeholder="請輸入行程描述"></textarea>
            </label>
        </div>
        
        <!-- 景點列表 -->
        <div class="trip_place_list">
            <div class="trip_place" v-for="(place, index) in places" :key="index">
                <Divider />
                <div class="trip_place_title">
                    <h5>景點名稱：{{ place.title }}</h5>
                </div>
                <div class="trip_place_imgs">
                    <div class="trip_place_img" v-for="(image, imageIndex) in place.images" :key="imageIndex">
                        <img v-width="230" :src="image.src" :alt="image.alt" />
                    </div>
                </div>
                <p class="trip_place_desc">{{ place.description }}</p>
                <button class="trip_place_delete">
                    <Icon type="md-trash" />
                </button>
            </div>
        </div>
        <Divider />

        <!-- 新增景點 -->
        <h5 class="trip_place_add_heading">新增景點</h5>
        <div class="selection_wrap trip_place_add">
            <div class="selection_box trip_place_region">
                <span>地區</span>
                <Select v-model="selectRegion" placeholder="請選擇景點所在地區" class="region_select">
                    <Option v-for="item in regionList" :value="item.value" :key="item.value">{{ item.label }}</Option>
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
                        :filter-method="filterMethod"
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
export default{
    data(){
        return{
            places: [
            ],
        }
    },
    methods: {
        showDeleteConfirmation(index) {
            // Show the confirm message dialog
            const isConfirmed = window.confirm('確定刪除此景點?');
            if (isConfirmed) {
                // If the user confirms, delete the row
                this.deleteRow(index);
            }
        },
        deleteRow(index) {
            this.tableData.splice(index, 1);
        },
        filterMethod (value, option) {
            return option.toUpperCase().indexOf(value.toUpperCase()) !== -1;
        }
    },
    mounted () {
        GET(`${this.$URL}/TripAdd.php`)
            .then((res) => {
                console.log(res);
                this.rawData = res; // Store the raw fetched data
                this.page.total = this.rawData.length; // Set total based on raw data length
                this.getHome(); // Fetch initial paginated data
            })
            .catch((err) => {
                console.log(err);
            })
    }
}
</script>

<style lang="scss">
.ivu-divider{
    background: #6a5d4a;
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