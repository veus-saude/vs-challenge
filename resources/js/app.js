require('./bootstrap');

window.Vue = require('vue');

Vue.component('produtos', require('./components/Produtos.vue').default);
Vue.component('navbar', require('./components/Navbar.vue').default);


const app = new Vue({
    el: '#app',
});
