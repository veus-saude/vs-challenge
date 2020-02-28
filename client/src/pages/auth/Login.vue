<template>
  <section class="row justify-content-center mt-5">
    <div class="login-card card col-10 col-md-4">
      <div class="card-body">

        <div class="col-md-12 mb-4 mt-3">
          <img class="img-fluid mx-auto d-block" src="@/assets/images/veus-logo.png" alt="">
        </div>

        <div v-if="loginError" class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Holy guacamole!</strong> You should check in on some of those fields below.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form @submit="submitLogin">

          <div class="form-row mb-4">
            <label :class="activeUsername" for="username">usuário</label>
            <input
              v-model="username"
              :class="['form-control', 'col-md-12']"
              v-on:focus="fucusUsername = true"
              v-on:focusout="fucusUsername = false"
              id="username"
              type="text"
            >
          </div>

          <div class="form-row mb-4">
            <label :class="activePassword" for="password">senha</label>
            <input
              v-model="password"
              :class="['form-control', 'col-md-12']"
              v-on:focus="fucusPassword = true"
              v-on:focusout="fucusPassword = false"
              id="password"
              type="password"
            >
          </div>

          <div class="form-row">
            <div class="col-md-12 mb-3">
              <p class="text-muted text-signout">
                Ainda não possui conta ?
                <router-link class="link-signout" to="/register">cadastre-se</router-link>
              </p>
            </div>
          </div>

          <div class="form-row justify-content-center">
            <div class="col-md-6 mb-3">
              <button class="btn btn-veus btn-sm btn-block" type="submit">
                Login
              </button>
            </div>
          </div>

        </form>

      </div>
    </div>
  </section>
</template>

<script>
import AuthService from './../../Services/AuthService';

export default {
  name: 'Home',
  data() {
    return {
      // eventos para erros de login
      loginError: false,

      // eventos para inputs formulários
      fucusUsername: false,
      fucusPassword: false,

      // v-models para o formulário de login
      username: '',
      password: '',
    };
  },
  computed: {
    activeUsername() {
      return this.fucusUsername ? 'active' : '';
    },
    activePassword() {
      return this.fucusPassword ? 'active' : '';
    },
  },
  methods: {
    submitLogin(e) {
      e.preventDefault();

      AuthService.login(this.username, this.password)
      .then(response => {
        console.log(response);
        this.$router.replace('home');
      })
      .catch(response => {
        console.log(response);
      });
    },
  },
};
</script>
