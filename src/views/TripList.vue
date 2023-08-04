<template>
    <div class="main_content">
        <h3> 行程列表</h3>
        <!-- 表格上方使用者操作區塊用 .action_container 包 -->
        <div class="action_container">
            <div class="searchbar">
                <input type="text" name="search" id="search" placeholder="請輸入關鍵字" />
                <button class="btn">搜尋</button>
            </div>
        <button class="btn">
          <span>
            <Icon type="md-add" />
            新增行程
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
            <th>標題</th>
            <th>更新日期
                <button><Icon type="md-arrow-dropdown" /></button>
            </th>
            <th>瀏覽數
                <button><Icon type="md-arrow-dropdown" /></button>
            </th>
            <th>狀態</th>
            <th>編輯</th>
            <th>刪除</th>
          </tr>
          <tr v-for="(item, index) in tableData" :key="index">
            <td>
                <button><Icon type="md-flag" /></button>
            </td>
            <td>{{ index + 1 }}</td>
            <td>{{ item.title }}</td>
            <td>{{ item.date }}</td>
            <td>{{ item.count }}</td>
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
            <td>
                <button><Icon type="md-create" /></button>
            </td>
            <td>
                <button><Icon type="md-trash" /></button>
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
                { title: '休閒', date: '2023-08-03', count: '123' },
                { title: '休閒', date: '2023-08-03', count: '123' },
                { title: '休閒', date: '2023-08-03', count: '123' },
                { title: '休閒', date: '2023-08-03', count: '123' },
                { title: '休閒', date: '2023-08-03', count: '123' },
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
  