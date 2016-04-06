<?php
include "classes/mysql.php";
//include "../utils/utils.php";

$db = new MySQL();

// session_start inicia a sessão session_start();
// as variáveis login e senha recebem os dados digitados na página anterior
$id = 2;


if($db->conecta()){
	
	$valor = $db-> _e_nome_cli($id);
		echo "$valor\n";
	
}


$db->desconecta();
?>