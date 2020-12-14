const instance = axios.create();
instance.interceptors.request.use(function (config) {
    const token = localStorage.getItem('token')
    if(token){
        config.headers.Authorization = `Bearer ${token}`
    }
    config.baseURL = '/api/v1';
    return config;
}, function (error) {
    // Do something with request error
    return Promise.reject(error);
}); 