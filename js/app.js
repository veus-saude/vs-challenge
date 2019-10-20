
$(document).ready(function() {
	$.get('api/v1/products', function(response) {
		$('body').html(JSON.stringify(response));
	}, 'json');
});
