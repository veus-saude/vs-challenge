
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
			"headers": {
				"Authorization": "Bearer " + token
			}
		});

		getProducts();
	}, 'json');
}

function getProducts() {
	$.get('api/v1/products', function(response) {
		$('body').html(JSON.stringify(response));
	}, 'json');
}
