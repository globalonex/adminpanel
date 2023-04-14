import store from './../../store/store';

const authMiddleware = (handler) => (request) => {
    const isAuthenticated = store.getters['auth/isLoggedIn'];

    if (!isAuthenticated) {
        return Promise.reject({ url: '/login' });
    }

    return handler(request);
};

export default authMiddleware;
