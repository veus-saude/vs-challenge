import axios from 'axios'
import React, { Component } from 'react'
import { Link } from 'react-router-dom'
import api from '../api'
 
class ProductsList extends Component {
 
    constructor () {
        super()
        this.state = {
            products: []
        }
    }
 

    componentDidMount () {
        axios.get(api.products + '?' + api.token).then(response => {
            this.setState({
                products: response.data
            })
        })
    }
 
    // Funçao para deletar um cliente
    deleteProduct (productId) {
            axios.delete(api.products+'/'+`${productId}` + '?' + api.token)
            .then(() => {
 
                    // Usamos o GET depois de uma requisiçao para atualizar a lista
                    return axios.get(api.products + '?' + api.token)
            })
            .then(res => {
 
                    // Editando os dados no state
                    const products = res.data;
                    this.setState({ products });
            })
    }
    render () {
                const { products } = this.state
                return (
                    <div className="container">
                    <h2>Lista de produtos</h2>
                    <table className="table ">
                            <thead>
                                    <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Marca</th>
                                            <th>Pre&ccedil;o</th>
                                            <th>Quantidade</th>
                                            <th>
                                                <Link 
                                                    className='btn btn-primary btn-xs' 
                                                    to='/create'
                                                >
                                                            Adicionar Produto
                                                    </Link>
                                            </th>
                                    </tr>
                            </thead>
                            <tbody>
                                    {
                                        products.map((product, index) => (
                                            <tr key={product.id}>
                                                    <td>{product.id}</td>
                                                        <td>{product.name}</td>
                                                            <td>{product.brand}</td>
                                                            <td>{product.price}</td>
                                                            <td>{product.amount}</td>                               
                                                            <td>
                                                            <Link 
                                                            className='btn btn-default btn-xs' 
                                                            to={`/product/${product.id}`}
                                                        >
                                                            Editar
                                                        </Link>
                                                            <button 
                                                                className="btn btn-danger btn-xs btn-delete"
                                                                onClick={ () => this.deleteProduct(product.id) }
                                                            >
                                                                Excluir
                                                            </button>
                                                    </td>
                                            </tr>
                                            ))
                                        }
                                            
                            </tbody>
                    </table>
            </div>
        )
        }
}
 
export default ProductsList