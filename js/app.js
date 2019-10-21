
$(document).ready(function() {
	generateToken();
});

$('#btn-generate-token').click(function() {
	generateToken();
});

$('#btn-send').click(function() {
	eval($('#input').val());
});

$('#method').change(function() {
	generateCode($(this).val());
});

function generateToken() {
	$.post('api/v1/token', {"login": "admin", "password": "admin"}, function(response) {
		if (response.status == "error") {
			bootbox.alert(response.messages[0]);
			return;
		}

		var token = response.result.token;

		$('#token').val(token);
		if ($('#input').val() == '') {
			generateCode($('#method').val());
		}

		// getProducts();
		// insertProduct();
		// updateProduct();
		// deleteProduct();

		// getBrands();
		// insertBrand();
		// updateBrand();
		// deleteBrand();
	}, 'json');
}

function getTemplateCode() {
	return "$.ajax({\n\
	url: 'api/v1/products',\n\
	headers: {\n\
		'Authorization':'Bearer " + $('#token').val() + "'\n\
	},\n\
	type: '%type%',\n\
	dataType: 'json',\n\
	data: {\n\
		%data%\n\
	},\n\
	success: function(response) {\n\
		$('#output').val(JSON.stringify(response, null, 2));\n\
	}\n\
});";
}

function clearOutput() {
	$('#output').val('');
}

function generateCode(method) {
	clearOutput();

	var code = getTemplateCode();
	code = code.replace('%type%', method);

	switch (method) {
		case 'GET':
			generateGetCode(code);
			break;
		case 'POST':
			generatePostCode(code);
			break;
		case 'PUT':
			generatePutCode(code);
			break;
		case 'DELETE':
			generateDeleteCode(code);
			break;
	}
}

function generateGetCode(code) {
	var data = "\"q\":\"destilador\",\n\
		\"filter\":[\"brand:marte\",\"amount:>10\",\"price:>1000\"]";
	$('#input').val(code.replace('%data%', data));
}

function generatePostCode(code) {
	var data = "\"Product\": {\n\
		\"name\": \"Teste\",\n\
		\"idBrand\": \"1\",\n\
	}";
	$('#input').val(code.replace('%data%', data));
}

function generatePutCode(code) {
	var data = "\"id\": \"0\",\n\
		\"Product\": {\n\
			\"name\": \"Teste Editado\",\n\
			\"price\": \"15.99\",\n\
		}";
	$('#input').val(code.replace('%data%', data));
}

function generateDeleteCode(code) {
	var data = "\"id\":\"0\"";
	$('#input').val(code.replace('%data%', data));
}

function getProducts() {
	$.get('api/v1/products?filter=amount:<10', function(response) {
		$('body').html(JSON.stringify(response));
	}, 'json');
}

function insertProduct() {
	// $.post(
	// 	'api/v1/products',
	// 	{
	// 		"Product": {
	// 			"name": "Teste",
	// 			"idBrand": "1",
	// 		}
	// 	},
	// 	function(response) {
	// 		$('body').html(JSON.stringify(response));
	// 	},
	// 	'json'
	// );
	$.ajax({
		url: 'api/v1/products',
		headers: {
			'Authorization':'Bearer ' + $('#token').val()
		},
		type: 'POST',
		dataType: 'json',
		data: {
			"Product": {
				"name": "Teste",
				"idBrand": "1",
			}
		},
		success: function(response) {
			$('#output').val(JSON.stringify(response, null, 2));
		}
	});
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
