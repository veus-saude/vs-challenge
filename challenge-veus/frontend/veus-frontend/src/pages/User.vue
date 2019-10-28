<template>
  <main-layout>
    <div class="container-fluid">
      <div class="row bg-dark">
        <div class="col-lg-12">
          <p class="text-center text-light display-4 pt-2" style="font-size: 25px;">Veus - Challenge</p>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-3">
        <div class="col-lg-6">
          <h3 class="text-info">Usuário</h3>
        </div>
        <div class="col-lg-6">
          <button class="btn btn-info float-right" @click="showAddModal=true">
            <i class="fas fa-user"></i> Novo usuário
          </button>
        </div>
      </div>
      <hr class="bg-info" />
      <div class="alert alert-danger" v-if="errorMsg">{{ errorMsg }}</div>
      <div class="alert alert-success" v-if="successMsg">{{ successMsg }}</div>

      <div class="row">
        <div class="col-lg-12">
          <table class="table table-bordered table-striped">
            <thead>
              <tr class="text-center bg-info text-light">
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Login</th>
                <th>Editar</th>
              </tr>
            </thead>
            <tbody>
              <tr class="text-center" v-for="user in users" v-bind:key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.username }}</td>
                <td>
                  <a href="#" class="text-success" @click="showEditModal=true; selectUser(user);">
                    <i class="fas fa-edit"></i>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div id="overlay" v-if="showAddModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Cadastro de usuário</h5>
            <button type="button" class="close" @click="showAddModal=false">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="#" method="POST">
              <div class="form-group">
                <input
                  type="text"
                  name="name"
                  class="form-control form-control-lg"
                  placeholder="Informe seu nome"
                  v-model="this.newUser.name"
                />
              </div>
              <div class="form-group">
                <input
                  type="email"
                  name="email"
                  class="form-control form-control-lg"
                  placeholder="Informe seu e-mail"
                  v-model="this.newUser.email"
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  name="username"
                  class="form-control form-control-lg"
                  placeholder="Informe seu login"
                  v-model="this.newUser.username"
                />
              </div>
              <div class="form-group">
                <input
                  type="password"
                  name="password"
                  class="form-control form-control-lg"
                  placeholder="Informe sua senha"
                  v-model="newUser.password"
                />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="showAddModal=false;">Fechar</button>
            <button
              type="button"
              class="btn btn-primary"
              @click="showAddModal=false;addUser()">Salvar</button>
          </div>
        </div>
      </div>
    </div>
    <div id="overlay" v-if="showEditModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar de usuário</h5>
            <button type="button" class="close" @click="showEditModal=false">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="#" method="POST">
              <div class="form-group">
                <input
                  type="text"
                  name="name"
                  class="form-control form-control-lg"
                  placeholder="Informe seu nome"
                  v-model="currentUser.name"
                />
              </div>
              <div class="form-group">
                <input
                  type="email"
                  name="email"
                  class="form-control form-control-lg"
                  placeholder="Informe seu e-mail"
                  v-model="currentUser.email"
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  name="username"
                  class="form-control form-control-lg"
                  placeholder="Informe seu login"
                  v-model="currentUser.username"
                />
              </div>
              <div class="form-group">
                <input
                  type="password"
                  name="password"
                  class="form-control form-control-lg"
                  placeholder="Informe sua senha"
                  v-model="currentUser.password"
                />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="showEditModal=false">Fechar</button>
            <button
              type="button"
              class="btn btn-primary"
              @click="showEditModal=false;updateUser(currentUser.id)">Salvar</button>
          </div>
        </div>
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
  data: function ()  {
    return {
      errorMsg: false,
      successMsg: false,
      showAddModal: false,
      showEditModal: false,
      users: [],
      newUser: { name: "", email: "", username: "", password: "" },
      currentUser: {},
      dataUser: {}
    }
  },
  created() {
    if (!Authenticator.isLoggedIn()) {
      //window.location = '/login'
    }
    this.getAllUsers();
    // getting the user data
    this.dataUser = Authenticator.getDataUser();
    this.axios.defaults.headers.common.Authorization = `Bearer ${this.dataUser.token}`;
  },
  methods: {
    getAllUsers() {
      // The view model.
      var that = this;
      this.axios.get(`${baseUrl}users`).then(function(response) {
        if (response.data.status == "error") {
          that.errorMsg = response.data.message;
        } else {
          that.users = response.data.data;
        }
      });
    },
    addUser() {
      var that = this;
      var formData = this.toFormData(that.newUser);
      this.axios.post(`${baseUrl}users`, {
        name: that.name,
        email: that.email,
        username: that.username,
        password: that.password
      }).then(function(response) {
        //that.newUser = { name: "", email: "", username: "", password: "" };
        if (response.data.status == "error") {
          that.errorMsg = response.data.message;
        } else {
          that.successMsg = response.data.message;
          this.getAllUsers();
        }
      });
    },
    updateUser(id) {
      var that = this;
      var formData = this.toFormData(that.currentUser);
      this.axios
        .put(`${baseUrl}users/${id}`, formData)
        .then(function(response) {
          that.currentUser = {};
          if (response.data.status == "error") {
            that.errorMsg = response.data.message;
          } else {
            that.successMsg = response.data.message;
            this.getAllUsers();
          }
        });
    },
    selectUser(user) {
      this.currentUser = user;
    },
    toFormData(obj) {
      var fd = new FormData();
      for (var i in obj) {
        fd.append(i, obj[i]);
      }
      return fd;
    }
  }
};
</script>
<style>
#overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.6);
}
</style>
