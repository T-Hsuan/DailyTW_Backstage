<template>
    <div class="main_content">
      <h3>訂單管理</h3>
      <div class="action_container">
        <div class="searchbar">
                <input type="text" name="search" id="search" placeholder="請輸入關鍵字" />
                <button class="btn">搜尋</button>
            </div>
        <button class="btn">
          <span>
            <Icon type="md-add" />
            新增訂單
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
            <th>訂單編號</th>
            <th>票券名稱</th>
            <th>會員編號</th>
            <th>
                下單時間
                <button><Icon type="md-arrow-dropdown" /></button>
            </th>
            <th>總金額
                <button><Icon type="md-arrow-dropdown" /></button>
            </th>
            <th>狀態</th>
          </tr>
          <tr v-for="(item, index) in tableData" :key="index">
            <td>{{ index + 1 }}</td>
            <td>{{ item.number }}</td>
            <td>{{ item.tickit }}</td>
            <td>{{ item.member }}</td>
            <td>{{ item.time }}</td>
            <td>{{ item.price }}</td>
            <td>{{ item.state }}</td>
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
          { number: '1234', tickit: '台北101', member: '王小明', time:'2023-08-01', price:'1200元', state:'取消'},
          { number: '1234', tickit: '台北101', member: '王小明', time:'2023-08-01', price:'1200元', state:'完成'},
          { number: '1234', tickit: '台北101', member: '王小明', time:'2023-08-01', price:'1200元', state:'取消'},
          { number: '1234', tickit: '台北101', member: '王小明', time:'2023-08-01', price:'1200元', state:'完成'},
          { number: '1234', tickit: '台北101', member: '王小明', time:'2023-08-01', price:'1200元', state:'取消'},
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
  