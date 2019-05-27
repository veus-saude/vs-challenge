require('./bootstrap');

window.Vue = require('vue');

Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('produtos-componente', require('./components/Produtos.vue').default);
