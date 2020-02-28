<template>
  <div class="app">
    <div class="container">
      <vue-page-transition name="fade">
        <router-view></router-view>
      </vue-page-transition>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FullPage',
};
</script>
