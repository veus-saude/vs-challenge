import React from 'react'
import { Link } from 'react-router-dom'
 
const Header = () => (
 	<nav className='navbar navbar-expand-md navbar-light navbar-laravel' style={{backgroundColor: '#ffb800', marginBottom: '20px'}}>
    	<div className='container'>
			<img src='logo.png'/>
      		<Link className='navbar-brand' to='/'>Veus Products 1.0</Link>
    	</div>
  	</nav>
)
 
export default Header