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
import { URL,URL_MAC } from '@/assets/js/common.js'

const app = createApp(App)
app.config.globalProperties.$URL = URL;
app.config.globalProperties.$URL_MAC = URL_MAC;
app.use(store).use(router).use(ViewUIPlus, { locale }).mount('#app')
