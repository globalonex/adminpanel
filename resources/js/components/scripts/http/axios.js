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

export function getProducts(page = 1) {
    return axios.get(`/products?page=${page}`)
        .then((response) => {
            return response.data.data.data
        })
        .catch(error => {
            console.error(error);
        });
}
export function getCategories(page = 1) {
    return axios.get(`/category/categories`)
        .then((response) => {
            console.log(response.data)
            return response.data
        })
        .catch(error => {
            console.error(error);
        });
}

const updateCookie = () => {
    document.cookie = "XSRF-TOKEN=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    return apiDef.get('/sanctum/csrf-cookie');
}


