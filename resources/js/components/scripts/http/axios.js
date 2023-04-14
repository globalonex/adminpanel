import axios from 'axios';

const apiClient = axios.create({ // template
    baseURL: '/api',
    withCredentials: true,
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
    },
});

const apiRequest = axios.post('')


export default {apiClient}
