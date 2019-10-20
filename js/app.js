
var token = '';

$(document).ready(function() {

	getToken();
	
});

function getToken() {
	$.post('api/v1/token', {"login": "admin", "password": "admin"}, function(response) {
		if (response.status == "error") {
			$('body').html(response.messages[0]);
			return;
		}

		token = response.result.token;
		
		$.ajaxSetup({
			headers: {
				"Authorization": "Bearer " + token
			}
		});

		// getProducts();
		// insertProduct();
		// updateProduct();
		// deleteProduct();

		// getBrands();
		// insertBrand();
		// updateBrand();
		deleteBrand();
	}, 'json');
}

function getProducts() {
	$.get('api/v1/products?filter=amount:<10', function(response) {
		$('body').html(JSON.stringify(response));
	}, 'json');
}

function insertProduct() {
	$.post(
		'api/v1/products',
		{
			"Product": {
				"name": "Teste",
				"idBrand": "1",
			}
		},
		function(response) {
			$('body').html(JSON.stringify(response));
		},
		'json'
	);
}

function updateProduct() {
	$.ajax({
		url: 'api/v1/products',
		type: 'PUT',
		dataType: 'json',
		contentType: 'application/json',
		data: {
			"id": "12",
			"Product": {
				"name": "Teste Editado",
				"price": "15.99",
			}
		},
		success: function(response) {
			$('body').html(JSON.stringify(response));
		}
	});
}

function deleteProduct() {
	$.ajax({
		url: 'api/v1/products',
		type: 'DELETE',
		dataType: 'json',
		contentType: 'application/json',
		data: {
			"id": "12",
		},
		success: function(response) {
			$('body').html(JSON.stringify(response));
		}
	});
}

function getBrands() {
	$.get('api/v1/brands?filter=name:marte', function(response) {
		$('body').html(JSON.stringify(response));
	}, 'json');
}

function insertBrand() {
	$.post(
		'api/v1/brands',
		{
			"Brand": {
				"name": "Teste",
			}
		},
		function(response) {
			$('body').html(JSON.stringify(response));
		},
		'json'
	);
}

function updateBrand() {
	$.ajax({
		url: 'api/v1/brands',
		type: 'PUT',
		dataType: 'json',
		contentType: 'application/json',
		data: {
			"id": "7",
			"Brand": {
				"name": "Teste Editado",
			}
		},
		success: function(response) {
			$('body').html(JSON.stringify(response));
		}
	});
}

function deleteBrand() {
	$.ajax({
		url: 'api/v1/brands',
		type: 'DELETE',
		dataType: 'json',
		contentType: 'application/json',
		data: {
			"id": "8",
		},
		success: function(response) {
			$('body').html(JSON.stringify(response));
		}
	});
}
