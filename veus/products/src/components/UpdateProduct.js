import axios from 'axios'
import React, { Component } from 'react'
import api from '../api'
import { withRouter } from 'react-router-dom'
 
class UpdateProduct extends Component {
 
  constructor (props) {
    super(props)
    this.state = {
      name: '',
      brand: '',
      price: '',
      amount: ''
    }
    this.handleFieldChange = this.handleFieldChange.bind(this)
    this.onSubmit = this.onSubmit.bind(this)
  }
 
  componentDidMount () {
    const productId = this.props.match.params.id
 
    axios.get(api.products+`/${productId}` + '?' + api.token).then(response => {
      this.setState({
        name: response.data.name,
        brand: response.data.brand,
        price: response.data.price,
        amount: response.data.amount
      })
    })
  }
 
  handleFieldChange (event) {
    this.setState({
      [event.target.name]: event.target.value
    })
  }
 
  onSubmit (event) {
    event.preventDefault();
    const { history } = this.props
    const product = {
      name: this.state.name,
      brand: this.state.brand,
      price: this.state.price,
      amount: this.state.amount
    }
    axios.post(api.products+'/'+this.props.match.params.id + '?' + api.token, product)
      .then(response => {
        history.push('/')
      })
      .catch(error => {
        this.setState({
          errors: error.response.data.errors
        })
      })
  }
 
  render () {
    return (
      <div className='container'>
        <div className='row justify-content-center'>
          <div className='col-md-12'>
            <div className='card'>
              <div className='card-header'>Criar novo produto</div>
              <div className='card-body'>
                <form onSubmit={this.onSubmit}>
                  <div className='form-group'>
                    <label htmlFor='name'>Nome</label>
                    <input
                      id='name'
                      type='text'
                      className='form-control'
                      name='name'
                      value={this.state.name}
                      onChange={this.handleFieldChange}
                    />
                  </div>
                  <div className='form-group'>
                    <label htmlFor='brand'>Marca</label>
                    <input
                      id='brand'
                      type='text'
                      className='form-control'
                      name='brand'
                      value={this.state.brand}
                      onChange={this.handleFieldChange}
                    />
                  </div>
                  <div className='form-group'>
                    <label htmlFor='price'>Pre&ccedil;o</label>
                    <input
                      id='price'
                      type='number'
                      className='form-control'
                      name='price'
                      value={this.state.price}
                      onChange={this.handleFieldChange}
                    />
                  </div>
                  <div className='form-group'>
                    <label htmlFor='cpf'>Quantidade</label>
                    <input
                      id='amount'
                      type='number'
                      className='form-control'
                      name='amount'
                      value={this.state.amount}
                      onChange={this.handleFieldChange}
                    />
                  </div>                  
                  <button onClick={ () => this.props.history.goBack()} className='btn btn-default'>Cancelar</button>
                  <button className='btn btn-primary'>Atualizar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    )
  }
}
 
export default UpdateProduct