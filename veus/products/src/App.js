import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import Header from './components/Header'
import ProductsList from './components/ProductsList'
import CreateProduct from './components/CreateProduct'
import UpdateProduct from './components/UpdateProduct'
 
import 'bootstrap/dist/css/bootstrap.css'
 
class App extends Component {
  render () {
    return (
      <BrowserRouter>
        <div>
          <Header />
          <Switch>
            <Route exact path='/' component={ProductsList} />
            <Route path='/create' component={CreateProduct} />
            <Route path='/product/:id' component={UpdateProduct} />     
          </Switch>
        </div>
      </BrowserRouter>
    )
  }
}
 
export default App;