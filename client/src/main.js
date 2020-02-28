import Vue from 'vue';
import VuePageTransition from 'vue-page-transition';
import VueGoodTable from 'vue-good-table';
import { ValidationProvider } from 'vee-validate';

import App from './App.vue';
import router from './router';
import Validation from './Providers/Validation';

import './assets/scss/app.scss';
import 'vue-good-table/dist/vue-good-table.css';

Vue.config.productionTip = false;

Vue.use(VuePageTransition);
Vue.use(VueGoodTable);

Validation.init();

Vue.component('ValidationProvider', ValidationProvider);

new Vue({
  router,
  render: (h) => h(App),
}).$mount('#app');
