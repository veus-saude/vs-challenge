<template>
  <main-layout>
    <div class="container-fluid">
      <div class="row bg-dark">
        <div class="col-lg-12">
          <p class="text-center text-light display-4 pt-2" style="font-size: 25px;">Veus - Challenge</p>
        </div>
      </div>
    </div>

    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
          <form>
            <h2>Área de Login</h2>
            <div>
              <input
                type="text"
                class="form-control"
                v-model="username"
                placeholder="Usuário"
                required
              />
            </div>
            <div>
              <input
                type="password"
                class="form-control"
                v-model="password"
                placeholder="Senha"
                required
              />
            </div>
            <div>
              <a class="btn btn-success btn-lg" @click="login">
                <i class="fa fa-check-circle"></i> Entrar
              </a>
            </div>
            <div class="clearfix"></div>
            <div class="separator"></div>
          </form>
        </section>
      </div>
    </div>
  </main-layout>
</template>

<script>
import MainLayout from "../layouts/Main.vue";
import Authenticator from "../common/Authenticator";
import VLink from "../components/VLink.vue";

const baseUrl = "http://localhost/desafio-veus/backend/public/api/";

export default {
  components: {
    MainLayout
  },
  data: function() {
    return {
      username: "",
      password: ""
    };
  },
  created() {
    if (Authenticator.isLoggedIn()) {
      //this.$router.push("/");
    }
  },
  methods: {
    login() {
      if (!this.password && !this.username) {
        console.log("O campo Usuário e Senha deve ser preenchido.");
        return;
      }
      // active progress bar
      this.axios
        .post(`${baseUrl}auth`, {
          username: this.username,
          password: this.password
        })
        .then(response => {
          // register JWT for user
          Authenticator.registerUser(response);
          // remove login class
          // redirect to home
          this.$router.push("/");
        })
        .catch(response => {
          // dialog window
          if (response.response && response.response.status === 401) {
            console.log(
              "Não foi possível autenticar o usuário. Verifique se digitou corretamente"
            );
          } else {
            console.log("Houve um erro ao conectar com servidor...");
            console.error(response);
          }
        });
    }
  }
};
</script>

