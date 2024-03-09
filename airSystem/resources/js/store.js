
import Vuex from 'vuex';


export default new Vuex.Store({
    state: {
        isLoggedIn: false
    },
    mutations: {
        SET_AUTH_STATUS(state, status) {
            state.isLoggedIn = status;
        }
    },
    actions: {
        login({ commit }) {
            // код для входа пользователя
            commit('SET_AUTH_STATUS', true);
        },
        logout({ commit }) {
            // код для выхода пользователя
            commit('SET_AUTH_STATUS', false);
        }
    },
    getters: {

    }
});
