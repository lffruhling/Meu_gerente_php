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
				':nome'=> $nome,
				':cnpj'=> $cnpj,
				':cpf'=> $cpf,
				':cep'=> $cep,
				':rua'=> $rua,
				':nro'=> $nro,
				':comp'=> $complemento,
				':estado'=> $estado,
				':cid'=> $cidade,
				':fone1'=> $fone1,
				':fone2'=> $fone2,
				':cel'=> $celular,
				':email'=> $email,
				':ativo'=> $ativo
			));
			
			return 1;
		}catch(PDOException $e){
			return 'Error: '.$e->getMessage();
		}
	}
	};

?>
