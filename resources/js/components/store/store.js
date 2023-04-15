import Vuex from 'vuex';
import axios from 'axios';
import config from '../config/config';
import apiClient from './../scripts/http/axios';
const authPrefix = config.AUTH_PREFIX;
import updateCookie from './../scripts/http/axios';

const state = {
    user: null,
    token: localStorage.getItem('token') || '',
    status: '',
};

const mutations = {
    SET_USER(state, user) {
        state.user = user;
    },
    SET_TOKEN(state, token) {
        state.token = token;
    },
    SET_STATUS(state, status) {
        state.status = status;
    },
    CLEAR_AUTH_DATA(state) {
        state.user = null;
        state.token = null;
    },
};

const actions = {
    login({commit}, credentials) {
        commit('SET_STATUS', 'loading');
        return axios.post(authPrefix + '/login', credentials)
            .then((response) => {
                const token = response.data.access_token;
                localStorage.setItem('token', token);
                axios.defaults.headers.common.Authorization = `Bearer ${token}`;
                commit('SET_TOKEN', token);
                commit('SET_STATUS', 'success');
                // Promise.all(this.dispatch('getUser'))
                return response
            })
            .catch((error) => {
                commit('SET_STATUS', 'error');
                localStorage.removeItem('token');
                delete axios.defaults.headers.common.Authorization;
                throw error;
            });
    },
    register({commit}, credentials) {
        return axios.post(authPrefix + '/register', credentials)
            .then(({data}) => {
                return data
            })
            .catch((error) => {
                throw error
            });
    },
    logout({commit}) {
        commit('CLEAR_AUTH_DATA');
        localStorage.removeItem('token');
        delete axios.defaults.headers.common.Authorization;
        return axios.post(authPrefix + '/logout');
    },

    getUser({commit}) {
        return axios.get('/user')
            .then((response) => {
                const user = response.data;
                commit('SET_USER', user);
                return user;
            })
            .catch((error) => {
                throw error;
            });
    },
};

const getters = {
    isLoggedIn: state => !!state.token,
    authStatus: state => state.status,
    currentUser: state => state.user,
    isAuthenticated(state) {
        return state.user !== null && state.token !== null;
    },
};

export default new Vuex.Store({
    state,
    mutations,
    actions,
    getters,
});
