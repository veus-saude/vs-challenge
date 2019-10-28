<template>
  <div class="container">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="/">Challenge Veus</a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="/usuarios">
              Usuário
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/produtos">Produtos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/login">Login</a>
          </li>
        </ul>
      </div>
    </nav>

    <slot></slot>
  </div>
</template>

<script>
import VLink from "../components/VLink.vue";

export default {
  components: {
    VLink
  }
};
</script>
