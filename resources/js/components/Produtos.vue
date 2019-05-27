<template>
  <div class="container">
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li :class="[{ disabled: !pagination.prev_page_url }]" class="page-item">
          <a class="page-link" href="#" @click="pegaProdutos(pagination.prev_page_url)">Anterior</a>
        </li>
        <li class="page-item disabled">
          <a
            class="page-link text-dark"
            href="#"
          >Página {{ pagination.current_page }} de {{ pagination.last_page }}</a>
        </li>
        <li :class="[{ disabled: !pagination.next_page_url }]" class="page-item">
          <a class="page-link" href="#" @click="pegaProdutos(pagination.next_page_url)">Próximo</a>
        </li>
      </ul>
    </nav>
    <div class="card-columns">
      <div class="card" v-for="produto in produtos" v-bind:key="produto.id">
        <div class="card-body">
          <h5 class="card-title">{{ produto.nome }}</h5>
          <p class="card-text">{{ produto.descricao }}</p>
          <hr>
          <button @click="editarProduto(produto)" class="btn btn-warning">Editar</button>
          <button @click="apagarProduto(produto.id)" class="btn btn-danger">Apagar</button>
        </div>
      </div>
    </div>
    <hr>
    <form @submit.prevent="addProduto" class="mb-3">
      <input type="hidden" name="marca" :value="produto.marca_id">
      <div class="form-group">
        <label for="nome">Nome</label>
        <input
          v-model="produto.nome"
          type="text"
          class="form-control"
          id="nome"
          aria-describedby="nomeHelp"
          placeholder="Digite o nome do produto"
        >
      </div>
      <div class="form-group">
        <label for="marca">Marca</label>
        <select class="form-control" id="marca" name="marca" v-model="produto.marca_id">
          <option>Selecine a marca</option>
          <option v-for="marca in marcas" :key="marca.id" :value="marca.id" v-text="marca.nome"></option>
        </select>
      </div>
      <div class="form-group">
        <label for="preco">Preço</label>
        <input
          v-model="produto.preco"
          type="text"
          class="form-control"
          id="preco"
          placeholder="00,00"
        >
      </div>
      <div class="form-group">
        <label for="quantidade">Quantidade</label>
        <input
          v-model="produto.quantidade"
          type="text"
          class="form-control"
          id="quantidade"
          placeholder="0"
        >
      </div>
      <div class="form-group">
        <label for="descricao">Descrição do Produto</label>
        <textarea v-model="produto.descricao" class="form-control" id="descricao" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      produtos: [],
      produto: {
        id: "",
        nome: "",
        marca_id: "",
        preco: "",
        quantidade: "",
        descricao: ""
      },
      marcas: "",
      produto_id: "",
      pagination: "",
      edit: false
    };
  },
  created() {
    this.pegaProdutos();
    this.pegaMarcas();
  },
  methods: {
    pegaMarcas() {
      const vm = this;
      axios
        .get("api/auth/marcas")
        .then(res => {
          vm.marcas = res.data;
        })
        .catch(err => console.log(err));
    },
    pegaProdutos(page_url) {
      let vm = this;
      page_url = page_url || "api/auth/produtos";
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.produtos = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };

      this.pagination = pagination;
    },
    apagarProduto(id) {
      if (confirm("Tem certeza?")) {
        fetch(`api/auth/produto/${id}`, {
          method: "delete"
        })
          .then(res => res.json())
          .then(data => {
            alert("Produto removido");
            this.pegaProdutos();
          })
          .catch(err => console.log(err));
      }
    },
    editarProduto(produto) {
      this.edit = true;
      this.produto.id = produto.id;
      this.produto.nome = produto.nome;
      this.produto.marca_id = produto.marca_id;
      this.produto.preco = produto.preco;
      this.produto.quantidade = produto.quantidade;
      this.produto.descricao = produto.descricao;
    },
    addProduto() {
      if (this.edit === false) {
        fetch("api/produto", {
          method: "post",
          body: JSON.stringify(this.produto),
          headers: {
            "content-type": "applicatin/json"
          }
        })
          .then(res => res.json())
          .then(data => {
            this.produto.nome = "";
            this.produto.marca_id = "";
            this.produto.preco = "";
            this.produto.quantidade = "";
            this.produto.descricao = "";
            alert("Produto adicionado");
            this.pegaProdutos();
          })
          .catch(err => console.log(err));
      } else {
        fetch(`api/produto/${this.produto.id}`, {
          method: "put",
          body: JSON.stringify(this.produto),
          headers: {
            "content-type": "applicatin/json"
          }
        })
          .then(res => res.json())
          .then(data => {
            this.produto.nome = "";
            this.produto.marca = "";
            this.produto.preco = "";
            this.produto.quantidade = "";
            this.produto.descricao = "";
            alert("Produto atualizado");
            this.pegaProdutos();
          })
          .catch(err => console.log(err));
      }
    }
  }
};
</script>
