<template>
    <div class="main_content">
        <h3>行程列表</h3>
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
        <!-- 列表表格用 .table_wrap 包 table -->
        <div class="table_wrap">
            <table>
                <tr>
                    <th></th>
                    <th>
                        <button>
                            NO.
                            <i class="fa-solid fa-sort"></i>
                        </button>
                    </th>
                    <th>標題</th>
                    <th>
                        <button>
                            更新日期
                            <i class="fa-solid fa-sort"></i>
                        </button>
                    </th>
                    <th>
                        <button>
                            瀏覽數
                            <i class="fa-solid fa-sort"></i>
                        </button>
                    </th>
                    <th>狀態</th>
                    <th>編輯</th>
                    <th>刪除</th>
                </tr>
                <tr>
                    <!-- 釘選至前台主要頁面用旗子 icon  -->
                    <td>
                        <button><Icon type="md-flag" /></button>
                    </td>
                    <td>1</td>
                    <td>標題標題標題標題標題</td>
                    <td>2023-08-02</td>
                    <td>100</td>
                    <td>
                        <Switch size="large">
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
                <tr>
                    <td></td>
                    <td>2</td>
                    <td>標題標題標題標題標題</td>
                    <td>2023-08-02</td>
                    <td>100</td>
                    <td>
                        <Switch size="large">
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
                <tr>
                    <td></td>
                    <td>3</td>
                    <td>標題標題標題標題標題</td>
                    <td>2023-08-02</td>
                    <td>10</td>
                    <td>
                        <Switch size="large">
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
                <tr>
                    <td>
                        <button><Icon type="md-flag" /></button>
                    </td>
                    <td>4</td>
                    <td>標題標題標題標題標題</td>
                    <td>2023-08-02</td>
                    <td>10000</td>
                    <td>
                        <Switch size="large">
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
                <tr>
                    <td>
                        <button><Icon type="md-flag" /></button>
                    </td>
                    <td>5</td>
                    <td>標題標題標題標題標題</td>
                    <td>2023-08-02</td>
                    <td>1000</td>
                    <td>
                        <Switch size="large">
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