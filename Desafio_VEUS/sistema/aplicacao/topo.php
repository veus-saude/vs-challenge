<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="navbar-header">
    </div>
			
	<div class="navbar-header">
					 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					 <span class="sr-only">Toggle navigation</span>
					 <span class="icon-bar"></span><span class="icon-bar">
					 </span><span class="icon-bar"></span></button> 
					 <a class="navbar-brand" href="index.php">
					 <span class="glyphicon glyphicon-globe"></span>Desafio VEUS</a>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<!--
						<li>
							<a href="#">Link</a>
						</li>
						-->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['s_nome_usuario']; ?></a>
							
						</li>
						<li class="dropdown">
							 <a href="../index.php"><i class="fa fa-fw fa-power-off"></i> Sair </a>
						</li>
					</ul>
				</div>
				
			</nav>