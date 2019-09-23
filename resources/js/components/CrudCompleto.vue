<template>
    <div class="cotainer">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Produtos</h4>
                <div class="card-tools" style="position: absolute;right: 1rem; top: .5rem;">
                    <button class="btn btn-info" @click="novo()">Novo</button>
                </div>
            </div>


    <div class="dv">
        <div class="dv-header">

            <div class="dv-header-columns">
                <span>Pesquisar:  </span>
                <select class="dv-header-select" v-model="query.search_column">
                    <option v-for="column in columns" :value="column">{{column}}</option>
                </select>
            </div>
            <div class="dv-header-operators">
                <select class="dv-header-select"  v-model="query.search_operator">
                    <option v-for="(value, key) in operators" :value="key">{{value}}</option>
                </select>
            </div>
            <div class="dv-header-search">
                <input type="text" class="dv-header-input" placeholder="Pesquisar"
                       v-model="query.search_input"
                       @keyup.enter="fetchIndexData()"
                >
            </div>
            <div class="dv-header-submit">
                <button class="dv-header-btn" @click="fetchIndexData()">Filtrar</button>
            </div>

        </div>
        <div class="dv-body">
            <table class="dv-table">
                 <thead>
                    <tr>
                        <th v-for="column in columns" @click="toggleOrder(column)">
                            <span class="dv-body-column">
                                <span>{{column}}</span>
                                <span classs="dv-table-column" v-if="column === query.column">
                                    <span v-if="query.direction === 'desc'">&darr;</span>
                                    <span v-else>&uarr;</span>
                                </span>
                            </span>
                        </th>
                    </tr>
                 </thead>
                <tbody>
                    <tr v-for="(row, index) in model.data" :key="row.id">
                        <td>{{row.id}}</td>
                        <td>{{row.nome}}</td>
                        <td>{{row.marca}}</td>
                        <td>{{row.preco}}</td>
                        <td>{{row.quantidade}}</td>
                        <td>
                            <button class="btn btn-info btn-sm" @click="editar(row)">
                                Editar
                            </button>
                            <button class="btn btn-danger btn-sm" @click="destroy(row)">
                                Excluir
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="dv-footer">
                <div class="dv-footer-item">
                    <span>Exibindo {{model.from}} - {{model.to}} de {{model.total}} registros</span>
                </div>
                <div class="dv-footer-item">
                    <div class="dv-footer-sub">
                    <span>
                        <span>Registros por página</span>
                        <input type="text" v-model="query.per_page" class="dv-footer-input"
                               @keyup.enter="fetchIndexData()">
                    </span>
                    </div>
                    <div class="dv-footer-sub">
                        <button class="dv-footer-btn" @click="prev()">&laquo</button>
                        <input type="text" v-model="query.page" class="dv-footer-input"
                               @keyup.enter="fetchIndexData()">
                        <button class="dv-footer-btn" @click="next()">&raquo</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="produtoModalLong" tabindex="-1" role="dialog" aria-labelledby="produtoModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="produtoModalLongTitle">{{modoEdicao ? "Editar" : "Adicionar Novo"}} Produto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="modoEdicao ? update():store()" @keydown="form.onKeydown($event)">
                        <div class="modal-body">
                                <alert-error :form="form"></alert-error>
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input v-model="form.nome" type="text" name="nome"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('nome') }">
                                    <has-error :form="form" field="nome"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>marca</label>
                                    <input v-model="form.marca" type="text" name="marca"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('marca') }">
                                    <has-error :form="form" field="marca"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Quantidade</label>
                                    <input v-model="form.quantidade" type="number" name="quantidade"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('quantidade') }">
                                    <has-error :form="form" field="quantidade"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Preço</label>
                                    <input v-model="form.preco" type="number" name="preco"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('preco') }">
                                    <has-error :form="form" field="preco"></has-error>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button :disabled="form.busy" type="submit"  class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <vue-progress-bar></vue-progress-bar>
        <vue-snotify></vue-snotify>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        props: ['source', 'title'],
        data() {
            return {
                modoEdicao: false,
                model: {},
                columns: {
                    id:'id',
                    nome:'nome',
                    marca:'marca',
                    preco:'preco',
                    quantidade:'quantidade',
                    acao:'acao'
                },
                query: {
                    page: 1,
                    column: 'id',
                    direction: 'desc',
                    per_page: 10,
                    search_column: 'id',
                    search_operator: 'equal',
                    search_input: '',
                },
               operators:{
                    equal: '=',
                    not_equal: '<>',
                    less_than: '<',
                    greater_than: '>',
                    less_than_or_equal_to: '<=',
                    greater_than_or_equal_to: '>=',
                    in:'IN',
                    like:'LIKE'
               },
                form: new Form({
                    id:     '',
                    nome:   '',
                    marca:   '',
                    quantidade:  '',
                    preco:  '',
                })
            }
        },

        created() {
            this.fetchIndexData();
        },

        methods: {
            next() {
                if(this.model.next_page_url){
                    this.query.page++
                    this.fetchIndexData()
                }
            },
            prev() {
               if(this.model.prev_page_url){
                   this.query.page--
                   this.fetchIndexData()
               }
            },
            toggleOrder(column) {
                if(column === this.query.column){
                    //Apenas altera a ordem
                    if(this.query.direction === 'desc'){
                        this.query.direction = 'asc'
                    }else{
                        this.query.direction = 'desc'
                    }
                }else{
                    this.query.column = column
                    this.query.direction = 'asc'
                }

                this.fetchIndexData()
            },
            fetchIndexData() {
                var vm = this
                this.$Progress.start()
                axios.get(`${this.source}?order=${this.query.column}:${this.query.direction}&page=${this.query.page}&per_page=${this.query.per_page}&filter=${this.query.search_column}:${this.query.search_operator}:${this.query.search_input}`)
                    .then(function(response) {
                        Vue.set(vm.$data, 'model', response.data)
                        this.$Progress.finish()

                    })
                    .catch(function(response) {
                        //this.$Progress.fail()
                    })

            },
            novo(){
                this.modoEdicao = false
                this.form.reset()
                this.form.clear()
                $('#produtoModalLong').modal('show');
            },
            store(){
                this.$Progress.start()
                this.form.busy = true
                this.form.post('/api/v1/produtos')
                    .then(response => {
                        console.log('ok');
                        this.fetchIndexData()
                        $('#produtoModalLong').modal('hide')
                        if(this.form.successful)
                        {
                            this.$Progress.finish()
                            this.$snotify.success('Produto cadastrado com sucesso!', 'Sucesso')
                        }else{
                            this.$Progress.fail()
                            this.$snotify.error('Ocorru um erro ao salvar, tente novamente', 'Erro')
                        }
                    })
                    .catch(e => {
                        this.$Progress.fail()
                        console.log(e)
                    })
            },
            editar(row){
                this.modoEdicao = true
                this.form.reset()
                this.form.clear()
                this.form.fill(row)
                $('#produtoModalLong').modal('show')
            },
            update(){

                this.$Progress.start()
                this.form.busy = true
                this.form.put('/api/v1/produtos/' + this.form.id)
                    .then(response => {
                        console.log('ok');
                        this.fetchIndexData()
                        $('#produtoModalLong').modal('hide')
                        if(this.form.successful)
                        {
                            this.$Progress.finish()
                            this.$snotify.success('Produto atualizado com sucesso!', 'Sucesso')
                        }else{
                            this.$Progress.fail()
                            this.$snotify.error('Ocorru um erro ao atualizar, tente novamente', 'Erro')
                        }
                    })
                    .catch(e => {
                        this.$Progress.fail()
                        console.log(e)
                    })

            },
            destroy(row){
                this.$snotify.clear();
                this.$snotify.confirm(
                    "Você não poderá recuperar esses dados!",
                    "Você tem certeza?",
                    {
                        showProgressBar: false,
                        closeOnClick: false,
                        pauseOnHover: true,
                        buttons: [
                            {
                                text: "Sim",
                                action: toast => {
                                    this.$snotify.remove(toast.id);
                                    this.$Progress.start();
                                    axios.delete("/api/v1/produtos/" + row.id)
                                        .then(response => {
                                            this.fetchIndexData();
                                            this.$Progress.finish();
                                            this.$snotify.success(
                                                "Produto excluido com sucesso!",
                                                "Sucesso"
                                            );
                                        })
                                        .catch(e => {
                                            this.$Progress.fail();
                                            console.log(e);
                                        });
                                },
                                bold: true
                            },
                            {
                                text: "Não",
                                action: toast => {
                                    this.$snotify.remove(toast.id);
                                },
                                bold: true
                            }
                        ]
                    }
                );
            }
        }
    }
</script>
