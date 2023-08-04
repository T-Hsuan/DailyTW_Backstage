<template>
    <div class="main_content">
      <h3>景點類型管理</h3>
      <div class="action_container">
        <button class="btn">
          <span>
            <Icon type="md-add" />
            新增類型
          </span>
        </button>
      </div>
      <div class="table_wrap">
        <table>
          <tr>
            <th>
              <button>
                NO.
                <Icon type="md-arrow-dropdown" />
              </button>
            </th>
            <th>景點類型</th>
            <th>描述</th>
            <th>標籤狀態</th>
            <th>刪除</th>
          </tr>
          <tr v-for="(item, index) in tableData" :key="index">
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
            <td>
              <button><Icon type="md-trash" @click="deleteRow(index)" /></button>
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
                { type: '休閒', description: '今天又是個風和日麗的日子', status: true },
                { type: '休閒', description: '今天又是個風和日麗的日子', status: true },
                { type: '休閒', description: '今天又是個風和日麗的日子', status: true },
                { type: '休閒', description: '今天又是個風和日麗的日子', status: true },
                { type: '休閒', description: '今天又是個風和日麗的日子', status: true },
                // Add more data rows here
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
  