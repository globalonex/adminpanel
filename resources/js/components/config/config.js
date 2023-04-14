import axios from "axios";

const config = {
    API_PREFIX: "/api",
    AUTH_PREFIX: "/usergate"
}

axios.defaults.baseURL = config.API_PREFIX;

export default config;

