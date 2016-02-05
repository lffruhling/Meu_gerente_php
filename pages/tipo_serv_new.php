<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tipo de Serviço</title>
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
</head>
<body>
	<div class="page-content">
    	<div id="tab-general">
        	<div class="row mbl">
            	<div class="col-lg-12">
                	<div class="row">
                    	<div class="col-lg-12">
                        	<div class="panel panel-green">
                            	<div class="panel-heading">Novo Tipo de Serviço</div>
                                <div class="panel-body pan">
                                	<form action="#">
                                    	<div class="form-body pal">
                                        	<div class="row">
                                            	<div class="col-md-12">
                                                	<div class="form-group">
                                                    	<label for="inputname" class="control-label">Tipo de Serviço *</label>
                                                        <div class="input-icon right">
                                                        	<i class="fa fa-user"></i>
                                                            <input id="inputname" type="text" placeholder="" class="form-control" required=""/>
                                                        </div>
                                                    </div>
                                                </div>
											</div>
                                        	<div class="form-group mbn">
                                                <div class="checkbox">
                                                    <label>
                                                        <input id="inputativo" tabindex="5" type="checkbox" checked/>&nbsp; Ativo
                                                    </label>
                                                </div>
                                            </div>
										</div>
                                        <div class="form-actions text-right pal">
                                            <button type="button" class="btn btn-primary">
                                                Cancelar</button>
                                            <button type="button" class="btn btn-primary" onclick="cadastrar_tipo_serv();">
                                                Salvar</button>
                                        </div>
									</form>
                                </div>
                    		</div>
               			</div>
            		</div>
        		</div>
            </div>
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
		function cadastrar_tipo_serv(){
			var nome 		= $('#inputname').val();
			if(nome==''){
				alert("Preencha o campo Tipo de Serviço");
				return;
			}
			if ( $('#inputativo').is(":checked")){
				var ativo		= '1';	
			}else{
				var ativo		= '0';	
			}
			
			var dadosajax = {
				'nome': nome,
				'ativo': ativo
			};
			pageurl = './ajax/cadastra_tipo_serv.php';
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
						alert('Tipo de Serviço adicionado com sucesso');
						$('#inputname').val('');
						$('#inputativo').val('');
						
						open("tipo_serv_new.php","_self");
					//$('#dynamictable').DataTable().ajax.reload(null,false).draw();
						
					} else if(result=='0'){
						alert('Erro ao adicionar Tipo de Serviço');
					}
				}
			});
		}
	</script>
</body>
</html>
