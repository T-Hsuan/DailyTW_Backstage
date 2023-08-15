import { createStore } from 'vuex'
import axios from 'axios';
export default createStore({
    state: {
        placeTag: [],
        ticketData: [],
        name: '',
        isLogin: false,
    },
    getters: {
        placeTag: state => state.placeTag,
        ticketData: state => state.ticketData,
    },
    mutations: {
        SET_PLACETAG_DATA(state, data) {
            state.placeTag = data;
        },
        SET_TICKET_DATA(state, data) {
            state.ticketData = data;
        },
        restoreticketData(state, ticketData) {
            // 還原票券資料
            state.ticketData = ticketData;
        },
        setName(state, payload) {
            state.name = payload
        },
        // setIsLogin(state, value) {
        //     state.isLogin = value;
        // },
        //接收回傳的使用者資訊
        setLoginData(state, userInfo) {
            state.userInfo = userInfo
            sessionStorage.setItem("manager_id", userInfo.manager_id);
            sessionStorage.setItem("manager_name", userInfo.manager_name);
            // state.isLogin = true
        },
        logOut(state) {
            state.isLogin = false
            sessionStorage.removeItem("manager_id")
        },

    },
    actions: {
        fetchplaceTag({ commit }) {
            axios.get('http://localhost/DailyTW_Backstage/public/phpfile/PlaceTag.php')
                .then(response => {
                    commit('SET_PLACETAG_DATA', response.data);
                    console.log('[store]成功連接placeTag:', this.state.placeTag);
                })
                .catch(error => {
                    console.error('[store]連接placeTag失敗:', error);
                });
        },
        fetchTicketData({ commit }) {
            axios.get('http://localhost/DailyTW_Backstage/public/phpfile/TicketList.php')
                .then(response => {
                    commit('SET_TICKET_DATA', response.data);
                    console.log('[store]成功連接ticketData:', this.state.ticketData);
                })
                .catch(error => {
                    console.error('[store]連接ticketData失敗:', error);
                });
        },
    },
    modules: {
    }
})
