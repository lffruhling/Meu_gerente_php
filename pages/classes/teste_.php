<?php
include "mysql.php";

$db = new MySQL();

$codigo_os = 2;

// Conecta ao banco
if($db->conecta()){
	// Valida usuário e senha
	$valor = $db->_e_perfil_colab($codigo_os);
		foreach ($valor as $value) {
    	echo "$value\n";
		}
}

$db->desconecta();
unset($db);

?>