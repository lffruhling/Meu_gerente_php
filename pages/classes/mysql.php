<?php
//include "../utils/send_push.php";

// Conexão com o banco
static $dbhost = 'localhost';
static $dbuser = 'root';
static $dbpass = '';
static $dbtable = 'mg';

class MySQL{
	// Conexão com o banco
	static public $dbhost = 'localhost';
	static public $dbuser = 'root';
	static public $dbpass = '';
	static public $dbtable = 'mg';

	protected $conn;
	protected $result;
	protected $perfil;
	protected $idSolicitacao;
	public $idlogin;
	
	public function conecta(){
		$host = self::$dbhost;
		$user = self::$dbuser;
		$pass = self::$dbpass;
		$base = self::$dbtable;
		$this->con = new PDO("mysql:host=$host;dbname=$base", "$user", "$pass");
		if(!$this->con){
			return 0;
		}else{
			return 1;	
		}
	}
	
	public function desconecta(){
		$this->con = NULL;
	}
	
	public function valida_login($usuario, $senha){
		$result = $this->con->prepare(" SELECT USUARIO_COLAB, SENHA_COLAB FROM 	".
									  " tb_colaboradores WHERE USUARIO_COLAB = ? ". 
									  " AND SENHA_COLAB = ?");
		$result->bindParam(1,$usuario);
		$result->bindParam(2,base64_encode($senha));
		if($result->execute()){
			if($result->rowCount() > 0){
				while ($row = $result->fetch(PDO::FETCH_OBJ)){
					return 1;	
					break;
				}
			}else{
				return 0;
			}
		}
	}
	
	public function insere_cliente($nome,$cnpj,$cpf,$cep,$rua,$nro,$complemento,$estado,$cidade,$fone1,$fone2,$celular,$email,$ativo){
		try{
			$result = $this->con->prepare(	" INSERT INTO tb_cliente(NOME_CLI, CNPJ_CLI, CPF_CLI, CEP_CLI, RUA_CLI, NRO_CLI, COMPLEMENTO_CLI,".
											" ESTADO_CLI, CIDADE_CLI, FONE1_CLI, FONE2_CLI, CELULAR_CLI, EMAIL_CLI, ATIVO, CREATEDAT) VALUES ".
											" (:nome,:cnpj,:cpf,:cep,:rua,:nro,:comp,:estado,:cid,:fone1,:fone2,:cel,:email,:ativo,now())	 ");
			$result->execute(array(
				':nome'=> (string) $nome,
				':cnpj'=> (int) $cnpj,
				':cpf'=> (int) $cpf,
				':cep'=> (int) $cep,
				':rua'=> (string) $rua,
				':nro'=> (string) $nro,
				':comp'=> (string) $complemento,
				':estado'=> (string) $estado,
				':cid'=> (string) $cidade,
				':fone1'=> (int) $fone1,
				':fone2'=> (int) $fone2,
				':cel'=> (int) $celular,
				':email'=> (string) $email,
				':ativo'=> (int) $ativo
			));
			
			return 1;
		}catch(PDOException $e){
			return 'Error: '.$e->getMessage();
		}
	}
	
	public function insere_perfil($nome,$ativo){
		try{
			$result = $this->con->prepare(	" INSERT INTO tb_perfil(DESC_PERFIL, ATIVO, CREATEDAT) VALUES (:nome,:ativo,NOW())");
			$result->execute(array(
				':nome'=> (string) $nome,
				':ativo'=> (int) $ativo
			));
			
			return 1;
		}catch(PDOException $e){
			return 'Error: '.$e->getMessage();
		}
	}
	
	public function insere_grupo($nome,$ativo){
		try{
			$result = $this->con->prepare(	" INSERT INTO tb_grupo_produto (DESC_GRUP, ATIVO, CREATEDAT) VALUES (:nome,:ativo,NOW())");
			$result->execute(array(
				':nome'=> (string) $nome,
				':ativo'=> (int) $ativo
			));
			
			return 1;
		}catch(PDOException $e){
			return 'Error: '.$e->getMessage();
		}
	}
	
	public function insere_tipo_serv($nome,$ativo){
		try{
			$result = $this->con->prepare(	" INSERT INTO tb_tpo_servico (DESC_TPOSERV, ATIVO, CREATEDAT) VALUES (:nome,:ativo,NOW())");
			$result->execute(array(
				':nome'=> (string) $nome,
				':ativo'=> (int) $ativo
			));
			
			return 1;
		}catch(PDOException $e){
			return 'Error: '.$e->getMessage();
		}
	}
	
	public function insere_colab($nome,$ativo){
		try{
			$result = $this->con->prepare(	" INSERT INTO tb_tpo_servico (DESC_TPOSERV, ATIVO, CREATEDAT) VALUES (:nome,:ativo,NOW())");
			$result->execute(array(
				':nome'=> (string) $nome,
				':ativo'=> (int) $ativo
			));
			
			return 1;
		}catch(PDOException $e){
			return 'Error: '.$e->getMessage();
		}
	}

	public function _n_perfil_colab(){
		$retorno = array();
		$retorno["0"] = "";
		$sql = 	'SELECT ID_PERFIL, DESC_PERFIL FROM tb_perfil '.
				'WHERE ATIVO = 1 AND (DELETADO = 0 OR DELETADO '.
				'IS NULL) ORDER BY 2';
				
		foreach($this->con->query($sql) as $row){
			$id 	= $row['ID_PERFIL'];
			$desc = utf8_encode($row['DESC_PERFIL']);
			$retorno["$id"]="$desc";
		}
		return $retorno;
	}


	};
?>
