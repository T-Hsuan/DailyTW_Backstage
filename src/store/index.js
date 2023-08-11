import { createStore } from 'vuex'
import axios from 'axios';
export default createStore({
    state: {
        ticketData: [],
    },
    getters: {
        ticketData: state => state.ticketData,
    },
    mutations: {
        SET_TICKET_DATA(state, data) {
            state.ticketData = data;
        },
        restoreticketData(state, ticketData) {
            // 還原票券資料
            state.ticketData = ticketData;
        },

    },
    actions: {
        fetchTicketData({ commit }) {
            axios.get('http://localhost/DailyTW_Backstage/public/phpfile/TicketList.php')
                .then(response => {
                    commit('SET_TICKET_DATA', response.data);
                    console.log('[store]成功連接ticketdata:', this.state.ticketData);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        },
    },
    modules: {
    }
})
