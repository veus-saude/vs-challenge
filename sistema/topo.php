 <?php
$sql_user_foto = $sqli->query("SELECT * FROM usuarios WHERE id='".$_SESSION['ID_ADMIN']."'");
$row_user_foto = $sql_user_foto->fetch_assoc();
if ($row_user_foto['foto'] == "") { $avatar = "fotos/avatar.png"; }
if ($row_user_foto['foto'] != "") { $avatar = $row_user_foto['foto']; }
?>

 <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="index.php" class="logo">
                            <i class="icon-c-logo"> <img src="assets/images/logo_sm.png" height="42"/> </i>
                            <span><img src="assets/images/logo_dark.png"/></span>
                        </a>
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="md md-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>




                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                                </li>
                                <li class="dropdown top-menu-item-xs">
                                    <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="avatar_user.php?foto=<?php echo $avatar ?>" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="logout.php"><i class="ti-power-off m-r-10 text-danger"></i> Sair</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->
			
			
<!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <div class="user-details">
                        <div class="pull-left">
                            <img src="avatar_user.php?foto=<?php echo $avatar ?>" alt="" class="thumb-md img-circle">
                        </div>
                        <div class="user-info">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['NOME_ADMIN'] ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="logout.php"><i class="md md-settings-power"></i> Sair</a></li>
                                </ul>
                            </div>
                            <p class="text-muted m-0"></p>
                        </div>
                    </div>
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>

                        	<li class="text-muted menu-title">Menu</li>

                            <li>
                                <a href="marcas.php" class="waves-effect"><i class="ti-star"></i> <span> Marcas </span></a>
                            </li>

							<li>
                                <a href="produtos.php" class="waves-effect"><i class="ti-package"></i> <span> Produtos </span></a>
                            </li>

							<li>
                                <a href="usuarios.php" class="waves-effect"><i class="ti-user"></i> <span> Usuários </span></a>
                            </li>
							
							<li>
                                <a href="exibir_api.php" class="waves-effect"><i class="ti-settings"></i> <span> API </span></a>
                            </li>							

							
                            

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End --> 			