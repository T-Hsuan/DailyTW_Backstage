<template>
    <div class="main_content">
        <h3>穿搭風格管理</h3>
        <div class="action_container">
            <router-link to="/oott_style_add">
                <button class="btn">
                    <span>
                        <Icon type="md-add" />
                        新增類型
                    </span>
                </button>
            </router-link>  
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
                    <th>穿搭風格</th>
                    <th class="style_add_desc">描述</th>
                    <th>置頂</th>
                    <th>標籤狀態</th>
                    <th>刪除</th>
                </tr>
                <tr v-for="(item, index) in tableData" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.style_name }}</td>
                    <td class="style_add_desc">{{ item.style_desc }}</td>
                    <td><input type="checkbox"></td>
                    <td>
                        <Switch size="large" v-model="item.style_tag_status" true-value="1" false-value="0">
                            <template #close>
                                <span>OFF</span>
                            </template>
                            <template #open>
                                <span>ON</span>
                            </template>
                        </Switch>
                    </td>
                    <td>
                        <button>
                            <Icon type="md-trash" @click="deleteRow(index)" />
                        </button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>
  
<script>
import {GET} from '@/plugin/axios'

export default {
    data() {
        return {
            tableData: [
                { type: '休閒', description: '今天又是個風和日麗的日子', status: true },
                { type: '潮流', description: '今天又是個風和日麗的日子', status: true },
                { type: '美式', description: '今天又是個風和日麗的日子', status: true },
                { type: '簡約', description: '今天又是個風和日麗的日子', status: true },
                { type: '街頭', description: '今天又是個風和日麗的日子', status: true },
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
     mounted() {
        GET(`${this.$URL}/StyleMgt.php`)
            .then((res) => {
                console.log(res);
                this.tableData = res;
            })
            .catch((err) => {
                console.log(err);
            })
    }
};
</script>
  
<style lang="scss" scoped>
    table{
        width: 100%;
        table-layout: fixed;
        box-sizing: border-box;
        .style_add_desc{
            width: 300px;
        }
        td{
            word-wrap: break-word;
        }
        th,td{
            white-space: normal;
        }
        
    }
</style>