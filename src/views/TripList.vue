<template>
    <div class="main_content">
        <h3>行程列表</h3>
        <div class="action_container">
            <div class="searchbar">
                <input type="text" name="search" id="search" placeholder="請輸入關鍵字" />
                <button class="btn">搜尋</button>
            </div>
            <div class="btn">
                <span>
                    <Icon type="md-add" />
                    新增行程
                </span>
            </div>
        </div>
        <div class="overview_list">
            <div class="table_wrap">
                <table>
                    <tr>
                        <th></th>
                        <th>NO.
                            <Icon type="md-arrow-dropdown" />
                        </th>
                        <th>標題</th>
                        <th>更新日期
                            <Icon type="md-arrow-dropdown" />
                        </th>
                        <th>瀏覽數
                            <Icon type="md-arrow-dropdown" />
                        </th>
                        <th>狀態</th>
                        <th>編輯</th>
                        <th>刪除</th>
                    </tr>
                    <tr>
                        <td>
                            <Icon type="md-flag" />
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
                            <Icon type="md-create" />
                        </td>
                        <td>
                            <Icon type="md-trash" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <Icon type="md-flag" />
                        </td>
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
                            <Icon type="md-create" />
                        </td>
                        <td>
                            <Icon type="md-trash" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <Icon type="md-flag" />
                        </td>
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
                            <Icon type="md-create" />
                        </td>
                        <td>
                            <Icon type="md-trash" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <Icon type="md-flag" />
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
                            <Icon type="md-create" />
                        </td>
                        <td>
                            <Icon type="md-trash" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <Icon type="md-flag" />
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
                            <Icon type="md-create" />
                        </td>
                        <td>
                            <Icon type="md-trash" />
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div> 
</template>