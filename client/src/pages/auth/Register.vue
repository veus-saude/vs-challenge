/* eslint-disable arrow-body-style */
<template>
  <section class="row justify-content-center mt-5">
    <div class="login-card card col-10 col-md-6">
      <div class="card-body">

        <img class="img-fluid mx-auto d-block mt-3 mb-5" src="@/assets/images/veus-logo.png" alt="">

        <div v-if="errors.length > 0" class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>OPS!</strong> Não consegui efetuar o cadastro, verifique os erros abaixo:
          <ul>
            <li v-bind:key="index" v-for="(error, index) in errors">
              {{ error }}
            </li>
          </ul>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div v-if="success.length > 0" class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Bom Trabalho !</strong>
          <ul>
            <li v-bind:key="index" v-for="(success, index) in success">
              {{ success }}
            </li>
          </ul>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form @submit="submitRegister" id="register-form">

          <div class="form-row mb-4">
            <div class="form-group col-md-12">
              <label for="name">nome completo</label>
                <input
                  v-model="name"
                  id="name"
                  class="form-control"
                  type="text"
                  required
                >
            </div>
          </div>

          <div class="form-row mb-4">
            <div class="form-group col-md-6">
              <label for="password">e-mail</label>
              <input
                v-model="email"
                class="form-control"
                id="email"
                type="email"
                required
              >
            </div>

            <div class="form-group col-md-6">
              <label for="password">usuário</label>
              <input
                v-model="username"
                class="form-control"
                id="username"
                type="text"
                required
              >
            </div>
          </div>

          <div class="form-row mb-4">
            <div class="form-group col-md-6">
              <label for="password">senha</label>
              <input
                v-model="password"
                class="form-control"
                id="password"
                type="password"
                required
              >
            </div>

            <div class="form-group col-md-6">
              <label for="password">confirme sua senha</label>
              <input
                v-model="password_confirm"
                class="form-control"
                id="password_confirmation"
                type="password"
                required
              >
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-12 mb-3">
              <p class="text-muted text-signout">
                Já possui conta ?
                <router-link class="link-signout" to="/login">login</router-link>
              </p>
            </div>
          </div>

          <div class="form-row justify-content-center">
            <div class="col-md-6 mb-4">
              <button class="btn btn-veus btn-sm btn-block" type="submit">
                Cadastrar
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
  name: 'Register',
  data() {
    return {
      errors: [],
      success: [],

      // v-models para o formulário de login
      name: null,
      email: null,
      username: '',
      password: '',
      password_confirm: '',
    };
  },
  methods: {
    submitRegister(e) {
      e.preventDefault();

      let data = {
        name: this.name,
        email: this.email,
        username: this.username,
        password: this.password,
        password_confirmation: this.password_confirm
      };

      UserService.register(data)
      .then(() => {

        this.name = '';
        this.email= '';
        this.username = '';
        this.password = '';
        this.password_confirm = '';

        this.success.push('Usuário cadastrado com sucesso.');
      })
      .catch(response => {
        let status = response.response.status;
        let errors = response.response.data.error;

        if(errors && status === 400) {
          for(let key in errors) {
            for(let error of errors[key]) {
              this.errors.push(error);
            }
          }
        }

        this.password = '';
        this.password_confirm = '';
      });

    },
  },
};
</script>
