<style>
	header{
		width:100%;
		height:50px;
		background-color:#FFF;
		position:fixed;
		top:0px;
		left:0px;
		box-shadow:1px 1px 2px 2px #444;
		margin-left:0;
		text-align:center;
		line-height:2;
		color:#777;
	}
	header h1{
		font-size:25px;
		margin:0;
		padding:0;
		width:100%;
	}
	.out{
		position:absolute;
		right:20;
		width:auto;
		height:50px;
		top:0;
	}
	.out:hover{
		cursor:pointer;
	}
</style>
<script type='text/javascript'>
	$('document').ready(function(){
		$('.out').click(function(){
			window.location.replace('login.php');
		});
		
	});
</script>
<header>
	<h1>Software de Assistência Clínica e Laboratorial</h1><img class='out' src='img/out.png'>
</header>