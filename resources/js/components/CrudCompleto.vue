<template>
    <div class="cotainer">
        <div class="card">
            <div class="card-header">
                Produtos
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
                            <button class="btn btn-info btn-sm">
                                Editar
                            </button>
                            <button class="btn btn-danger btn-sm">
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
               }
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

            }
        }
    }
</script>
