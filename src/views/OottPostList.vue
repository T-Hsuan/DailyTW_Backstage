<template>
    <div class="main_content">
        <h3>穿搭管理</h3>
        <div class="action_container">
            <div class="selection_box">
                <span>審核狀態</span>
                <Select v-model="selectRegion">
                    <Option v-for="item in reviewList" :value="item.value" :key="item.value">{{ item.label }}</Option>
                </Select>
            </div>
            <div class="searchbar">
                <input type="text" name="search" id="search" placeholder="請輸入關鍵字" />
                <button class="btn">搜尋</button>
            </div>
        <button class="btn">
          <span>
            <Icon type="md-add" />
            新增穿搭
          </span>
        </button>
      </div>
      <div class="table_wrap">
        <table>
          <tr>
            <th></th>
            <th>
              <button>
                NO.
                <Icon type="md-arrow-dropdown" />
              </button>
            </th>
            <th>作者</th>
            <th>更新日期</th>
            <th>上架狀態</th>
            <th>審核狀態</th>
            <th>審核</th>
          </tr>
          <tr v-for="(item, index) in tableData" :key="index">
            <td>
                <button><Icon type="md-flag" /></button>
            </td>
            <td>{{ index + 1 }}</td>
            <td>{{ item.type }}</td>
            <td>{{ item.description }}</td>
            <td>
              <Switch size="large" v-model="item.status">
                <template #open>
                  <span>ON</span>
                </template>
                <template #close>
                  <span>OFF</span>
                </template>
              </Switch>
            </td>
            <td>{{ item.state }}</td>
            <td>
              <button><Icon type="md-eye" /></button>
            </td>
          </tr>
        </table>
      </div>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            tableData: [
                { type: '休閒', description: '2023-08-03', state: '審核中' },
                { type: '休閒', description: '2023-08-03', state: '審核中' },
                { type: '休閒', description: '2023-08-03', state: '審核中' },
                { type: '休閒', description: '2023-08-03', state: '審核中' },
                { type: '休閒', description: '2023-08-03', state: '審核中' },
            ],
            reviewList: [
                {
                    value: '審核中',
                    label: '審核中'
                },
                {
                    value: '已通過',
                    label: '已通過'
                },
                {
                    value: '未通過',
                    label: '未通過'
                },
            ],
        };
    },
    methods: {
        deleteRow(index) {
            this.tableData.splice(index, 1);
        },
        // You can add other methods for handling backend data retrieval, update, etc.
    },
};
</script>

<style lang="scss" scoped>
.action_container{
    padding-top: 20px;
    .selection_box{
        position: relative;
        width: 120px;
        span{
            position: absolute;
            bottom: 100%;
            left: 0;
        }
    }
}
</style>