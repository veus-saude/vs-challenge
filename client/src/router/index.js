import Vue from 'vue';
import VueRouter from 'vue-router';

import AuthService from './../Services/AuthService';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'hash',
  routes: [
    {
      path: '/',
      component: () => import('../layouts/FullPage.vue'),
      children: [
        {
          path: '/login',
          name: 'login',
          component: () => import('../pages/auth/Login.vue'),
        },
        {
          path: '/register',
          name: 'register',
          component: () => import('../pages/auth/Register.vue'),
        },
      ],
    },
    {
      path: '/home',
      component: () => import('../layouts/MainPage.vue'),
      children: [
        {
          path: '/',
          name: 'home',
          component: () => import('../pages/Home.vue'),
        },
      ],
    },
  ],
});

router.afterEach(() => {
  AuthService.verify()
  .catch(() => {
    router.push('/login').catch(() => {});
  })
});

export default router;
