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
          <h3 class="text-info">Produto</h3>
        </div>
        <div class="col-lg-6">
          <button class="btn btn-info float-right" @click="showAddModal=true">
            <i class="fas fa-product"></i> Novo Produto
          </button>
        </div>
      </div>
      <hr class="bg-info" />
      <div class="alert alert-danger" v-if="errorMsg">{{ errorMsg }}</div>
      <div class="alert alert-success" v-if="successMsg">{{ successMsg }}</div>
      <div class="row">
        <div class="col-lg-4">
          <input type="text" class="form-control" v-model="filterProduct.name" placeholder="Nome" />
        </div>
        <div class="col-lg-4">
          <input type="text" class="form-control" v-model="filterProduct.brand" placeholder="Marca" />
        </div>
        <div class="col-lg-3">
          <input type="text" class="form-control" v-model="filterProduct.price" placeholder="Preço" />
        </div>
        <div class="col-lg-1">
          <button class="btn btn-info" @click="filtro()">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <table class="table table-bordered table-striped">
            <thead>
              <tr class="text-center bg-info text-light">
                <th>ID</th>
                <th>Nome</th>
                <th>Marca</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Editar</th>
              </tr>
            </thead>
            <tbody>
              <tr class="text-center" v-for="product in products" v-bind:key="product.id">
                <td>{{ product.id }}</td>
                <td>{{ product.name }}</td>
                <td>{{ product.brand }}</td>
                <td>{{ product.price }}</td>
                <td>{{ product.stock }}</td>
                <td>
                  <a
                    href="#"
                    class="text-success"
                    @click="showEditModal=true; selectProduct(product);"
                  >
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
            <h5 class="modal-title">Cadastro de Produto</h5>
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
                  placeholder="Informe o nome do produto"
                  v-model="newProduct.name"
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  name="brand"
                  class="form-control form-control-lg"
                  placeholder="Informe sua marca"
                  v-model="newProduct.brand"
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  name="price"
                  class="form-control form-control-lg"
                  placeholder="Informe o preço do produto"
                  v-model="newProduct.price"
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  name="stock"
                  class="form-control form-control-lg"
                  placeholder="Informe o estoque"
                  v-model="newProduct.stock"
                />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="showAddModal=false;">Fechar</button>
            <button
              type="button"
              class="btn btn-primary"
              @click="showAddModal=false;addProduct()"
            >Salvar</button>
          </div>
        </div>
      </div>
    </div>
    <div id="overlay" v-if="showEditModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar de Produto</h5>
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
                  placeholder="Informe o nome do produto"
                  v-model="currentProduct.name"
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  name="brand"
                  class="form-control form-control-lg"
                  placeholder="Informe sua marca"
                  v-model="currentProduct.brand"
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  name="price"
                  class="form-control form-control-lg"
                  placeholder="Informe o preço do produto"
                  v-model="currentProduct.price"
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  name="stock"
                  class="form-control form-control-lg"
                  placeholder="Informe o estoque"
                  v-model="currentProduct.stock"
                />
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="showEditModal=false">Fechar</button>
            <button
              type="button"
              class="btn btn-primary"
              @click="showEditModal=false;updateProduct(currentProduct.id)"
            >Salvar</button>
          </div>
        </div>
      </div>
    </div>
  </main-layout>
</template>

<script>
import MainLayout from "../layouts/Main.vue";
import Authenticator from '../common/Authenticator';
const baseUrl = "http://localhost/desafio-veus/backend/public/api/";

export default {
  components: {
    MainLayout
  },
  data: function() {
    return {
      errorMsg: false,
      successMsg: false,
      showAddModal: false,
      showEditModal: false,
      products: [],
      newProduct: { name: "", brand: "", price: "", stock: "" },
      currentProduct: {},
      filterProduct: { name: "", brand: "", price: "" }
    };
  },
  created() {
    if (!Authenticator.isLoggedIn()) {
      window.location = '/login'
    }
    this.getAllProducts();
  },
  methods: {
    filtro() {
      var app = this;
      var query = app.filterProduct.name;
      var brand = app.filterProduct.brand;
      var price = app.filterProduct.price;
      if (query || brand || price) {
        var filter = brand ? `brand:${brand}` : `price:${price}`;
        this.axios
          .get(`${baseUrl}products/filter?q=${query}&filter=${filter}`)
          .then(function(response) {
            if (response.data.status == "error") {
              app.errorMsg = response.data.message;
            } else {
              app.products = response.data.data.data;
            }
          });
      } else {
        app.getAllProducts();
      }
    },
    getAllProducts() {
      var app = this;
      this.axios.get(`${baseUrl}products`).then(function(response) {
        if (response.data.status == "error") {
          app.errorMsg = response.data.message;
        } else {
          app.products = response.data.data.data;
        }
      });
    },
    addProduct() {
      var app = this;
      this.axios
        .post(`${baseUrl}products`, {
          name: app.newProduct.name,
          brand: app.newProduct.brand,
          price: parseFloat(app.newProduct.price),
          stock: parseFloat(app.newProduct.stock)
        })
        .then(function(response) {
          app.newProduct = { name: "", brand: "", price: "", stock: "" };
          if (response.data.status == "error") {
            app.errorMsg = response.data.message;
          } else {
            app.successMsg = response.data.message;
            app.getAllProducts();
          }
        });
    },
    updateProduct(id) {
      var app = this;
      this.axios
        .put(`${baseUrl}products/${id}`, {
          name: app.currentProduct.name,
          brand: app.currentProduct.brand,
          price: parseFloat(app.currentProduct.price),
          stock: parseFloat(app.currentProduct.stock)
        })
        .then(function(response) {
          app.currentProduct = {};
          if (response.data.status == "error") {
            app.errorMsg = response.data.message;
          } else {
            app.successMsg = response.data.message;
            app.getAllProducts();
          }
        });
    },
    selectProduct(product) {
      this.currentProduct = product;
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