<?php
use Api\V1\Controllers\{
	BrandsController,
	ProductsController
};
use Api\V1\Helpers\Response;

switch($path) {
    case 'brands':
    	echo (new BrandsController)->index();
    	break;
    case 'products':
    	echo (new ProductsController)->index();
		break;
    default:
        echo (new Response)->json('Rota não especificada');
    	break;
}
