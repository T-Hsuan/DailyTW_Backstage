import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import ViewUIPlus from 'view-ui-plus'
import locale from 'view-ui-plus/dist/locale/zh-TW';
import 'view-ui-plus/dist/styles/viewuiplus.css'
import "@/assets/scss/main.scss";

createApp(App).use(store).use(router).use(ViewUIPlus, { locale }).mount('#app')
