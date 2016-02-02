<?php
include "../utils/utils.php";
include "../classes/mysql.php";


function navbar()
{
session_name('userlogin');
//session_id($_GET['PHPSESSID']);
session_start();
$user = $_SESSION['user'];

echo "
		<div id='navbar' class='navbar navbar-default'>
			<script type='text/javascript'>
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class='navbar-container' id='navbar-container'>
				<!-- #section:basics/sidebar.mobile.toggle -->
				<button type='button' class='navbar-toggle menu-toggler pull-left' id='menu-toggler' data-target='#sidebar'>
					<span class='sr-only'>Toggle sidebar</span>

					<span class='icon-bar'></span>

					<span class='icon-bar'></span>

					<span class='icon-bar'></span>
				</button>

				<!-- /section:basics/sidebar.mobile.toggle -->
				<div class='navbar-header pull-left'>
					<!-- #section:basics/navbar.layout.brand -->
					<a href='#' class='navbar-brand'>
						<small>
						<span style='font-weight: bold'>
							<img src='../assets/images/Logo_DMP_Brasil.png' width='40' height='24'><img src='../assets/images/Logo_NOVATEC.png' width='60' height='25'> Gestão de Serviços</span> </small>
					</a>

					<!-- /section:basics/navbar.layout.brand -->

					<!-- #section:basics/navbar.toggle -->

					<!-- /section:basics/navbar.toggle -->
				</div>

				<!-- #section:basics/navbar.dropdown -->
				<div class='navbar-buttons navbar-header pull-right' role='navigation'>
					<ul class='nav ace-nav'>
						<li class='red tooltip-info' data-rel='tooltip' data-placement='bottom' title='OSs com pendências'>
							<a href='navbar_a.php'>
								<i class='ace-icon fa fa-warning'></i>
								<span class='badge badge-grey'><div id='papel'>$num1</div></span>
							</a>

		                  </li>

						<li class='yellow tooltip-info' data-rel='tooltip' data-placement='bottom' title='OSs em aberto'>
							<a href='navbar_b.php'>
								<i class='ace-icon fa fa-bell icon-animated-bell'></i>
								<span class='badge badge-important'><div id='sino'>$num2</div></span>
							</a>

						</li>

						<li class='green tooltip-info' data-rel='tooltip' data-placement='bottom' title='Técnicos em atendimento'>
							<a href='navbar_c.php'>
								<i class='ace-icon fa fa-envelope icon-animated-vertical'></i>
								<span class='badge badge-success'><div id='carta'>$num3</div></span>
							</a>

						</li>

						<!-- #section:basics/navbar.user_menu -->
						<li class='light-blue'>
							<a data-toggle='dropdown' href='#' class='dropdown-toggle'>
								<img class='nav-user-photo' src='../assets/avatars/avatar2.png' alt='Foto do Usuário' />
								<span class='user-info'><small>Bem Vindo,</small>$user</span>

								<i class='ace-icon fa fa-caret-down'></i>
							</a>

							<ul class='user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close'>
								<!--<li>
									<a href='#'>
										<i class='ace-icon fa fa-cog'></i>
										Configurações
									</a>
								</li>

								<li>
									<a href='#'>
										<i class='ace-icon fa fa-print '></i>
										Imprimir
									</a>
								</li>

								<li class='divider'></li> -->

								<li>
									<a href='utils/logout.php'>
										<i class='ace-icon fa fa-power-off'></i>
										Sair
									</a>
								</li>
							</ul>
						</li>

						<!-- /section:basics/navbar.user_menu -->
					</ul>
				</div>

				<!-- /section:basics/navbar.dropdown -->
			</div><!-- /.navbar-container -->
		</div>
";
}

function sidebar(){
echo "
			<div id='sidebar' class='sidebar responsive'>
				<script type='text/javascript'>
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<div class='sidebar-shortcuts' id='sidebar-shortcuts'>
					<div class='sidebar-shortcuts-large' id='sidebar-shortcuts-large'>
						

						<!-- /section:basics/sidebar.layout.shortcuts -->
					</div>

					
				</div><!-- /.sidebar-shortcuts -->

				<ul class='nav nav-list'>
					<li class='active'>
						<a href='home.php'>
							<i class='menu-icon fa fa-home'></i>
							<span class='menu-text'> Home </span>
						</a>

						<b class='arrow'></b>
					</li>

					<li class=''>
                     <a href='#' class='dropdown-toggle'> 
							<i class='menu-icon fa fa-map-marker'></i>
							<span class='menu-text'>
								Mapa 
							</span>
							<b class='arrow fa fa-angle-down'></b>
                               </a>
							 <b class='arrow'></b>

						 <ul class='submenu'>
							
							<li class=''>
								
									<!--<a href='mapa.html'> -->
									<a href='#'>
										<i class='menu-icon fa fa-caret-right'></i>
										Mapa
									</a>

									<b class='arrow'></b>
							</li>
							
							<li class=''>
									<a href='#'>
										<i class='menu-icon fa fa-caret-right'></i>
										Clientes
									</a>

									<b class='arrow'></b>
							</li>
								
								 <li class=''>
									<a href='#'>
										<i class='menu-icon fa fa-caret-right'></i>
										Colaboradores
									</a>

									<b class='arrow'></b>
							</li>
								
								 <li class=''>
									<a href='ordem_servico.php'>
										<i class='menu-icon fa fa-caret-right'></i>
										Ordens de Serviços
									</a>

									<b class='arrow'></b>
							</li>
						</ul>

					 </li>
                    
                    
                    <li class=''>
                    <a href='clientes.php'>  
							<i class='menu-icon fa fa-user'></i>
							<span class='menu-text'> Clientes </span>

							</a>
	                    <b class='arrow'></b>					

						</li>
                        

					<li class=''>
                    	<a href='colaboradores.php'>
							<i class='menu-icon fa fa-users'></i>
							<span class='menu-text'> Colaboradores </span>

							</a>
	                    <b class='arrow'></b>					

						</li>
                       
                        
                        <li class=''>
                        <a href='ordem_servico.php'>  
							<i class='menu-icon fa fa-file-text'></i>
							<span class='menu-text'> Ordens de Serviços </span>

							</a>
	                    <b class='arrow'></b>					

						</li>
                       

					<li class=''>
                    <a href='produtos.php'>  
							<i class='menu-icon fa fa-shopping-cart'></i>
							<span class='menu-text'> Produtos </span>
                             </a>
							
						<b class='arrow'></b>

						</li>
                        

						
					
                    <li class=''>
                    <a href='projetos.php'>  
							<i class='menu-icon fa fa-barcode'></i>
							<span class='menu-text'> Projetos </span>

							
						</a>

						<b class='arrow'></b>

						</li>
                       
					

					<li class=''>
                    	<a href='#'>
							<i class='menu-icon fa fa-list-alt'></i>
							<span class='menu-text'> Relatórios </span>
						</a>

						<b class='arrow'></b>
					</li>
                    
                    
                    


					
				</ul><!-- /.nav-list -->

				<!-- #section:basics/sidebar.layout.minimize -->
				<div class='sidebar-toggle sidebar-collapse' id='sidebar-collapse'>
					<i class='ace-icon fa fa-angle-double-left' data-icon1='ace-icon fa fa-angle-double-left' data-icon2='ace-icon fa fa-angle-double-right'></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
				<script type='text/javascript'>
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>
";
}

function footer(){
echo "
			<div class='footer'>
				<div class='footer-inner'>
					<!-- #section:basics/footer -->
					<div class='footer-content'>
						<span class='bigger-120'>
							<span class='blue bolder'>DMP</span>
							Brasil   -   
							
							<span class='blue bolder'>NOVATEC</span>
							  SYSTEMS &copy; 2015
						</span>

						&nbsp; &nbsp;
						
					</div>

					<!-- /section:basics/footer -->
				</div>
			</div>
";
}
?>