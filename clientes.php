<!DOCTYPE html>
<html lang="en">
<head>
    <title>Clientes</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="images/icons/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/icons/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/icons/favicon-114x114.png">
    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="styles/jquery-ui-1.10.4.custom.min.css">
    <link type="text/css" rel="stylesheet" href="styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="styles/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="styles/animate.css">
    <link type="text/css" rel="stylesheet" href="styles/all.css">
    <link type="text/css" rel="stylesheet" href="styles/main.css">
    <link type="text/css" rel="stylesheet" href="styles/style-responsive.css">
    <link type="text/css" rel="stylesheet" href="styles/zabuto_calendar.min.css">
    <link type="text/css" rel="stylesheet" href="styles/pace.css">
    <link type="text/css" rel="stylesheet" href="styles/jquery.news-ticker.css">
</head>
<body>
    <div>
        <!--BEGIN THEME SETTING-->
        <div id="theme-setting">
            <a href="#" data-toggle="dropdown" data-step="1" data-intro="&lt;b&gt;Many styles&lt;/b&gt; and &lt;b&gt;colors&lt;/b&gt; be created for you. Let choose one and enjoy it!"
                data-position="left" class="btn-theme-setting"><i class="fa fa-cog"></i></a>
            <div class="content-theme-setting">
                <select id="list-style" class="form-control">
                    <option value="style1">Flat Squared style</option>
                    <option value="style2">Flat Rounded style</option>
                    <option value="style3" selected="selected">Flat Border style</option>
                </select>
            </div>
        </div>
        <!--END THEME SETTING-->
        <!--BEGIN BACK TO TOP-->
        <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
        <!--END BACK TO TOP-->
        <!--BEGIN TOPBAR-->
        <div id="header-topbar-option-demo" class="page-header-topbar">
            <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a id="logo" href="index.html" class="navbar-brand"><span class="fa fa-rocket"></span><span class="logo-text">Meu Gerente</span><span style="display: none" class="logo-text-icon">µ</span></a></div>
            <div class="topbar-main"><a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>
                
                <form id="topbar-search" action="" method="" class="hidden-sm hidden-xs">
                    <div class="input-icon right text-white"><a href="#"><i class="fa fa-search"></i></a><input type="text" placeholder="Search here..." class="form-control text-white"/></div>
                </form>
                <div class="news-update-box hidden-xs"><span class="text-uppercase mrm pull-left text-white">News:</span>
                    <ul id="news-update" class="ticker list-unstyled">
                        <li>Welcome to KAdmin - Responsive Multi-Style Admin Template</li>
                        <li>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque.</li>
                    </ul>
                </div>
                <ul class="nav navbar navbar-top-links navbar-right mbn">
                    <li class="dropdown"><a data-hover="dropdown" href="#" class="dropdown-toggle"><i class="fa fa-bell fa-fw"></i><span class="badge badge-green">3</span></a>
                        
                    </li>
                    <li class="dropdown"><a data-hover="dropdown" href="#" class="dropdown-toggle"><i class="fa fa-envelope fa-fw"></i><span class="badge badge-orange">7</span></a>
                        
                    </li>
                    <li class="dropdown"><a data-hover="dropdown" href="#" class="dropdown-toggle"><i class="fa fa-tasks fa-fw"></i><span class="badge badge-yellow">8</span></a>
                        
                    </li>
                    <li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle"><img src="images/avatar/48.jpg" alt="" class="img-responsive img-circle"/>&nbsp;<span class="hidden-xs">Robert John</span>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-user pull-right">
                            <li><a href="#"><i class="fa fa-user"></i>My Profile</a></li>
                            <li><a href="#"><i class="fa fa-calendar"></i>My Calendar</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i>My Inbox<span class="badge badge-danger">3</span></a></li>
                            <li><a href="#"><i class="fa fa-tasks"></i>My Tasks<span class="badge badge-success">7</span></a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="fa fa-lock"></i>Lock Screen</a></li>
                            <li><a href="Login.html"><i class="fa fa-key"></i>Log Out</a></li>
                        </ul>
                    </li>
                    <li id="topbar-chat" class="hidden-xs"><a href="javascript:void(0)" data-step="4" data-intro="&lt;b&gt;Form chat&lt;/b&gt; keep you connecting with other coworker" data-position="left" class="btn-chat"><i class="fa fa-comments"></i><span class="badge badge-info">3</span></a></li>
                </ul>
            </div>
        </nav>
            <!--BEGIN MODAL CONFIG PORTLET-->
            <div id="modal-config" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                                &times;</button>
                            <h4 class="modal-title">
                                Modal title</h4>
                        </div>
                        <div class="modal-body">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eleifend et nisl eget
                                porta. Curabitur elementum sem molestie nisl varius, eget tempus odio molestie.
                                Nunc vehicula sem arcu, eu pulvinar neque cursus ac. Aliquam ultricies lobortis
                                magna et aliquam. Vestibulum egestas eu urna sed ultricies. Nullam pulvinar dolor
                                vitae quam dictum condimentum. Integer a sodales elit, eu pulvinar leo. Nunc nec
                                aliquam nisi, a mollis neque. Ut vel felis quis tellus hendrerit placerat. Vivamus
                                vel nisl non magna feugiat dignissim sed ut nibh. Nulla elementum, est a pretium
                                hendrerit, arcu risus luctus augue, mattis aliquet orci ligula eget massa. Sed ut
                                ultricies felis.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">
                                Close</button>
                            <button type="button" class="btn btn-primary">
                                Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--END MODAL CONFIG PORTLET-->
        </div>
        <!--END TOPBAR-->
        <div id="wrapper">
            <!--BEGIN SIDEBAR MENU-->
            <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;"
                data-position="right" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">
                    
                     <div class="clearfix"></div>
                    <li><a href="dashboard.html"><i class="fa fa-tachometer fa-fw">
                        <div class="icon-bg bg-orange"></div>
                    </i><span class="menu-title">Painel de Controle</span></a></li>
                    <li class="active"><a href="cliente.php"><i class="fa fa-users fa-fw">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">Cliente</span></a>
                    </li>
                    <li><a href="UIElements.html"><i class="fa fa-send-o fa-fw">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">UI Elements</span></a>
                       
                    </li>
                    <li><a href="Forms.html"><i class="fa fa-edit fa-fw">
                        <div class="icon-bg bg-violet"></div>
                    </i><span class="menu-title">Forms</span></a>
                      
                    </li>
                    <li><a href="Tables.html"><i class="fa fa-th-list fa-fw">
                        <div class="icon-bg bg-blue"></div>
                    </i><span class="menu-title">Tables</span></a>
                          
                    </li>
                    <li><a href="DataGrid.html"><i class="fa fa-database fa-fw">
                        <div class="icon-bg bg-red"></div>
                    </i><span class="menu-title">Data Grids</span></a>
                      
                    </li>
                    <li><a href="Pages.html"><i class="fa fa-file-o fa-fw">
                        <div class="icon-bg bg-yellow"></div>
                    </i><span class="menu-title">Pages</span></a>
                       
                    </li>
                    <li><a href="Extras.html"><i class="fa fa-gift fa-fw">
                        <div class="icon-bg bg-grey"></div>
                    </i><span class="menu-title">Extras</span></a>
                      
                    </li>
                    <li><a href="Dropdown.html"><i class="fa fa-sitemap fa-fw">
                        <div class="icon-bg bg-dark"></div>
                    </i><span class="menu-title">Multi-Level Dropdown</span></a>
                      
                    </li>
                    <li><a href="Email.html"><i class="fa fa-envelope-o">
                        <div class="icon-bg bg-primary"></div>
                    </i><span class="menu-title">Email</span></a>
                      
                    </li>
                    <li><a href="Charts.html"><i class="fa fa-bar-chart-o fa-fw">
                        <div class="icon-bg bg-orange"></div>
                    </i><span class="menu-title">Charts</span></a>
                       
                    </li>
                    <li><a href="Animation.html"><i class="fa fa-slack fa-fw">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Animations</span></a></li>
                </ul>
            </div>
        </nav>
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            Cadastro de Clientes
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg" onclick="abre_iframe();">
                            Novo Cliente</button>
                       </div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="dashboard.html">Início</a>&nbsp;&nbsp;<i
                            class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Clientes</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Clientes</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div class="row mbl">
                            <div class="col-lg-12">
                                <div class="col-md-12">
                                    <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-green">
                            <div class="panel-heading">Clientes Cadastrados</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nome</th>
                                        <th>Enderço</th>
                                        <th>Telefone</th>
                                        <th>Celular</th>
                                        <th>E-Mail</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Henry</td>
                                        <td>teste 23</td>
                                        <td>2346546546</td>
                                        <td></td>
                                        <td>teste@teste.com</td>
                                        <td><span class="label label-sm label-success">Approved</span></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>John</td>
                                        <td>teste 23</td>
                                        <td>2346546546</td>
                                        <td></td>
                                        <td>teste@teste.com</td>
                                        <td><span class="label label-sm label-info">Pending</span></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Larry</td>
                                        <td>teste 23</td>
                                        <td>2346546546</td>
                                        <td></td>
                                        <td>teste@teste.com</td>
                                        <td><span class="label label-sm label-warning">Suspended</span></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Lahm</td>
                                        <td>teste 23</td>
                                        <td>2346546546</td>
                                        <td></td>
                                        <td>teste@teste.com</td>
                                        <td><span class="label label-sm label-danger">Blocked</span></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="panel panel-green">
                                            <div class="panel-heading">
                                                Novo Cliente</div>
                                            <div class="panel-body pan">
                                                <form action="#">
                                                <div class="form-body pal">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="inputName" class="control-label">
                                                                    Nome *</label>
                                                                <div class="input-icon right">
                                                                    <i class="fa fa-user"></i>
                                                                    <input id="inputName" type="text" placeholder="" class="form-control" required/></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="inputcnpj" class="control-label">
                                                                    CNPJ</label>
                                                                <div class="input-icon right">
                                                                    <i class="fa fa-user"></i>
                                                                    <input id="inputcnpj" type="number" placeholder="" class="form-control" /></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="inputcpf" class="control-label">
                                                                    CPF</label>
                                                                <div class="input-icon right">
                                                                    <i class="fa fa-user"></i>
                                                                    <input id="inputcpf" type="number" placeholder="" class="form-control" /></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="inputcep" class="control-label">
                                                                    CEP *</label>
                                                                <div class="input-icon right">
                                                                    <i class="fa fa-map-marker"></i>
                                                                    <input id="inputcep" type="number" placeholder="" class="form-control" required=""/></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label for="inputrua" class="control-label">
                                                                    Rua *</label>
                                                                <div class="input-icon right">
                                                                    <i class="fa fa-map-marker"></i>
                                                                    <input id="inputrua" type="text" placeholder="" class="form-control" required=""/></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="inputnro" class="control-label">
                                                                    Número *</label>
                                                                <div class="input-icon right">
                                                                    <i class="fa fa-map-marker"></i>
                                                                    <input id="inputnro" type="text" placeholder="" class="form-control" required=""/></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="inputcom" class="control-label">
                                                                    Complemento</label>
                                                                <div class="input-icon right">
                                                                    <i class="fa fa-map-marker"></i>
                                                                    <input id="inputcom" type="text" placeholder="" class="form-control"/></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="inputestado" class="control-label">
                                                                    Estado *</label>
                                                                <div class="input-icon right">
                                                                    <i class="fa fa-map-marker"></i>
                                                                    <input id="inputestado" type="texto" placeholder="" class="form-control" required=""/></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="inputcidade" class="control-label">
                                                                    Cidade *</label>
                                                                <div class="input-icon right">
                                                                    <i class="fa fa-map-marker"></i>
                                                                    <input id="inputcidade" type="texto" placeholder="" class="form-control" required=""/></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="inputfone1" class="control-label">
                                                                    Telefone *</label>
                                                                <div class="input-icon right">
                                                                    <i class="fa fa-phone-square"></i>
                                                                    <input id="inputfone1" type="number" placeholder="" class="form-control" required=""/></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="inputfone2" class="control-label">
                                                                    Telefone 2 / Fax </label>
                                                                <div class="input-icon right">
                                                                    <i class="fa fa-phone-square"></i>
                                                                    <input id="inputfone2" type="number" placeholder="" class="form-control"/></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="inputcel" class="control-label">
                                                                    Celular</label>
                                                                <div class="input-icon right">
                                                                    <i class="fa fa-mobile"></i>
                                                                    <input id="inputcel" type="number" placeholder="" class="form-control" /></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="inputEmail" class="control-label">
                                                                    E-mail</label>
                                                                <div class="input-icon right">
                                                                    <i class="fa fa-envelope"></i>
                                                                    <input id="inputEmail" type="text" placeholder="" class="form-control" /></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mbn">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input tabindex="5" type="checkbox" checked/>&nbsp; Ativo</label></div>
                                                    </div>
                                                </div>
                                                <div class="form-actions text-right pal">
                                                    <button type="button" class="btn btn-primary">
                                                        Cancelar</button>
                                                    <button type="button" class="btn btn-primary" onclick="cadastrar_cliente();">
                                                        Salvar</button>
                                                </div>
                                                </form>
                                            </div>
                                		</div>
                           			</div>
                        		</div>
                    		</div>
                </div>
                <!--END CONTENT-->
                <!--BEGIN FOOTER-->
                <div id="footer">
                    <div class="copyright">
                        <a href="http://themifycloud.com">2016 © Meu Gerente</a></div>
                </div>
                <!--END FOOTER-->
            </div>
            <!--END PAGE WRAPPER-->
        </div>
    </div>
    <script src="script/jquery-1.10.2.min.js"></script>
    <script src="script/jquery-migrate-1.2.1.min.js"></script>
    <script src="script/jquery-ui.js"></script>
    <script src="script/bootstrap.min.js"></script>
    <script src="script/bootstrap-hover-dropdown.js"></script>
    <script src="script/html5shiv.js"></script>
    <script src="script/respond.min.js"></script>
    <script src="script/jquery.metisMenu.js"></script>
    <script src="script/jquery.slimscroll.js"></script>
    <script src="script/jquery.cookie.js"></script>
    <script src="script/icheck.min.js"></script>
    <script src="script/custom.min.js"></script>
    <script src="script/jquery.news-ticker.js"></script>
    <script src="script/jquery.menu.js"></script>
    <script src="script/pace.min.js"></script>
    <script src="script/holder.js"></script>
    <script src="script/responsive-tabs.js"></script>
    <script src="script/jquery.flot.js"></script>
    <script src="script/jquery.flot.categories.js"></script>
    <script src="script/jquery.flot.pie.js"></script>
    <script src="script/jquery.flot.tooltip.js"></script>
    <script src="script/jquery.flot.resize.js"></script>
    <script src="script/jquery.flot.fillbetween.js"></script>
    <script src="script/jquery.flot.stack.js"></script>
    <script src="script/jquery.flot.spline.js"></script>
    <script src="script/zabuto_calendar.min.js"></script>
    <script src="script/index.js"></script>
    <!--LOADING SCRIPTS FOR CHARTS-->
    <script src="script/highcharts.js"></script>
    <script src="script/data.js"></script>
    <script src="script/drilldown.js"></script>
    <script src="script/exporting.js"></script>
    <script src="script/highcharts-more.js"></script>
    <script src="script/charts-highchart-pie.js"></script>
    <script src="script/charts-highchart-more.js"></script>
    <!--CORE JAVASCRIPT-->
    <script language="JavaScript" type="text/javascript" src="./js/jquery-1.2.6.min.js"></script>
	<script language="JavaScript" type="text/javascript" src="./js/jquery-ui-personalized-1.5.2.packed.js"></script>
	<script language="JavaScript" type="text/javascript" src="./js/sprinkle.js"></script>
	<script language="JavaScript" type="text/javascript" src="./js/glide.js"></script>
    <script src="script/main.js"></script>
    <script>        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-145464-12', 'auto');
        ga('send', 'pageview');


	</script>
	<script type="text/javascript">
		function abre_iframe(){
			$('	<div id="first-div" class="modal fade bs-example-modal-lg" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
					<div id="second-div" class="modal-dialog modal-lg">
						<div id="content-div" class="modal-content">
							<iframe src="login.php" width="100%"	 marginwidth="0" height="520" marginheight="0" scrolling="auto" id="cliente_iframe" name="cliente_iframe"></iframe>
							<div id="close-div" class="modal-footer">
								<button type="button" id="cad-btn" class="btn btn-primary" onclick="cad_cliente();">Salvar</button>
								<button type="button" id="close-btn" class="btn btn-default" onclick="return remove_iframe();">Fechar</button>
							</div>
						</div>
					</div>
				</div>').appendTo('.form-base');
			$('#cad-btn').hide();
		}
		
		function remove_iframe(){
			if(confirm("Deseja realmente fechar a janela?")){
				$('#cliente_iframe').remove();
				$('#cad-btn').remove();
				$('#close-btn').remove();
				$('#close-div').remove();
				$('#content-div').remove();
				$('#second-div').remove();
				$('#first-div').remove();
				$('#dynamictable').DataTable().ajax.reload(null,false).draw();
			}else{
				return;
			}
		}
		
		function cadastrar_cliente(){
			var cnpj = $('#inputcnpj').val();
			var cpf = $('#inputcpf').val();
			if(cnpj=='' && cpf ==''){
				alert("Preencha um CNPJ ou um CPF");
				return;
			}
			
			if(cnpj!='' && cpf !=''){
				alert("Preencha um CNPJ ou um CPF");
				return;
			}
			
			//dados a enviar, vai buscar os valores dos campos que queremos enviar para a BD
			var nome 		= $('#inputname').val();
			var cnpj		= $('#inputcnpj').val();
			var cpf 		= $('#inputcpf').val();
			var cep 		= $('#inputcep').val();
			var rua			= $('#inputrua').val();
			var nro 		= $('#inputnro').val();
			var complemento = $('#inputcomp').val();
			var estado 		= $('#inputestado').val();
			var cidade		= $('#inputcidade').val();
			var fone1 		= $('#inputfone1').val();
			var fone2 		= $('#inputfone2').val();
			var celular		= $('#inputcel').val();
			var email 		= $('#inputemail').val();
			var ativo		= $('#inputativo').val();
			
			var dadosajax = {
				'nome': nome,
				'cnpj': cnpj,
				'cpf': cpf,
				'cep': cep,
				'rua': rua,
				'nro': nro,
				'complemento': complemento,
				'estado': estado,
				'cidade' : cidade,
				'fone1': fone1,
				'fone2': fone2,
				'celular': celular,
				'email': email,
				'ativo': ativo
			};
			pageurl = './ajax/cadastra_cliente.php';
			//para consultar mais opcoes possiveis numa chamada ajax
			//http://api.jquery.com/jQuery.ajax/
			$.ajax({
				//url da pagina
				url: pageurl,
				//parametros a passar
				data: dadosajax,
				//tipo: POST ou GET
				type: 'POST',
				//cache
				cache: false,
				//se ocorrer um erro na chamada ajax, retorna este alerta
				//possiveis erros: pagina nao existe, erro de codigo na pagina, falha de comunicacao/internet, etc etc etc
				error: function(){
					alert("Erro na chamada AJAX");
				},
				//retorna o resultado da pagina para onde enviamos os dados
				success: function(result)
				{
					if(result=='1'){
						alert('Cliente adicionado com sucesso');
						$('#inputname').val('');
						$('#inputcnpj').val('');
						$('#inputcpf').val('');
						$('#inputcep').val('');
						$('#inputrua').val('');
						$('#inputnro').val('');
						$('#inputcomp').val('');
						$('#inputestado').val('')
						$('#inputcidade').val('')
						$('#inputfone1').val('');
						$('#inputfone2').val('');
						$('#inputcel').val('');
						$('#inputemail').val('');
						$('#inputativo').val('');
						
						open("clientes.php","_self");
					//$('#dynamictable').DataTable().ajax.reload(null,false).draw();
						
					} else if(result=='0'){
						alert('Erro ao adicionar Cliente');
					}
				}
			});
		}
	</script>
</body>
</html>
