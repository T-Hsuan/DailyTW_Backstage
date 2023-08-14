import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import ViewUIPlus from 'view-ui-plus'
import locale from 'view-ui-plus/dist/locale/zh-TW';
import 'view-ui-plus/dist/styles/viewuiplus.css'
import "@/assets/scss/main.scss";

import axios from 'axios';

// 打API用的路徑變數
import { URL, IMG_URL, URL_MAC } from '@/assets/js/common.js'

// 在創建 Vue app 之前，先將 sessionStorage 的資料還原到 Vuex store 中
const TICKET_KEY = "StoreTicketData"; // 作為 localStorage 的 key
const storedticketData = sessionStorage.getItem(TICKET_KEY);

if (storedticketData) {
    store.commit("restoreticketData", JSON.parse(storedticketData));
}
// 在網頁重整前將購物車資料存入 sessionStorage
window.addEventListener("beforeunload", () => {
    const ticketData = JSON.stringify(store.state.ticketData);
    sessionStorage.setItem(TICKET_KEY, ticketData);
});

const app = createApp(App)
app.config.globalProperties.$URL = URL;
app.config.globalProperties.$IMG_URL = IMG_URL;
app.config.globalProperties.$URL_MAC = URL_MAC;
app.use(store).use(router).use(ViewUIPlus, { locale }).mount('#app')
