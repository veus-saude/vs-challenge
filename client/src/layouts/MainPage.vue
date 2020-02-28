<template>
  <div>
    <TopNavbar />
    <div class="container">
      <vue-page-transition name="fade">
        <router-view></router-view>
      </vue-page-transition>
    </div>
  </div>
</template>

<script>
import TopNavbar from '../components/navbars/TopNavbar.vue';

export default {
  name: 'MainPage',
  components: {
    TopNavbar,
  },
};
</script>
