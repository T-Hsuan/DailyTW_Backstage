import { createStore } from 'vuex'
import axios from 'axios';
export default createStore({
    state: {
        placeTag: [],
        ticketData: [],
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
