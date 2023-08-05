import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import ViewUIPlus from 'view-ui-plus'
import { createI18n } from 'vue-i18n';
import zh from 'view-ui-plus/dist/locale/zh-TW';
const i18n = createI18n({
    allowComposition: true,
    globalInjection: true,
    legacy: false,
    locale: 'zh-TW',
    messages: {
        'zh-TW': zh,
    }
});
import 'view-ui-plus/dist/styles/viewuiplus.css'

import "@/assets/scss/main.scss";

createApp(App).use(store).use(router).use(ViewUIPlus, { i18n }).use(i18n).mount('#app')
