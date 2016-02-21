<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ordens de Serviços</title>
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
<?php
include "utils/utils.php";
include "classes/mysql.php";

$db = new MySQL();
$db->conecta() or die("Erro de conexão ao banco");

$cliente = $db->_n_cliente_os();
$tipo_serviço = $db->_n_tipo_serv_os();
$tecnico = $db->_n_tecnico_os();
$grupo_prod = $db->_n_grupo_produto_os();

?>
<div class="page-content">
    <div id="tab-general">
        <div class="row mbl">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-green">
                            <div class="panel-heading">Nova Ordem de Serviço</div>
                            <div class="panel-body pan">
                                <form action="#">
                                    <div class="form-body pal">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">Cliente *
                                                    <br>
                                                    <select class="form-control" id="inputcli" >
                                                        <?php
                                                        foreach($cliente as $key => $value){
                                                            echo "<option value='$key'>$value</option>\n";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">Tipo de Serviço *
                                                    <br>
                                                    <select class="form-control" id="input_tp_serv" >
                                                        <?php
                                                        foreach($tipo_serviço as $key => $value){
                                                            echo "<option value='$key'>$value</option>\n";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">Técnico *
                                                    <br>
                                                    <select class="form-control" id="inputtec" >
                                                        <?php
                                                        foreach($tecnico as $key => $value){
                                                            echo "<option value='$key'>$value</option>\n";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="inputobs" class="control-label">Observações *</label>
                                                    <div class="input-icon right">
                                                        <i class="fa fa-user"></i>
                                                        <textarea id="inputobs" type="text" placeholder="" class="form-control" required=""></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mbn">
                                            <div class="checkbox">
                                                <label>
                                                    <input id="inputorcamento" tabindex="5" type="checkbox" checked/>&nbsp; Orçar Ordem de Serviço
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group mbn">
                                            <div class="checkbox">
                                                <label>
                                                    <input id="inputfoto" tabindex="5" type="checkbox" checked/>&nbsp; Fotografar Peças
                                                </label>
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
                                        <button type="button" class="btn btn-primary" onclick="cadastrar_os();">
                                            Salvar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="panel-heading">Adicionar Produto</div>
                            <div class="panel-body pan">
                                <form action="#">
                                    <div class="form-body pal">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">Grupo de Produtos *
                                                    <br>
                                                    <select class="form-control" id="input_grupo_prod" onchange="sel_produto()">
                                                        <?php
                                                        foreach($grupo_prod as $key => $value){
                                                            echo "<option value='$key'>$value</option>\n";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">Produto *
                                                    <br>
                                                    <select class="form-control" id="inputproduto">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="inputquant" class="control-label">Quantidade *</label>
                                                    <input id="inputquant" type="number" placeholder="" class="form-control" required=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="form-actions text-right pal">
                                    <button type="button" class="btn btn-primary" onclick="cadastrar_os();">Adiconar</button>
                                </div>
                            </div>
                        </div>
                        <form>
                            <div class="panel panel-green">
                                <div class="panel-heading">Produtos Utilizados</div>
                                <div class="panel-body">
                                    <table id="dynamictable" class="table table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Produto</th>
                                            <th>Quantidade</th>
                                            <th>Valor</th>
                                            <th>Ação</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </form>
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
    function cadastrar_os(){
        var id_cli 		= $('#inputcli').val();
        var id_tp_serv	= $('#input_tp_serv').val();
        var id_tec      = $('#inputtec').val();
        var obs		    = $('#inputobs').val();

        if ( $('#inputorcamento').is(":checked")){
            var orcamento = '1';
        }else{
            var orcamento = '0';
        }
        if ( $('#inputfoto').is(":checked")){
            var foto = '1';
        }else{
            var foto = '0';
        }

        if ( $('#inputativo').is(":checked")){
            var ativo = '1';
        }else{
            var ativo = '0';
        }

        var dadosajax = {
            'id_cli': id_cli,
            'id_tp_serv': id_tp_serv,
            'id_tec': id_tec,
            'obs': obs,
            'foto': foto,
            'orcamento': orcamento,
            'ativo': ativo
        };
        pageurl = './ajax/cadastra_os.php';
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
                if(result==1){
                    alert('Ordem de Serviço adicionada com sucesso');

                    //$('#inputperfil').val(0);
                    $('#inputativo').val('');

                    open("os_new.php","_self");
                    //$('#dynamictable').DataTable().ajax.reload(null,false).draw();

                } else if(result==0){
                    alert('Erro ao adicionar Ordem de Serviço');
                }
            }
        });
    }

    function sel_produto(){
        //dados a enviar, vai buscar os valores dos campos que queremos enviar para a BD
        var id_grupo_prod = $('#input_grupo_prod').val();
        var dadosajax = {
            'id_grupo_prod' : id_grupo_prod,
        };
        $('#inputproduto').attr('disabled', 'disabled');
        pageurl = './ajax/sel_produto.php';
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
            // tipo de dados
            dataType: 'json',
            //se ocorrer um erro na chamada ajax, retorna este alerta
            //possiveis erros: pagina nao existe, erro de codigo na pagina, falha de comunicacao/internet, etc etc etc
            error: function(){
                alert("Erro na chamada AJAX");
            },
            //retorna o resultado da pagina para onde enviamos os dados
            success: function(json)
            {
                var options = "";
                $.each(json,function(key,value){
                    options += '<option value="'+key+'">'+value+'</option>';
                });
                $('#inputproduto').html(options);
                $('#inputproduto').removeAttr('disabled');
            }
        });
    }
</script>
</body>
</html>
