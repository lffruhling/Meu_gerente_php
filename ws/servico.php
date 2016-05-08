<?php

require '../Slim/Slim/Slim.php';
require '../phpmailer/PHPMailerAutoload.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app->response()->header('Content-Type', 'text/html;charset=utf-8');

function authenticate(){

  $app = \Slim\Slim::getInstance();
  $user = $app->request->headers->get('HTTP_USER');
  $pass = $app->request->headers->get('HTTP_PASS');  //recebo a senha jᠦormatada em md5

	    $erro = 0;
	
		try{
		   
		   if(($user != "Btime") or ($pass != md5('BtimeAcesso15'))){
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

function CorrigeJson($valor){
	$inicio = "[{";
	$fim = "}]";
	$result = str_replace($inicio, "{", $valor);
	$result2 = str_replace($fim, "}", $result);
	return $result2;
}

$app->get('/', function() use($app){
echo "<html><CENTER>GEST&Atilde;O DE SERVI&Ccedil;OS</CENTER></html>";
});


$app->get('/usuario', 'authenticate', function() use($app){

	$request = \Slim\Slim::getInstance()->request();
	$requisicao = json_decode($request->getBody());
	$email = $_GET{'email'};
	$senha = $_GET{'senha'};
	
	$stmt = getConn()->query("SELECT USUARIO_LOGIN usuario,EMAIL_LOGIN email, CONCAT(COALESCE(EMPRESA.NOMERAZAOSOC_CAD,''),' ',COALESCE(EMPRESA.SOBRENOME_CAD,'')) empresa, ID_TEC.ID_CAD id, CASE WHEN PRIMEIRO_LOGIN IS NULL THEN 'True' ELSE 'False' END first_access FROM BT_SRV_LOGIN LOGIN LEFT JOIN BT_ANA_CADASTRO ID_TEC ON LOGIN.ID_CAD = ID_TEC.ID_CAD LEFT JOIN BT_ANA_CADASTRO EMPRESA ON  EMPRESA.ID_CAD= ID_TEC.EMPTEC_CAD WHERE  EMAIL_LOGIN='$email' AND SENHA_LOGIN = MD5('$senha')");

	$usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
		
	$retorno = $stmt->fetch(PDO::FETCH_LAZY); 
	$linhas = count($retorno);
	$id_log = $retorno[0];
	
	$db = getConn();
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql="SELECT ID_LOGIN, CASE WHEN PRIMEIRO_LOGIN IS NULL THEN 'true' WHEN PRIMEIRO_LOGIN = 1 THEN 'true' ELSE 'false' END first_access FROM BT_SRV_LOGIN WHERE  EMAIL_LOGIN='$email' AND SENHA_LOGIN = MD5('$senha')";
	$result = $db->query($sql);
	$linhas = $result->rowCount();
	if ($linhas > 0){
		foreach ($result as $objeto){
			$id_log = $objeto[0];
			$acesso = $objeto[1];
			$sql_up ="";
			if ($acesso == "true"){
				$sql_up = "UPDATE BT_SRV_LOGIN SET PRIMEIRO_LOGIN='False' WHERE ID_LOGIN=$id_log";
				$db->query($sql_up);
			}
		}
	}		
	echo CorrigeJson(json_encode($usuarios));
});


$app->get('/checklist', 'authenticate', function() use($app){

	$request = \Slim\Slim::getInstance()->request();
	$requisicao = json_decode($request->getBody());
	$idOs = $_GET{'idOs'};
	$idCheck = $_GET{'idCheck'};
	
		$stmt = getConn()->query("SELECT CLK.ID_TCCHECK tipo_campo, CLK.DESC_CKL pergunta FROM BT_SRV_CHECKLIST CLK INNER JOIN BT_ANA_OS OS ON OS.ID_EQPTO = CLK.ID_EQPTO WHERE CLK.ID_TCL = $idCheck AND OS.ID_OS = $idOs AND (CLK.ID_SITG != 2 OR CLK.ID_SITG IS NULL) ORDER BY 2");
                /* " SELECT CL.ID_CKL,								   ".
								 " CL.ID_TCL,										   ".
								 " ICL.ID_ICL,										   ".
								 " ICL.DESC_ICL,									   ".
								 " ICL.TPOITEN_ICL, 								   ".
								 " CL.DATAHORAULTATUALIZA							   ".	
								 " FROM BT_SRV_CHECKLIST CL							   ".
								 " INNER JOIN BT_SRV_ITENSCHECK ICL					   ".
								 " ON ICL.ID_CKL= CL.ID_CKL							   ".
								 " INNER JOIN BT_SRV_TPOCHECK TCL					   ".
								 " ON TCL.ID_TCL = CL.ID_TCL						   ".
								 " WHERE CL.ID_TCL = $iTipoCheck					   ".
								 " AND CL.DATAHORAULTATUALIZA > '$datahoraUltAtualiza' ");*/ 
	$usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);	

	echo json_encode($usuarios);
});

$app->get('/fotos', 'authenticate', function() use($app){

	$request = \Slim\Slim::getInstance()->request();
	$requisicao = json_decode($request->getBody());
	$idOs = $_GET{'idOs'};
	
		$stmt = getConn()->query("SELECT FOTO.LOCAL_FPROJ local,  FOTO.QUANTIDADE_FPROJ quantidade FROM BT_ANA_PROJETO PRJT LEFT JOIN BT_ANA_OS OS ON OS.ID_PROJETO = PRJT.ID_PRJTO LEFT JOIN BT_SRV_FOTOSPROJETOS FOTO ON FOTO.ID_PRJTO = PRJT.ID_PRJTO WHERE OS.ID_OS = $idOs");
	
	$usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);	

	echo json_encode($usuarios);
});

$app->get('/listaos', 'authenticate', function() use($app){

	$request = \Slim\Slim::getInstance()->request();
	$requisicao = json_decode($request->getBody());
	//$ultOSRecebida = $requisicao->{'ultOS'};
	$idTecnicoLogado =$_GET['idTecnico'];
	$id_status =$_GET['idStatus'];
	
	$stmt = getConn()->query("SELECT OS.ID_OS, E.ID_CAD, OS.ID_SITOS, OS.DATAABER_OS, OS.DATAAGENDADA_OS, OS.OBS_PS, COALESCE(OS.ID_EMPRESA, 0) AS ID_EMPRESA, CONCAT(COALESCE(E.NOMERAZAOSOC_CAD,''),' ', COALESCE (E.SOBRENOME_CAD,'')) NOMERAZAOSOC_CAD, CONCAT(COALESCE(FILIAL.NOMERAZAOSOC_CAD,''),' ', COALESCE (FILIAL.SOBRENOME_CAD,'')) FILIAL, CAT.DESC_CATEGOS, PROJ.DESC_PRJTO, CASE WHEN OS.ID_EMPRESA > 0 THEN LOCFILIAL.LATITUDE_POSGPS ELSE LOCCAD.LATITUDE_POSGPS END latitude, CASE WHEN OS.ID_EMPRESA > 0 THEN LOCFILIAL.LONGITUDE_POSGPS ELSE LOCCAD.LONGITUDE_POSGPS END longitude,  LOCFILIAL.LATITUDE_POSGPS AS LATFILIAL, LOCFILIAL.LONGITUDE_POSGPS AS LONGFILIAL, CASE WHEN OS.ID_EMPRESA > 0 THEN ENDFILIAL.DESCRUA_ENDCAD ELSE END.DESCRUA_ENDCAD END DESCRUA_ENDCAD, CASE WHEN OS.ID_EMPRESA > 0 THEN ENDFILIAL.NRO_ENDCAD ELSE END.NRO_ENDCAD END NRO_ENDCAD, CASE WHEN OS.ID_EMPRESA > 0 THEN ENDFILIAL.DESCBAIRRO_ENDCAD ELSE END.DESCBAIRRO_ENDCAD END DESCBAIRRO_ENDCAD, CASE WHEN OS.ID_EMPRESA > 0 THEN ENDFILIAL.COMP_ENDCAD ELSE END.COMP_ENDCAD END COMP_ENDCAD, CASE WHEN OS.ID_EMPRESA > 0 THEN ENDFILIAL.PAIS_ENDCAD ELSE END.PAIS_ENDCAD END PAIS_ENDCAD, CASE WHEN OS.ID_EMPRESA > 0 THEN ESTADOFIL.SIGLA_ESTADOS ELSE ESTADO.SIGLA_ESTADOS END SIGLA_ESTADOS, CASE WHEN OS.ID_EMPRESA > 0 THEN ESTADOFIL.DESC_ESTADOS ELSE ESTADO.DESC_ESTADOS END DESC_ESTADOS, CASE WHEN OS.ID_EMPRESA > 0 THEN CIDFIL.DESC_CID ELSE CID.DESC_CID END DESC_CID, CASE WHEN OS.ID_EMPRESA > 0 THEN CIDFIL.CEP_CID ELSE CID.CEP_CID END CEP_CID, CASE WHEN OS.ID_EMPRESA > 0 THEN CFIL.DESC_CONTATO ELSE C.DESC_CONTATO END TELFIXO, PROJ.ID_CKL, PROJ.ID_CKL_DEFEITO, CASE WHEN STS.ID_SITOS = 1 OR STS.ID_SITOS = 2 THEN 'ABERTO' WHEN STS.ID_SITOS = 3 THEN 'EXECUÇÃO' WHEN STS.ID_SITOS = 7 THEN 'CONCLUÍDO' WHEN STS.ID_SITOS = 12 THEN 'PAUSA' END DESC_SIT, CASE WHEN OS.ID_EMPRESA > 0 THEN CONCAT('http://191.252.3.112',LOGOFILIAL.DESC_IMGCAD) ELSE CONCAT('http://191.252.3.112',LOGO.DESC_IMGCAD) END caminho, DATAHORAINI_OS hora_inicio, DATAHORAFIN_OS hora_fim FROM BT_ANA_OS OS LEFT JOIN BT_SRV_SITUACAOOS STS ON STS.ID_SITOS = OS.ID_SITOS INNER JOIN BT_ANA_CADASTRO E ON E.ID_CAD = OS.ID_CADEMP LEFT JOIN BT_ANA_CADASTRO FILIAL ON FILIAL.ID_CAD = OS.ID_EMPRESA LEFT JOIN BT_SRV_LOCALIZACAOCAD LOCCAD ON LOCCAD.ID_CAD = E.ID_CAD LEFT JOIN BT_SRV_LOCALIZACAOCAD LOCFILIAL ON LOCFILIAL.ID_CAD = OS.ID_EMPRESA LEFT JOIN BT_SRV_ENDCAD END ON END.ID_CAD = E.ID_CAD LEFT JOIN BT_SRV_ENDCAD ENDFILIAL ON ENDFILIAL.ID_CAD = OS.ID_EMPRESA LEFT JOIN BT_PLT_ESTADOS ESTADO ON ESTADO.ID_ESTADOS = END.ID_ESTADOS LEFT JOIN BT_PLT_ESTADOS ESTADOFIL ON ESTADOFIL.ID_ESTADOS = ENDFILIAL.ID_ESTADOS LEFT JOIN BT_PLT_CIDADES CID ON CID.ID_CID = END.ID_CID LEFT JOIN BT_PLT_CIDADES CIDFIL ON CIDFIL.ID_CID = ENDFILIAL.ID_CID INNER JOIN BT_SRV_CATEGORIAOS CAT ON CAT.ID_CATEGOS = OS.ID_CATEGOS INNER JOIN BT_ANA_PROJETO PROJ ON PROJ.ID_PRJTO = OS.ID_PROJETO LEFT JOIN BT_SRV_CONTATO C ON C.ID_CAD = E.ID_CAD AND C.ID_TPOCONTATO = 1 LEFT JOIN BT_SRV_CONTATO CFIL ON C.ID_CAD = OS.ID_EMPRESA AND C.ID_TPOCONTATO = 1 LEFT JOIN BT_SRV_IMGCAD LOGO ON LOGO.ID_CAD = E.ID_CAD LEFT JOIN BT_SRV_IMGCAD LOGOFILIAL ON LOGOFILIAL.ID_CAD = OS.ID_EMPRESA WHERE OS.ID_SITOS = $id_status AND OS.ID_CADTEC = $idTecnicoLogado AND (OS.ID_SITG!=2 OR OS.ID_SITG IS NULL)");
         					 
	$listaos = $stmt->fetchAll(PDO::FETCH_OBJ);	
	echo json_encode($listaos);
});


$app->get('/retornaconexao', 'authenticate', function() use($app){
	echo true;
});


/*procedimento de recupera磯 de senha...
o ws recebe a solicita磯..processa, grava na base a solic. e retorna email c os dados se existir cadastro*/
$app->post('/reqrecupsenha', 'authenticate', function() use($app){

	
		$request = \Slim\Slim::getInstance()->request();
		$requisicao = json_decode($request->getBody());
	
		$db = getConn();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		$stmt = $db->prepare('SELECT ID_CAD, SENHA_LOGIN FROM BT_SRV_LOGIN WHERE EMAIL_LOGIN = :EMAIL_LOGIN');
		$stmt->bindParam(':EMAIL_LOGIN', $requisicao->{'email'});
		$stmt->execute();
		
		$emailReq = $requisicao->{'email'};
		  
		 //serve para quando tem varios dados... 
		//$retorno = $stmt->fetchAll(PDO::FETCH_OBJ);  
		//$linhas = count($retorno);
		
		//while($r = $q->fetch(PDO::FETCH_LAZY)){ }
		
		$retorno = $stmt->fetch(PDO::FETCH_LAZY); 
		$linhas = count($retorno);
		$iIdCad = $retorno['ID_CAD'];
		$sSenha = $retorno['SENHA_LOGIN'];

		//se encontrar o email de recupera磯
		if ($iIdCad > 0){

			try {
						
				$sql = " INSERT INTO BT_SRV_RECUPERARSENHA (ID_LOGIN, EMAIL_LOGIN, DATAHORA_RECSENHA) ".
					   " VALUES ($iIdCad, '$emailReq', now())				   		 				  ";

				$db->query($sql);
				
			} catch (Exception $e) {
				$sRetorno = $e->getMessage();
			}

		   $msgEmail = 'Sua senha recuperada: XXXXXXXXXXXX';
		   enviarEmailRecSenha($emailReq, $msgEmail);
		   echo $iIdCad;
		}  
		else {
		  $msgEmail = 'Este e-mail informado para recupera磯 n㯠consta em nossos registros de dados. Informe um e-mail de t飮ico cadastrado.';
		  enviarEmailRecSenha($emailReq, $msgEmail);
		  echo "incorreto";
		  }
		  
	unset($db);	  
	$db = null;
});


/*recebe os dados da(s) checklist(s) do dispositivo...
e grava na base de dados...*/

$app->post('/checklist', 'authenticate', function() use($app){
		
		$request = \Slim\Slim::getInstance()->request();
		$requisicao = json_decode($request->getBody());
		
		$db = getConn();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$status = "naogravou";
				
		$OS = $requisicao[0]->{'ID_OS'};
		$TIPO = $requisicao[0]->{'ID_TCL'};
		
		$sql="SELECT * FROM BT_SRV_CHECKLISTOS WHERE ID_OS = $OS AND ID_TCL = $TIPO";
		$result = $db->query($sql);
		$Registros = $result->rowCount();
		
		if ($Registros == 0){
		
			try {
			
				$db->beginTransaction();
			
				foreach ($requisicao as $objeto){
					$ID_OS = $objeto->{'ID_OS'};
					$ID_TCL = $objeto->{'ID_TCL'};
					$ID_CKL = $objeto->{'ID_CKL'};
					$DESC_ICL = $objeto->{'DESC_ICL'};
					$TPOITEN_ICL = $objeto->{'TPOITEN_ICL'};
					$VALINFORMADO = $objeto->{'VALINFORMADO'};
					
					$db->exec(" INSERT INTO BT_SRV_CHECKLISTOS (ID_OS, ID_TCL, ID_CKL, DESC_ICL, TPOITEN_ICL, VALINFORMADO) VALUES ($ID_OS, $ID_TCL, $ID_CKL, '$DESC_ICL', $TPOITEN_ICL, '$VALINFORMADO') ");
										
				} //foreach
				
				$db->commit();
				//$status = "gravou";
				$status = array('status' => 'success');
				$status = json_encode($status);
			
			} catch (Exception $e){			
				$db->rollBack();
				//$status = "naogravou";			
				$status = array('status' => 'error');
				$status = json_encode($status);
			}//try
		}//if	
		else{
			//$status = "gravou"; //retorna que gravou..porque os dados jᠥst㯠na base...			
			$status = array('status' => 'success');
			$status = json_encode($status);
		}
		  
				
		unset($db);	  
		$db = null;
		echo $status;
});


$app->post('/enviacampostela', 'authenticate', function() use($app){
		
		$request = \Slim\Slim::getInstance()->request();
		$requisicao = json_decode($request->getBody());
		
		$db = getConn();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$status = "naogravou";
				
		$OS = $requisicao[0]->{'ID_OS'};
		$TELA = $requisicao[0]->{'TELA_CAMPO'};
		
		$sql="SELECT * FROM BT_SRV_CAMPOSTELAS WHERE ID_OS = $OS AND TELA_CAMPO = $TELA";
		$result = $db->query($sql);
		$Registros = $result->rowCount();
		
		//se nao existirem registros ainda...
		//ou se for pausa..pois pausa pode ter mais de um registro...
		if (($Registros == 0) || ($TELA == 3)){
		
			try {
			
				$db->beginTransaction();
			
				foreach ($requisicao as $objeto){
					$ID_OS = $objeto->{'ID_OS'};
					$TELA_CAMPO = $objeto->{'TELA_CAMPO'};
					$ORDEM_CAMPO = $objeto->{'ORDEM_CAMPO'};
					$DESC_CAMPO = $objeto->{'DESC_CAMPO'};
					$VALOR_CAMPO = $objeto->{'VALOR_CAMPO'};
					
					$db->exec(" INSERT INTO BT_SRV_CAMPOSTELAS (ID_OS, TELA_CAMPO, ORDEM_CAMPO, DESC_CAMPO, VALOR_CAMPO) VALUES ($ID_OS, $TELA_CAMPO, $ORDEM_CAMPO, '$DESC_CAMPO', '$VALOR_CAMPO') ");
										
				} //foreach
				
				$db->commit();
				$status = array('status' => 'success');
				$status = json_encode($status);
				
				//$status = "gravou";
			
			} catch (Exception $e){			
				$db->rollBack();
				$status = $e->getMessage();			
			}//try
		}//if	
		else{
			$status = array('status' => 'success');
			$status = json_encode($status);
		}
		  //$status = "gravou"; //retorna que gravou..porque os dados jᠥst㯠na base...		
				
		unset($db);	  
		$db = null;
		echo $status;
});


$app->post('/checklist/sign', 'authenticate', function() use($app){
		
		$request = \Slim\Slim::getInstance()->request();
		$requisicao = json_decode($request->getBody());

		$status = "naogravou";		
				
		try {
			$OS	= $requisicao->{'id_os'};
			$TIPO = $requisicao->{'tipo'};
			$FUNCIONAL = $requisicao->{'funcional'};
			$ASSINATURA = $requisicao->{'sign'};		
			$ASSINATURA_DECODE = base64_decode($ASSINATURA);
			$caminhoAssinatura = '../../imagens/assinaturas/'.$OS.'/'.$TIPO.'/';
			
			//se n㯠existir o caminho cria
			if(!is_dir ($caminhoAssinatura)){
			   mkdir($caminhoAssinatura, 0777, true);
			}
			
			//se existir a pasta
			if(is_dir ($caminhoAssinatura)){
			
			    //conta se ja existe arquivo na pasta
				$arquivos = glob("$caminhoAssinatura{*.jpg,*.JPG,*.png,*.gif,*.bmp}", GLOB_BRACE);
				
				$count = 0;
				
				foreach($arquivos as $img){
					$count++;
				}
			   
			   //se nao existir cria..
			   //ou se o tipo da assinatura for pausa...pois pausa pode ter vᲩas assinaturas
			   if (($count == 0) || ($TIPO == 3)){
			   		$arquivo = $caminhoAssinatura. uniqid() . '.png';
					try{
						$db = getConn();
						$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$db->exec("INSERT INTO BT_SRV_ASSINATURAS (ID_OS, ID_TPASS, FUNCIONALRESP_ASS, CAMINHOASSRESP_ASS) VALUES ($OS,1,'$FUNCIONAL','$caminhoAssinatura')");
						$db->commit();
						$status = array('status' => 'success');	
					}catch (Exception $e){			
						$db->rollBack();
						$status = array('status' => 'Error');			
					}
					
					if (file_put_contents($arquivo, $ASSINATURA_DECODE))
					  $status = array('status' => 'success');	
			   }	
			   else
			     $status = array('status' => 'success');	  //ja tem a imagem no server..entao  =  gravou							
			}
		}
		catch (Exception $e){
		  $status = array('status' => 'Error');	
		}			
		
		echo $status;
});


$app->post('/route', 'authenticate', function() use($app){

	
		$request = \Slim\Slim::getInstance()->request();
		$requisicao = json_decode($request->getBody());
	
		$db = getConn();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		$stmt = $db->prepare('SELECT COUNT(ID_CAD) AS TOTCAD FROM BT_SRV_LOGIN WHERE ID_CAD = :ID_CAD');
		$stmt->bindParam(':ID_CAD', $requisicao->{'idTecnico'});
		$stmt->execute();
		
		$id = $requisicao->{'idTecnico'};
		$datahora = $requisicao->{'DataHora'};
		$latitude = $requisicao->{'Latitude'};
		$longitude = $requisicao->{'Longitude'};
			
		$retorno = $stmt->fetch(PDO::FETCH_LAZY); 
		$linhas = count($retorno);
		$iTotCad = $retorno['TOTCAD'];

		//se encontrar o tecnico
		if ($iTotCad > 0){

			try {
			
				$date = strtotime($datahora);
						
				$sql = " INSERT INTO BT_SRV_TECNICOLOCALIZA (ID_CAD, DATAHORA_TLOC, LATITUDE_TLOC, LONGITUDE_TLOC) ".
					   " VALUES ($id, '$datahora', $latitude, $longitude)	        		 			   ";	

				$db->query($sql);
				
			} catch (Exception $e) {
				$iTotCad = $e->getMessage();
			}

		   echo $iTotCad;
		}  
		else
		  echo "incorreto";
		  
	unset($db);	  
	$db = null;
});


/*procedimento de solicita磯 de aceso...
o ws recebe a solicita磯..processa, grava na base a solic. e retorna email c dados ou informativo*/
$app->post('/reqacesso', 'authenticate', function() use($app){

	
		$request = \Slim\Slim::getInstance()->request();
		$requisicao = json_decode($request->getBody());
	
		$db = getConn();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$cpfReq = $requisicao->{'cpf'};
		$emailReq = $requisicao->{'email'};
		
		//verifica se existe tecnico cadastrado atrav鳠do cpf informado na solicitacao de acesso

		$stmt = $db->prepare("	SELECT C.ID_CAD FROM BT_ANA_CADASTRO C 		".
							 "	  INNER JOIN BT_SRV_DOCUMENTOS DOC			".
							 "	    ON DOC.ID_CAD = C.ID_CAD				".
							 "	  INNER JOIN BT_SRV_TPODOC TDOC				".
							 "	    ON TDOC.ID_TPODOC = DOC.ID_TPODOC		".
							 "	    AND TDOC.ID_TPODOC = 2 					".	//tipo 2 頃PF
							 "	    AND DOC.DESC_DOC = :CPF					");			
		
		$stmt->bindParam(':CPF', $cpfReq);
		$stmt->execute();
		
		$retorno = $stmt->fetch(PDO::FETCH_LAZY); 
		$linhas = count($retorno);
		$iIdCad = $retorno['ID_CAD'];

		//se encontrar o email de recupera磯
		if ($iIdCad > 0){
		
			try {
						
				$sql = " INSERT INTO BT_SRV_SOLICITAACESSO (ID_CAD, ID_STATUS, CPFCOL_SOLAC, EMAILCOL_SOLAC) ".
					   " VALUES ($iIdCad, 1, $cpfReq, '$emailReq')	        		 				  		 ";		//grava status 1..sempre como aguardando

				$db->query($sql);
				
			} catch (Exception $e) {
				$sRetorno = $e->getMessage();
			}
/*						   
		   $to =  $requisicao->{'email'};
		   $subject = "Gest㯠de Servi篠- Recupera磯 de Senha";
		   $txt = "Olᬠsua senha para acesso mobile 麠".$sSenha;
		   $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		   mail($to,$subject,$txt,$headers);
*/	

		   echo $iIdCad;
		}  
		else
		  echo "incorreto";
		  
	unset($db);	  
	$db = null;
});


//atualiza o status da OS ...
//quando o dispositivo a recebe..ou muda seu status
$app->post('/orderservice/status', 'authenticate', function() use($app){

	
		$request = \Slim\Slim::getInstance()->request();
		$requisicao = json_decode($request->getBody());
	
		$db = getConn();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$id_os = $requisicao->{'id_os'};
		$id_status = $requisicao->{'id_status'};
		$sRetorno = "";

			try {						
				$sql = " UPDATE BT_ANA_OS SET ID_SITOS = $id_status ".
					   " WHERE ID_OS = $id_os			  		  ";  //grava status 1..sempre como aguardando

				$db->query($sql);
				$retorno = array('status' => 'success');
				$sRetorno = json_encode($retorno);
				
			} catch (Exception $e) {
				$sRetorno = $e->getMessage();
			}

		unset($db);	  
		$db = null;

		echo $sRetorno;	  
});

$app->post('/device/registration', 'authenticate', function() use($app){

	$request = \Slim\Slim::getInstance()->request();
	$requisicao = json_decode($request->getBody());
	$device_id = $requisicao->{'device_id'};
	$id_tec = $requisicao->{'id_tec'};
//	$device_id = $_GET['id'];
//	$email = $_GET['email'];
	
	//$stmt = getConn()->query("UPDATE BT_ANA_CADASTRO SET DEVICEID_CAD='$device_id' WHERE ID_CAD = (SELECT ID_CAD FROM BT_SRV_LOGIN WHERE EMAIL_LOGIN ='$email')");
	$stmt = getConn()->query("UPDATE BT_ANA_CADASTRO SET DEVICEID_CAD='$device_id' WHERE ID_CAD = $id_tec");						 
	$stmt->fetchAll(PDO::FETCH_OBJ);	
	//echo true;
});

$app->post('/orderservice', 'authenticate', function() use($app){

	
		$request = \Slim\Slim::getInstance()->request();
		$requisicao = json_decode($request->getBody());
	
		$db = getConn();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$id_os = $requisicao->{'id_os'};
		$hora_ini = $requisicao->{'hora_inicio'};
		$hora_fin = $requisicao->{'hora_final'};
		$sRetorno = "";

			try {						
				if ($hora_ini != ""){
					$sql = " UPDATE BT_ANA_OS SET DATAHORAINI_OS = '$hora_ini' ".
					   " WHERE ID_OS = $id_os			  		  "; 
				$db->query($sql);
				}
				
				
				
				if ($hora_fin != ""){
					$sql = " UPDATE BT_ANA_OS SET DATAHORAFIN_OS = '$hora_fin' ".
					   " WHERE ID_OS = $id_os			  		  "; 
				$db->query($sql);
				}
				

				
				$retorno = array('status' => 'success');
				$sRetorno = json_encode($retorno);
				
			} catch (Exception $e) {
				$sRetorno = $e->getMessage();
			}

		unset($db);	  
		$db = null;

		echo $sRetorno;	  
});

$app->post('/recuperasenha', 'authenticate', function() use($app){

	
		$request = \Slim\Slim::getInstance()->request();
		$requisicao = json_decode($request->getBody());
		
		$db = getConn();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$status = "Erro de Insert";
				
		$email = $requisicao->{'email'};

		$sql="SELECT ID_LOGIN, SENHA_LOGIN FROM BT_SRV_LOGIN WHERE EMAIL_LOGIN ='$email'";
		$result = $db->query($sql);
		$linhas = $result->rowCount();
		if ($linhas > 0){
			try{
				$db->beginTransaction();
				foreach ($result as $objeto){
					$iIdCad = $objeto[0];
					$sSenha = $objeto[1];
			
					$db->exec("INSERT INTO BT_SRV_RECUPERARSENHA (ID_LOGIN, EMAIL_LOGIN,ID_STATUS, DATAHORA_RECSENHA) VALUES ($iIdCad, '$email',4, now())");
				}
				$db->commit();
				$msgEmail = 'Sua senha recuperada: '.$sSenha;
			    enviarEmailRecSenha($email, $msgEmail);
				$status = array('status' => 'success');
				$status = json_encode($status);
			}catch (Exception $e){			
				$db->rollBack();
				$status = array('status' => 'Error');
				$status = json_encode($status);
			}
		}else {
			$msgEmail = 'Este e-mail informado para recuperação não consta em nossos registros de dados. Informe um e-mail de técnico cadastrado.';
			enviarEmailRecSenha($email, $msgEmail);
			$status = array('status' => 'Error');
			$status = json_encode($status);
		  }
		  
	unset($db);	  
	$db = null;
	echo $status;
});

$app->post('/alterasenha', 'authenticate', function() use($app){

	
		$request = \Slim\Slim::getInstance()->request();
		$requisicao = json_decode($request->getBody());
		
		$db = getConn();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$status = "Erro de Insert";
				
		$email = $requisicao->{'email'};
		$senha_old = $requisicao->{'senha_old'};
		$senha_new = $requisicao->{'senha_new'};

		$sql="SELECT ID_LOGIN FROM BT_SRV_LOGIN WHERE EMAIL_LOGIN ='$email' AND SENHA_LOGIN = MD5('$senha_old')";
		$result = $db->query($sql);
		$linhas = $result->rowCount();
		if ($linhas > 0){
			try{
				$db->beginTransaction();
				foreach ($result as $objeto){
					$iIdCad = $objeto[0];
					
			
					$db->exec("UPDATE BT_SRV_LOGIN SET SENHA_LOGIN=MD5('$senha_new') WHERE ID_LOGIN=$iIdCad");
				}
				$db->commit();
				$status = array('status' => 'success');
				$status = json_encode($status);
			}catch (Exception $e){			
				$db->rollBack();
				$status = array('status' => 'Error');
				$status = json_encode($status);
			}
		}
		  
	unset($db);	  
	$db = null;
	echo $status;
});

$app->post('/enviafotos', 'authenticate', function() use($app){
		
	$request = \Slim\Slim::getInstance()->request();
	$requisicao = json_decode($request->getBody());

	$db = getConn();
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$status = "Erro de insert";
	
	foreach ($requisicao as $objeto){		
		$OS = $objeto->{'id_os'};
		$ID_LOCAL = $objeto->{'id_local'}; 
		$FOTO = $objeto->{'foto'};
		$FOTO_DECODE = base64_decode($FOTO);
		$caminhofoto = '../../imagens/fotos/'.$OS.'/'.$ID_LOCAL.'/';

		if(!is_dir ($caminhofoto)){
		   mkdir($caminhofoto, 0777, true);
		}
		if(is_dir ($caminhofoto)){//se existir a pasta
			$arquivos = glob("$caminhofoto{*.jpg,*.JPG,*.png,*.gif,*.bmp}", GLOB_BRACE); 			    //conta se ja existe arquivo na pasta
			$count = 0;
			foreach($arquivos as $img){
				$count++;
			}
		   	//se nao existir cria..
		   	//ou se o tipo da assinatura for pausa...pois pausa pode ter vᲩas assinaturas
		   //	if ($count == 0){
		   		$arquivo = $caminhofoto. uniqid(rand(),TRUE) . '.png';
				if (file_put_contents($arquivo, $FOTO_DECODE)){
				  	try{
						$db->beginTransaction();
						$db->exec("INSERT INTO BT_SRV_IMGATENDIMENTO(ID_OS, ID_FPROJ, CAMINHO_IMG) VALUES ($OS,$ID_LOCAL,'$caminhofoto')");
						$db->commit();
						$status = array('status' => 'success');
					}catch (Exception $e){			
						$db->rollBack();
						$status = array('status' => 'Error');
					}
		   		}
		  	//}else{
		    //	$status = array('status' => 'error'); //$status = json_encode($status);  
			//}
		}
	}
	echo json_encode($status);
	//echo ($caminhofoto);
});

$app->run();


//realiza a conex㯠com a base postgres

   function getConn() {
    $dbhost="localhost";
    $dbuser="dmp";
    $dbpass="dmp230571";
    $dbname="GESTSERV_DESENV";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));  
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
    }
	
	function enviarEmailRecSenha($emailDest, $Mensagem){

		$mail = new PHPMailer;
		
		//$mail->SMTPDebug = 3;                               // Enable verbose debug output
		
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'email-ssl.com.br';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'dmp@btime.com.br';                 // SMTP username
		$mail->Password = 'dmpbrasil';                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                    // TCP port to connect to
		
		$mail->From = 'dmp@btime.com.br';
		$mail->FromName = 'DMP - Mailer';
		$destino = utf8_decode('Técnico DMP');
		$mail->addAddress($emailDest,$destino );     // Add a recipient
		$mail->isHTML(true);                                  // Set email format to HTML
		
		$sub= utf8_decode('Recuperação de senha');
		$mail->Subject = $sub;
		$mail->Body    = $Mensagem;
		$mail->send();
   
	}




?>
