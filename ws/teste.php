<?php
# Definindo pacotes de retorno em padrão JSON...
header('Content-Type: application/json;charset=utf-8');
 
# Carregando o framework Slim...
require 'Slim\Slim.php';
\Slim\Slim::registerAutoloader();
 
# Iniciando o objeto de manipulação da API SlimFramework
$app = new \Slim\Slim();
$app->response()->header('Content-Type', 'application/json;charset=utf-8');

function authenticate(){

  $app = \Slim\Slim::getInstance();
  $user = $app->request->headers->get('HTTP_USER');
  $pass = $app->request->headers->get('HTTP_PASS');  //recebo a senha jᠦormatada em md5

	    $erro = 0;
	
		try{
		   
		   if(($user != "MG") or ($pass != 'MG')){
		     //se retornar e99 houve falha ao autenticar
		     echo json_encode('e99');		
		     $erro = 1; 
		   } 
		}catch(Exception $e){
		   //se retornar e100 houve algum erro
		   echo json_encode('e100');		
		   $erro = 1;		
		}
		
		if($erro == 1)
		  $app->stop();
}
 
# Função de teste de funcionamento da API...
$app->get('/', function () {
    echo "Bem-vindo a API do Sistema de Clientes";
});
 
# Função para obter dados da tabela 'cliente'...
//$app->get('/clientes','authenticate',function(){

$app->get('/clientes',function(){ 
    # Variável que irá ser o retorno (pacote JSON)...
    $retorno = array();
 
    # Abrir conexão com banco de dados...
    $conexao = new MySQLi("localhost","root","","mg");
 
    # Validar se houve conexão...
    if(!$conexao){ echo "Não foi possível se conectar ao banco de dados"; exit;}
 
    # Selecionar todos os cadastros da tabela 'cliente'...
    $registros = $conexao->query("SELECT * FROM tb_cliente");
 
    # Transformando resultset em array, caso ache registros...
    if($registros->num_rows>0){
        while($cliente = $registros->fetch_array(MYSQL_BOTH)) {
                $registro = array(
                        'id'   => $cliente["ID_CLI"],
                        'nome'     => utf8_encode($cliente["NOME_CLI"]),
                        'fone' => $cliente["FONE1_CLI"],
                        'email'    => $cliente["EMAIL_CLI"],
                    );
            $retorno[] = $registro;
        }
         
	    # Encerrar conexão...
	    $conexao->close();
	 
	    # Retornando o pacote (JSON)...
	    //$retorno = json_encode(array('clientes'=>$retorno));
	    $retorno = json_encode($retorno);
	    echo $retorno;
 
	}
});
 
# Executar a API (deixá-la acessível)...
$app->run();
?>