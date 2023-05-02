import axios from 'axios';

const apiClient = axios.create({ // template
    baseURL: '/api', withCredentials: true, headers: {
        Accept: 'application/json', 'Content-Type': 'application/json',
    },
});

const apiDef = axios.create({ // template
    baseURL: '/', withCredentials: true, headers: {
        Accept: 'application/json', 'Content-Type': 'application/json',
    },
});

// const getCategories = axios.get('/api/products')
//     .then(response => {
//         this.products = response.data;
//     })
//     .catch(error => {
//         console.error(error);
//     });

const updateCookie = () => {
    document.cookie = "XSRF-TOKEN=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    return apiDef.get('/sanctum/csrf-cookie');
}


export default {apiClient, updateCookie}
