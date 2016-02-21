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

    /*
     *
     * Login
     *
    */

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

    /*
     *
     * Clientes
     *
    */

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

    /*
     *
     * Perfil
     *
    */

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

    /*
     *
     * Colaboradores
     *
    */

    public function insere_colab($nome,$id_perfil,$cpf,$dt_nasc,$cep,$rua,$nro,$bairro,$comp,$est,$cid,$fone,$cel,$email,$user,$pass,$ativo){
        try{
            $result = $this->con->prepare(	" INSERT INTO tb_colaboradores(ID_PERFIL, NOME_COLAB, CPF_COLAB, DATANASC_COLAB, CEP_COLAB,       ".
                " RUA_COLAB, NRO_COLAB, BAIRRO_COLAB, COMPLEMENTO_COLAB, ESTADO_COLAB, CIDADE_COLAB, FONE1_COLAB, ".
                " CEL1_COLAB, EMAIL_COLAB, USUARIO_COLAB, SENHA_COLAB, ATIVO, CREATEDAT) VALUES (:id_perfil,:nome,".
                ":cpf,:dt_nasc,:cep,:rua,:nro,:bairro,:comp,:est,:cid,:fone,:cel,:email,:usu,:pass,:ativo,now())  ");

            $result->execute(array(
                ':nome'=> (string) $nome,
                ':id_perfil'=> (int) $id_perfil,
                ':cpf'=> (int) $cpf,
                ':dt_nasc'=>  $dt_nasc,
                ':cep'=> (int) $cep,
                ':rua'=> (string) $rua,
                ':nro'=> (string) $nro,
                ':bairro'=> (string) $bairro,
                ':comp'=> (string) $comp,
                ':est'=> (string) $est,
                ':cid'=> (string) $cid,
                ':fone'=> (int) $fone,
                ':cel'=> (int) $cel,
                ':email'=> (string) $email,
                ':usu'=> (string) $user,
                ':pass'=> (string) base64_encode($pass),
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
        $sql = 	'SELECT ID_PERFIL, DESC_PERFIL FROM tb_perfil  '.
            'WHERE ATIVO = 1 AND (DELETADO = 0 OR DELETADO '.
            'IS NULL) ORDER BY 2';

        foreach($this->con->query($sql) as $row){
            $id 	= $row['ID_PERFIL'];
            $desc = utf8_encode($row['DESC_PERFIL']);
            $retorno["$id"]="$desc";
        }
        return $retorno;
    }

    /*
     *
     * Grupo de Produtos
     *
    */

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

    /*
     *
     * Produtos
     *
    */

    public function insere_produto($nome,$id_grupo,$marca,$modelo,$desc,$quant,$valorcomp,$valorvend,$ativo){
        try{
            $result = $this->con->prepare(	" INSERT INTO tb_produtos(ID_GRUP, NOME_PROD, MARCA_PROD, MODELO_PROD,      ".
                                            " DESC_PROD, QUANTIDADE_PROD, VALOR_COMPRA_PROD, VALOR_VENDA_PROD, ATIVO,   ".
                                            " CREATEDAT) VALUES (:id_grupo,:nome,:marca,:modelo,:desc,:quant,:valorcomp,".
                                            " :valorvend,:ativo,now())");

            $result->execute(array(
                ':nome'=> (string) $nome,
                ':id_grupo'=> (int) $id_grupo,
                ':marca'=> (string) $marca,
                ':modelo'=> (string) $modelo,
                ':desc'=> (string) $desc,
                ':quant'=> (string) $quant,
                ':valorcomp'=> doubleval($valorcomp),
                ':valorvend'=> doubleval($valorvend),
                ':ativo'=> (int) $ativo
            ));

            return 1;

        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }
    }

    public function _n_grupo_prod(){
        $retorno = array();
        $retorno["0"] = "";
        $sql = 	'SELECT ID_GRUP, DESC_GRUP FROM tb_grupo_produto '.
            'WHERE ATIVO = 1 AND (DELETADO = 0 OR DELETADO IS'.
            ' NULL) ORDER BY 2';

        foreach($this->con->query($sql) as $row){
            $id 	= $row['ID_GRUP'];
            $desc = utf8_encode($row['DESC_GRUP']);
            $retorno["$id"]="$desc";
        }
        return $retorno;
    }

    /*
     *
     * Tipos de Serviços
     *
    */

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

    /*
     *
     * Ordens de Serviços
     *
    */

    public function insere_os($idg,$id_cli,$id_tp_serv,$id_tec,$orcamento,$obs,$foto,$ativo){
        try{
            $result = $this->con->prepare(	" INSERT INTO tb_os (ID_CLI, ID_TPOSERV, ID_COLAB, ID_JS, OBS_OS,   ".
                                            " ORCAMENTO, FOTO, ATIVO, CREATEDAT) VALUES (:id_cli, :id_tp_serv,  ".
                                            " :id_tec, :idg, :obs, :orcamento, :foto, :ativo, now())            ");

            $result->execute(array(
                ':idg'=> (string) $idg,
                ':id_cli'=> (int) $id_cli,
                ':id_tp_serv'=> (int) $id_tp_serv,
                ':id_tec'=> (int) $id_tec,
                ':orcamento'=> (int) $orcamento,
                'foto'=> (int) $foto,
                ':obs'=> (string) $obs,
                ':ativo'=> (int) $ativo
            ));

            $id_os = $this->con->lastInsertId();
        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
            $retorno = 'Error: '.$e->getMessage();
        }

        try{

            $sql = "UPDATE tb_produtos_usados SET ID_OS=:ID_OS WHERE ID_JS=:ID_JS";

            $result = $this->con->prepare($sql);

            $result->bindParam(':ID_JS', $idg, PDO::PARAM_INT);
            $result->bindParam(':ID_OS', $id_os, PDO::PARAM_INT);

            $result->execute();

            $retorno = 1;

            return $retorno;
        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }

    }

    public function adiciona_produto($idg,$grupo_produto,$produto,$quant){
        try{
            $result = $this->con->prepare(	" INSERT INTO tb_produtos_usados (ID_PROD, ID_GRUP, ID_JS,    ".
                                            " QUANTIDADE_PROD_US,  CREATEDAT) VALUES (:id_prod,:id_grupo, ".
                                            " :idg,:quant,now())                                          ");

            $result->execute(array(
                ':id_prod'=> (int) $produto,
                ':id_grupo'=> (int) $grupo_produto,
                ':idg'=> (string) $idg,
                ':quant'=> (int) $quant
            ));

            return 1;

        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }
    }

    public function _n_cliente_os(){
        $retorno = array();
        $retorno["0"] = "";
        $sql = 	' SELECT ID_CLI, NOME_CLI FROM tb_cliente       '.
                ' WHERE ATIVO = 1 AND (DELETADO = 0 OR DELETADO '.
                ' IS NULL) ORDER BY 2                           ';

        foreach($this->con->query($sql) as $row){
            $id 	= $row['ID_CLI'];
            $desc = utf8_encode($row['NOME_CLI']);
            $retorno["$id"]="$desc";
        }
        return $retorno;
    }

    public function _n_tipo_serv_os(){
        $retorno = array();
        $retorno["0"] = "";
        $sql = 	' SELECT ID_TPOSERV, DESC_TPOSERV FROM tb_tpo_servico   '.
                ' WHERE ATIVO = 1 AND (DELETADO = 0 OR DELETADO IS      '.
                ' NULL) ORDER BY 2                                      ';

        foreach($this->con->query($sql) as $row){
            $id 	= $row['ID_TPOSERV'];
            $desc = utf8_encode($row['DESC_TPOSERV']);
            $retorno["$id"]="$desc";
        }
        return $retorno;
    }

    public function _n_tecnico_os(){
        $retorno = array();
        $retorno["0"] = "";
        $sql = 	'SELECT ID_COLAB, NOME_COLAB FROM tb_colaboradores '.
                ' WHERE ATIVO = 1 AND (DELETADO = 0 OR DELETADO IS '.
                ' NULL) ORDER BY 2                                 ';

        foreach($this->con->query($sql) as $row){
            $id 	= $row['ID_COLAB'];
            $desc = utf8_encode($row['NOME_COLAB']);
            $retorno["$id"]="$desc";
        }
        return $retorno;
    }

    public function _n_grupo_produto_os(){
        $retorno = array();
        $retorno["0"] = "";
        $sql = 	'SELECT ID_GRUP, DESC_GRUP FROM tb_grupo_produto '.
            'WHERE ATIVO = 1 AND (DELETADO = 0 OR DELETADO IS'.
            ' NULL) ORDER BY 2';

        foreach($this->con->query($sql) as $row){
            $id 	= $row['ID_GRUP'];
            $desc = utf8_encode($row['DESC_GRUP']);
            $retorno["$id"]="$desc";
        }
        return $retorno;
    }

    public function _n_produto($grupo_produto)
    {
        $retorno = array();
        $retorno["0"] = "";
        $sql = 	"SELECT ID_PROD, NOME_PROD FROM tb_produtos WHERE ID_GRUP = ".$grupo_produto." AND ATIVO = 1 AND (DELETADO = 0 OR DELETADO IS NULL) ORDER BY 2";

        foreach($this->con->query($sql) as $row){
            $id 	= $row['ID_PROD'];
            $desc = utf8_encode($row['NOME_PROD']);
            $retorno["$id"]="$desc";
        }
        return $retorno;
    }

	};
?>
