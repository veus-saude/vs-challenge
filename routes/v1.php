<?php
use Api\V1\Controllers\{
	BrandsController,
	ProductsController
};
use Api\Helpers\Response;

switch($path) {
	case 'brands':
		echo (new BrandsController)->index();
		break;
	case 'products':
		echo (new ProductsController)->index();
		break;
	default:
		echo (new Response(404))->plain('Rota não encontrada');
		break;
}
