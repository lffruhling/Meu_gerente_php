<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>DMP - Novatec </title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        
          <link rel="shortcut icon" href="../assets/images/Logo_DMP_Brasil.ico">

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="../assets/css/bootstrap.css" />
		<link rel="stylesheet" href="../assets/css/font-awesome.css" />

		<!-- page specific plugin styles -->
         <link rel="stylesheet" href="../assets/css/jquery.gritter.css" />
		<!-- text fonts -->
		<link rel="stylesheet" href="../assets/css/ace-fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="../assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="../assets/css/ace-part2.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="../assets/js/ace-extra.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="../assets/js/html5shiv.js"></script>
		<script src="../assets/js/respond.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin" onload="carrega_evento();">

		<?php
		include "utils/menu.php";
		include "utils/utils.php";
		
		session_test();
		?>
		
		<!-- #section:basics/navbar.layout -->
		<?php navbar(); ?>
		
		<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<!-- #section:basics/sidebar -->
			<?php sidebar(); ?>

			<!-- /section:basics/sidebar -->
			<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>
                        
                        <ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-user home-icon"></i>
								<a href="#">Clientes</a>
							</li>

							 
							 
						</ul>

						<!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
                    <div class="page-header">
							<h1>
						<p>	Clientes -  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg" onclick="abre_iframe();">Novo Cliente</button></p></h1>
                        </div>
                        
                        <!-- Large modal -->
						<form class="form-base" id="form-base">
						</form>  
  

                    
						 <div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

						 
						
								<!-- PAGE CONTENT BEGINS -->

                                   <div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										

										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
										<div class="table-header">
											Listagem de Clientes Cadastrados
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamictable" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>Matriz</th>
														<th>Filial</th>
														<th>CNPJ</th>
														<th>Telefone 1</th>
														<th>Fax/Telefone 2</th>
														<th>E-mail</th>
														<th>Ação</th>
													</tr>
												</thead>

											</table>
										</div>
									</div>
								</div>




								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<!-- #section:basics/footer -->
					<div class="footer-content">
						<span class="bigger-120">
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

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='../assets/js/jquery.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='../assets/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script src="../assets/js/bootstrap.js"></script>

		<!-- page specific plugin scripts -->
         <script src="../assets/js/jquery.gritter.js"></script>
        <!-- page specific plugin scripts -->
		<script src="../assets/js/dataTables/jquery.dataTables.js"></script>
		<script src="../assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
		<script src="../assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
		<script src="../assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>

		<!-- ace scripts -->
		<script src="../assets/js/ace/elements.scroller.js"></script>
		<script src="../assets/js/ace/elements.colorpicker.js"></script>
		<script src="../assets/js/ace/elements.fileinput.js"></script>
		<script src="../assets/js/ace/elements.typeahead.js"></script>
		<script src="../assets/js/ace/elements.wysiwyg.js"></script>
		<script src="../assets/js/ace/elements.spinner.js"></script>
		<script src="../assets/js/ace/elements.treeview.js"></script>
		<script src="../assets/js/ace/elements.wizard.js"></script>
		<script src="../assets/js/ace/elements.aside.js"></script>
		<script src="../assets/js/ace/ace.js"></script>
		<script src="../assets/js/ace/ace.ajax-content.js"></script>
		<script src="../assets/js/ace/ace.touch-drag.js"></script>
		<script src="../assets/js/ace/ace.sidebar.js"></script>
		<script src="../assets/js/ace/ace.sidebar-scroll-1.js"></script>
		<script src="../assets/js/ace/ace.submenu-hover.js"></script>
		<script src="../assets/js/ace/ace.widget-box.js"></script>
		<script src="../assets/js/ace/ace.settings.js"></script>
		<script src="../assets/js/ace/ace.settings-rtl.js"></script>
		<script src="../assets/js/ace/ace.settings-skin.js"></script>
		<script src="../assets/js/ace/ace.widget-on-reload.js"></script>
		<script src="../assets/js/ace/ace.searchbox-autocomplete.js"></script>

		<!-- inline scripts related to this page -->
        
        <!-- inline scripts related to this page -->
		<script type="text/javascript">
		var tempo = window.setInterval(carrega_evento, 5000);
		function carrega_evento()
		{
			$('#papel').load("ajax/load_a.php").fadeIn("slow");
			$('#sino').load("ajax/load_b.php").fadeIn("slow");
			$('#carta').load("ajax/load_c.php").fadeIn("slow");
		}

		function abre_iframe(){
			$('<div id="first-div" class="modal fade bs-example-modal-lg" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"><div id="second-div" class="modal-dialog modal-lg"><div id="content-div" class="modal-content"><iframe src="cnpj_clientes.php" width="100%"	 marginwidth="0" height="520" marginheight="0" scrolling="auto" id="cliente_iframe" name="cliente_iframe"></iframe><div id="close-div" class="modal-footer"><button type="button" id="cad-btn" class="btn btn-primary" onclick="cad_cliente();">Salvar</button><button type="button" id="close-btn" class="btn btn-default" onclick="return remove_iframe();">Fechar</button></div></div></div></div>').appendTo('.form-base');
			$('#cad-btn').hide();
		}

		function abre_iframe_custom(url){
			$('<div id="first-div" class="modal fade bs-example-modal-lg" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"><div id="second-div" class="modal-dialog modal-lg"><div id="content-div" class="modal-content"><iframe src="'+url+'" width="100%" marginwidth="0" height="520" marginheight="0" scrolling="auto" id="cliente_iframe" name="cliente_iframe"></iframe><div id="close-div" class="modal-footer"><button type="button" id="cad-btn" class="btn btn-primary" onclick="remove_iframe_edit();">Salvar</button><button type="button" id="close-btn" class="btn btn-default" onclick="return remove_iframe();">Fechar</button></div></div></div></div>').appendTo('.form-base');
			$('.bs-example-modal-lg').modal('show');
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
		
		function remove_iframe_edit(){
		   if (window.cliente_iframe.cadastrar_cliente() != 0){
			    alert("Cliente Editado com Sucesso");
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

		function cad_cliente(){
			window.cliente_iframe.cadastrar_cliente();
		}
		//
		// Resposta da tabela
		//
		function abre_frame_visualizar(id){
			var src = "form_cliente_visu.php?id="+id;
			//open(src,"_blank","width=700 height=520 menubar=no status=no toolbar=no location=no titlebar=no");
			abre_iframe_custom(src);
			$('#cad-btn').hide();
		}
		
		function abre_frame_editar(id){
			var src = "form_cliente_edit.php?id="+id;
			//open(src,"_blank","width=700 height=520 menubar=no status=no toolbar=no location=no titlebar=no");
			
			abre_iframe_custom(src);
		}
		
		function apagar(id){
			if(!confirm("Deseja realmente apagar o cliente?")){
				return;
			}
			//dados a enviar, vai buscar os valores dos campos que queremos enviar para a BD
			var dadosajax = {
				'id' : id
			};
			pageurl = 'ajax/apaga_cliente.php';
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
						alert("Cliente "+id+" apagado com sucesso");
						open("clientes.php","_self");
					}else{
						alert("Erro ao apagar clente "+id);
					}
				}
			});
		}

		</script>
        <script type="text/javascript">
		//
		// Tabela
		//
		$(document).ready(function() {
			$('#dynamictable').dataTable( {
				"processing": true,
				"serverSide": true,
				"ajax": {
					"url": "table/clientes_table.php",
					"type": "POST"
				},
				"language": {
					"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
				}
			});
		});
		</script> 

		<!-- the following scripts are used in demo only for onpage help and you don't need them -->
		<link rel="stylesheet" href="../assets/css/ace.onpage-help.css" />
		<link rel="stylesheet" href="../docs/assets/js/themes/sunburst.css" />

		<script type="text/javascript"> ace.vars['base'] = '..'; </script>
		<script src="../assets/js/ace/elements.onpage-help.js"></script>
		<script src="../assets/js/ace/ace.onpage-help.js"></script>
		<script src="../docs/assets/js/rainbow.js"></script>
		<script src="../docs/assets/js/language/generic.js"></script>
		<script src="../docs/assets/js/language/html.js"></script>
		<script src="../docs/assets/js/language/css.js"></script>
		<script src="../docs/assets/js/language/javascript.js"></script>
	</body>
</html>
