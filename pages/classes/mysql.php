<?php
include "send_push.php";

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
		$result = $this->con->prepare(" SELECT USUARIO_COLAB, SENHA_COLAB   ".
                                      " FROM tb_colaboradores               ".
									  " WHERE USUARIO_COLAB = ?             ".
									  " AND SENHA_COLAB = ?                 ".
									  " AND ATIVO = 1                       ".
									  " AND ID_PERFIL <= 1                  ");
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

    public function _e_nome_cli($id){
        $result = $this->con->prepare( " SELECT NOME_CLI FROM mg.tb_cliente WHERE ID_CLI = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = 'NOME NÃO ENCONTRADO';
        }

        return $resultado;
    }

    public function _e_cnpj_cli($id){
        $result = $this->con->prepare( " SELECT CNPJ_CLI FROM mg.tb_cliente WHERE ID_CLI = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_cpf_cli($id){
        $result = $this->con->prepare( " SELECT CPF_CLI FROM mg.tb_cliente WHERE ID_CLI = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_cep_cli($id){
        $result = $this->con->prepare( " SELECT CEP_CLI FROM mg.tb_cliente WHERE ID_CLI = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '00000000000';
        }

        return $resultado;
    }

    public function _e_rua_cli($id){
        $result = $this->con->prepare( " SELECT RUA_CLI FROM mg.tb_cliente WHERE ID_CLI = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = 'RUA NÃO ENCONTRADA';
        }

        return $resultado;
    }

    public function _e_nro_cli($id){
        $result = $this->con->prepare( " SELECT NRO_CLI FROM mg.tb_cliente WHERE ID_CLI = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = 'SEM NÚMERO';
        }

        return $resultado;
    }

    public function _e_comp_cli($id){
        $result = $this->con->prepare( " SELECT COMPLEMENTO_CLI FROM mg.tb_cliente WHERE ID_CLI = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_estado_cli($id){
        $result = $this->con->prepare( " SELECT ESTADO_CLI FROM mg.tb_cliente WHERE ID_CLI = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_cidade_cli($id){
        $result = $this->con->prepare( " SELECT CIDADE_CLI FROM mg.tb_cliente WHERE ID_CLI = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_fone1_cli($id){
        $result = $this->con->prepare( " SELECT FONE1_CLI FROM mg.tb_cliente WHERE ID_CLI = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_fone2_cli($id){
        $result = $this->con->prepare( " SELECT FONE2_CLI FROM mg.tb_cliente WHERE ID_CLI = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_celular_cli($id){
        $result = $this->con->prepare( " SELECT CELULAR_CLI FROM mg.tb_cliente WHERE ID_CLI = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_email_cli($id){
        $result = $this->con->prepare( " SELECT EMAIL_CLI FROM mg.tb_cliente WHERE ID_CLI = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_ativo_cli($id){
        $result = $this->con->prepare( " SELECT ATIVO FROM mg.tb_cliente WHERE ID_CLI = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }

        if ($resultado == '1'){
            $resultado = 'checked';
        }else{
            $resultado ='';
        }

        return $resultado;
    }

    public function edita_cliente($nome,$cnpj,$cpf,$cep,$rua,$nro,$complemento,$estado,$cidade,$fone1,$fone2,$celular,$email,$ativo,$ID){
        try{
            $result = $this->con->prepare(	" UPDATE tb_cliente SET   ".
							                "  NOME_CLI = :nome,      ".
							                "  CNPJ_CLI = :cnpj,      ".
							                "  CPF_CLI = :cpf,        ".
							                "  CEP_CLI = :cep,        ".
							                "  RUA_CLI = :rua,        ".
							                " NRO_CLI = :nro,         ".
							                " COMPLEMENTO_CLI = :comp,".
							                " ESTADO_CLI = :estado,   ".
							                " CIDADE_CLI = :cid,      ".
							                " FONE1_CLI = :fone1,     ".
							                " FONE2_CLI = :fone2,     ".
							                " CELULAR_CLI = :cel,     ".
							                " EMAIL_CLI = :email,     ".
							                " ATIVO = :ativo,         ".
							                " UPDATEDAT = now()       ".
							                " WHERE ID_CLI = :id      ");

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
                ':ativo'=> (int) $ativo,
                ':id' => (int) $ID 
                ));

            return 1;
        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }
    }

    public function deleta_cliente($ID){
        try{
            $result = $this->con->prepare(	" UPDATE tb_cliente SET  ".
                                            " DELETADO = 1         ".
                                            " WHERE ID_CLI = :id      ");
            $result->execute(array(
                ':id' => (int) $ID
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

    public function _e_nome_perf($id){
        $result = $this->con->prepare( " SELECT DESC_PERFIL FROM tb_perfil WHERE ID_PERFIL = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_ativo_perf($id){
        $result = $this->con->prepare( " SELECT ATIVO FROM tb_perfil WHERE ID_PERFIL = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }

        if ($resultado == '1'){
            $resultado = 'checked';
        }else{
            $resultado ='';
        }

        return $resultado;
    }

    public function edita_perfil($nome,$ativo,$ID){
        try{
            $result = $this->con->prepare(	" UPDATE tb_perfil SET  ".
                "  DESC_PERFIL = :nome,      ".
                " ATIVO = :ativo,         ".
                " UPDATEDAT = now()         ".
                " WHERE ID_PERFIL = :id      ");

            $result->execute(array(
                ':nome'=> (string) $nome,
                ':ativo'=> (int) $ativo,
                ':id' => (int) $ID
            ));

            return 1;
        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }
    }

    public function deleta_perfil($ID){
        try{
            $result = $this->con->prepare(	" UPDATE tb_perfil SET  ".
                " DELETADO = 1         ".
                " WHERE ID_PERFIL = :id      ");
            $result->execute(array(
                ':id' => (int) $ID
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

    public function _e_nome_colab($id){
        $result = $this->con->prepare( " SELECT NOME_COLAB FROM tb_colaboradores WHERE ID_COLAB = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_perfil_colab($id){
        $resultado = array();
        $result = $this->con->prepare( " SELECT ID_PERFIL FROM tb_colaboradores WHERE ID_COLAB = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $id_result = utf8_encode($row[0]);
        }

        $result = $this->con->prepare( "SELECT ID_PERFIL, DESC_PERFIL FROM tb_perfil");
        $result->bindParam(1,$id_result);
        $result->execute();
        
        while ($row = $result->fetch(PDO::FETCH_BOTH)){
			$resultado['0'] = '';
			$id_ret =  ($row[0]);
            if($id_result == $id_ret){
                $desc_ret = utf8_encode($row[1]).'*';
            }else{
                $desc_ret = utf8_encode($row[1]);
            }
            $resultado["$id_ret"]="$desc_ret";
		}

		return $resultado;

    }

    public function _e_cpf_colab($id){
        $result = $this->con->prepare( " SELECT CPF_COLAB FROM tb_colaboradores WHERE ID_COLAB = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_dt_nasc_colab($id){
        $result = $this->con->prepare( " SELECT DATANASC_COLAB FROM tb_colaboradores WHERE ID_COLAB = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_cep_colab($id){
        $result = $this->con->prepare( " SELECT CEP_COLAB FROM tb_colaboradores WHERE ID_COLAB = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_rua_colab($id){
        $result = $this->con->prepare( " SELECT RUA_COLAB FROM tb_colaboradores WHERE ID_COLAB = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_nro_colab($id){
        $result = $this->con->prepare( " SELECT NRO_COLAB FROM tb_colaboradores WHERE ID_COLAB = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_bairro_colab($id){
        $result = $this->con->prepare( " SELECT BAIRRO_COLAB FROM tb_colaboradores WHERE ID_COLAB = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_comp_colab($id){
        $result = $this->con->prepare( " SELECT COMPLEMENTO_COLAB FROM tb_colaboradores WHERE ID_COLAB = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_estado_colab($id){
        $result = $this->con->prepare( " SELECT ESTADO_COLAB FROM tb_colaboradores WHERE ID_COLAB = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_cid_colab($id){
        $result = $this->con->prepare( " SELECT CIDADE_COLAB FROM tb_colaboradores WHERE ID_COLAB = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_fone1_colab($id){
        $result = $this->con->prepare( " SELECT FONE1_COLAB FROM tb_colaboradores WHERE ID_COLAB = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_cel_colab($id){
        $result = $this->con->prepare( " SELECT CEL1_COLAB FROM tb_colaboradores WHERE ID_COLAB = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_email_colab($id){
        $result = $this->con->prepare( " SELECT EMAIL_COLAB FROM tb_colaboradores WHERE ID_COLAB = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_usuario_colab($id){
        $result = $this->con->prepare( " SELECT USUARIO_COLAB FROM tb_colaboradores WHERE ID_COLAB = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_senha_colab($id){
        $result = $this->con->prepare( " SELECT SENHA_COLAB FROM tb_colaboradores WHERE ID_COLAB = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode(base64_decode($row[0]));
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_ativo_colab($id){
        $result = $this->con->prepare( " SELECT ATIVO FROM tb_colaboradores WHERE ID_COLAB = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }

        if ($resultado == '1'){
            $resultado = 'checked';
        }else{
            $resultado ='';
        }

        return $resultado;
    }

    public function edita_colab($nome,$id_perfil,$cpf,$dt_nasc,$cep,$rua,$nro,$bairro,$comp,$est,$cid,$fone,$cel,$email,$user,$pass,$ativo,$id){
        if ($pass == ''){
            $pass = $this->_e_senha_colab($id);
        }

        try{
            $result = $this->con->prepare(	" UPDATE tb_colaboradores SET   ".
                                            " ID_PERFIL= :id_perfil,        ".
                                            " NOME_COLAB= :nome,            ".
                                            " CPF_COLAB= :cpf,              ".
                                            " DATANASC_COLAB= :dt_nasc,     ".
                                            " CEP_COLAB= :cep,              ".
                                            " RUA_COLAB= :rua,              ".
                                            " NRO_COLAB= :nro,              ".
                                            " BAIRRO_COLAB= :bairro,        ".
                                            " COMPLEMENTO_COLAB= :comp,     ".
                                            " ESTADO_COLAB= :est,           ".
                                            " CIDADE_COLAB= :cid,           ".
                                            " FONE1_COLAB= :fone,           ".
                                            " CEL1_COLAB= :cel,             ".
                                            " EMAIL_COLAB= :email,          ".
                                            " USUARIO_COLAB= :usu,          ".
                                            " SENHA_COLAB= :pass,           ".
                                            " ATIVO= :ativo,                ".
                                            " UPDATEDAT= now()              ".
                                            " WHERE ID_COLAB= :id           ");

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
                ':ativo'=> (int) $ativo,
                ':id'=> (int) $id
            ));

            return 1;

        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }
    }

    public function deleta_colab($ID){
        try{
            $result = $this->con->prepare(	" UPDATE tb_colaboradores SET  ".
                " DELETADO = 1         ".
                " WHERE ID_COLAB = :id      ");
            $result->execute(array(
                ':id' => (int) $ID
            ));

            return 1;
        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }
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

    public function _e_nome_grupo($id){
        $result = $this->con->prepare( " SELECT DESC_GRUP FROM tb_grupo_produto WHERE ID_GRUP = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_ativo_grupo($id){
        $result = $this->con->prepare( " SELECT ATIVO FROM tb_grupo_produto WHERE ID_GRUP = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }

        if ($resultado == '1'){
            $resultado = 'checked';
        }else{
            $resultado ='';
        }

        return $resultado;
    }

    public function edita_grupo($nome,$ativo,$ID){
        try{
            $result = $this->con->prepare(	" UPDATE tb_grupo_produto SET  ".
                "  DESC_GRUP = :nome,      ".
                " ATIVO = :ativo,         ".
                " UPDATEDAT = now()         ".
                " WHERE ID_GRUP = :id      ");

            $result->execute(array(
                ':nome'=> (string) $nome,
                ':ativo'=> (int) $ativo,
                ':id' => (int) $ID
            ));

            return 1;
        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }
    }

    public function deleta_grupo($ID){
        try{
            $result = $this->con->prepare(	" UPDATE tb_grupo_produto SET  ".
                " DELETADO = 1         ".
                " WHERE ID_GRUP = :id      ");
            $result->execute(array(
                ':id' => (int) $ID
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

    public function _e_grupo_prod($id){
        $resultado = array();
        $result = $this->con->prepare( " SELECT ID_GRUP FROM tb_produtos WHERE ID_PROD = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $id_result = utf8_encode($row[0]);
        }

        $result = $this->con->prepare( "SELECT ID_GRUP, DESC_GRUP FROM tb_grupo_produto");
        $result->bindParam(1,$id_result);
        $result->execute();

        while ($row = $result->fetch(PDO::FETCH_BOTH)){
            $resultado['0'] = '';
            $id_ret =  ($row[0]);
            if($id_result == $id_ret){
                $desc_ret = utf8_encode($row[1]).'*';
            }else{
                $desc_ret = utf8_encode($row[1]);
            }
            $resultado["$id_ret"]="$desc_ret";
        }

        return $resultado;

    }

    public function _e_nome_prod($id){
        $result = $this->con->prepare( " SELECT NOME_PROD FROM tb_produtos WHERE ID_PROD = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_marca_prod($id){
        $result = $this->con->prepare( " SELECT MARCA_PROD FROM tb_produtos WHERE ID_PROD = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_modelo_prod($id){
        $result = $this->con->prepare( " SELECT MODELO_PROD FROM tb_produtos WHERE ID_PROD = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_valor_compra_prod($id){
        $result = $this->con->prepare( " SELECT VALOR_COMPRA_PROD FROM tb_produtos WHERE ID_PROD = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_valor_venda_prod($id){
        $result = $this->con->prepare( " SELECT VALOR_VENDA_PROD FROM tb_produtos WHERE ID_PROD = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_quantidade_prod($id){
        $result = $this->con->prepare( " SELECT QUANTIDADE_PROD FROM tb_produtos WHERE ID_PROD = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_desc_prod($id){
        $result = $this->con->prepare( " SELECT DESC_PROD FROM tb_produtos WHERE ID_PROD = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_ativo_prod($id){
        $result = $this->con->prepare( " SELECT ATIVO FROM tb_produtos WHERE ID_PROD = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }

        if ($resultado == '1'){
            $resultado = 'checked';
        }else{
            $resultado ='';
        }

        return $resultado;
    }

    public function edita_produto($nome,$id_grupo,$marca,$modelo,$desc,$quant,$valorcomp,$valorvend,$ativo,$ID){
        try{
            $result = $this->con->prepare(	" UPDATE tb_produtos SET            ".
                                            " NOME_PROD = :nome,                ".
                                            " ID_GRUP = :id_grupo,              ".
                                            " MARCA_PROD = :marca,              ".
                                            " MODELO_PROD = :modelo,            ".
                                            " DESC_PROD = :desc,                ".
                                            " QUANTIDADE_PROD = :quant,         ".
                                            " VALOR_COMPRA_PROD = :valorcomp,   ".
                                            " VALOR_VENDA_PROD = :valorvend,    ".
                                            " ATIVO = :ativo,                   ".
                                            " UPDATEDAT = now()                 ".
                                            " WHERE ID_PROD = :id               ");

            $result->execute(array(
                ':nome'=> (string) $nome,
                ':id_grupo'=> (int) $id_grupo,
                ':marca'=> (string) $marca,
                ':modelo'=> (string) $modelo,
                ':desc'=> (string) $desc,
                ':quant'=> (int) $quant,
                ':valorcomp'=> doubleval($valorcomp),
                ':valorvend'=> doubleval($valorvend),
                ':ativo'=> (int) $ativo,
                ':id' => (int) $ID
            ));

            return 1;
        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }
    }

    public function deleta_produto($ID){
        try{
            $result = $this->con->prepare(	" UPDATE tb_produtos SET  ".
                " DELETADO = 1         ".
                " WHERE ID_PROD = :id      ");
            $result->execute(array(
                ':id' => (int) $ID
            ));

            return 1;
        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }
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

    public function _e_nome_tipo_serv($id){
        $result = $this->con->prepare( " SELECT DESC_TPOSERV FROM tb_tpo_servico WHERE ID_TPOSERV = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_ativo_tipo_serv($id){
        $result = $this->con->prepare( " SELECT ATIVO FROM tb_tpo_servico WHERE ID_TPOSERV = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }

        if ($resultado == '1'){
            $resultado = 'checked';
        }else{
            $resultado ='';
        }

        return $resultado;
    }

    public function edita_tipo_serv($nome,$ativo,$ID){
        try{
            $result = $this->con->prepare(	" UPDATE tb_tpo_servico SET  ".
                "  DESC_TPOSERV = :nome,      ".
                " ATIVO = :ativo,         ".
                " UPDATEDAT = now()         ".
                " WHERE ID_TPOSERV = :id      ");

            $result->execute(array(
                ':nome'=> (string) $nome,
                ':ativo'=> (int) $ativo,
                ':id' => (int) $ID
            ));

            return 1;
        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }
    }

    public function deleta_tipo_serv($ID){
        try{
            $result = $this->con->prepare(	" UPDATE tb_tpo_servico SET  ".
                " DELETADO = 1         ".
                " WHERE ID_TPOSERV = :id      ");
            $result->execute(array(
                ':id' => (int) $ID
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

    public function insere_os($idg,$id_cli,$id_tp_serv,$id_tec,$orcamento,$obs,$foto,$email,$ativo){
        try{
            $result = $this->con->prepare(	" INSERT INTO tb_os (ID_CLI, ID_TPOSERV, ID_COLAB, ID_JS, OBS_OS,     ".
                                            " ORCAMENTO, FOTO, ATIVA_EMAIL, ATIVO, CREATEDAT) VALUES (:id_cli,    ".
                                            " :id_tp_serv, :id_tec, :idg, :obs, :orcamento, :foto,:email, :ativo, ".
                                            " now())                                                              ");

            $result->execute(array(
                ':idg'=> (string) $idg,
                ':id_cli'=> (int) $id_cli,
                ':id_tp_serv'=> (int) $id_tp_serv,
                ':id_tec'=> (int) $id_tec,
                ':orcamento'=> (int) $orcamento,
                ':foto'=> (int) $foto,
                ':email'=> (int) $email,
                ':obs'=> (string) $obs,
                ':ativo'=> (int) $ativo
            ));

            $id_os = $this->con->lastInsertId();
            $this->manda_push_nova_os($id_tec);
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

    public function _e_cliente_os($id){
        $resultado = array();
        $result = $this->con->prepare( " SELECT ID_CLI FROM tb_os WHERE ID_OS = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $id_result = utf8_encode($row[0]);
        }

        $result = $this->con->prepare( "SELECT ID_CLI, NOME_CLI FROM tb_cliente");
        $result->bindParam(1,$id_result);
        $result->execute();

        while ($row = $result->fetch(PDO::FETCH_BOTH)){
            $resultado['0'] = '';
            $id_ret =  ($row[0]);
            if($id_result == $id_ret){
                $desc_ret = utf8_encode($row[1]).'*';
            }else{
                $desc_ret = utf8_encode($row[1]);
            }
            $resultado["$id_ret"]="$desc_ret";
        }

        return $resultado;

    }

    public function _e_tipo_serv_os($id){
        $resultado = array();
        $result = $this->con->prepare( " SELECT ID_TPOSERV FROM tb_os WHERE ID_OS = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $id_result = utf8_encode($row[0]);
        }

        $result = $this->con->prepare( "SELECT ID_TPOSERV, DESC_TPOSERV FROM tb_tpo_servico");
        $result->bindParam(1,$id_result);
        $result->execute();

        while ($row = $result->fetch(PDO::FETCH_BOTH)){
            $resultado['0'] = '';
            $id_ret =  ($row[0]);
            if($id_result == $id_ret){
                $desc_ret = utf8_encode($row[1]).'*';
            }else{
                $desc_ret = utf8_encode($row[1]);
            }
            $resultado["$id_ret"]="$desc_ret";
        }

        return $resultado;

    }

    public function _e_tecnico_os($id){
        $resultado = array();
        $result = $this->con->prepare( " SELECT ID_COLAB FROM tb_os WHERE ID_OS = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $id_result = utf8_encode($row[0]);
        }

        $result = $this->con->prepare( "SELECT ID_COLAB, NOME_COLAB FROM tb_colaboradores");
        $result->bindParam(1,$id_result);
        $result->execute();

        while ($row = $result->fetch(PDO::FETCH_BOTH)){
            $resultado['0'] = '';
            $id_ret =  ($row[0]);
            if($id_result == $id_ret){
                $desc_ret = utf8_encode($row[1]).'*';
            }else{
                $desc_ret = utf8_encode($row[1]);
            }
            $resultado["$id_ret"]="$desc_ret";
        }

        return $resultado;

    }

    public function _e_obs_os($id){
        $result = $this->con->prepare( " SELECT OBS_OS FROM tb_os WHERE ID_OS = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function _e_orca_os($id){
        $result = $this->con->prepare( " SELECT ORCAMENTO FROM tb_os WHERE ID_OS = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }

        if ($resultado == '1'){
            $resultado = 'checked';
        }else{
            $resultado ='';
        }

        return $resultado;
    }

    public function _e_foto_os($id){
        $result = $this->con->prepare( " SELECT FOTO FROM tb_os WHERE ID_OS = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }

        if ($resultado == '1'){
            $resultado = 'checked';
        }else{
            $resultado ='';
        }

        return $resultado;
    }

    public function _e_email_os($id){
        $result = $this->con->prepare( " SELECT ATIVA_EMAIL FROM tb_os WHERE ID_OS = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }

        if ($resultado == '1'){
            $resultado = 'checked';
        }else{
            $resultado ='';
        }

        return $resultado;
    }

    public function _e_ativo_os($id){
        $result = $this->con->prepare( " SELECT ATIVO FROM tb_os WHERE ID_OS = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }

        if ($resultado == '1'){
            $resultado = 'checked';
        }else{
            $resultado ='';
        }

        return $resultado;
    }

    public function _e_idg_os($id){
        $result = $this->con->prepare( " SELECT ID_JS FROM tb_os WHERE ID_OS = ?");
        $result->bindParam(1,$id);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $resultado = utf8_encode($row[0]);
        }else{
            $resultado = '';
        }

        return $resultado;
    }

    public function edita_os($id_cli,$id_tp_serv,$id_tec,$orcamento,$obs,$foto,$email,$ativo,$id){
        try{
            $result = $this->con->prepare(	" UPDATE tb_os SET          ".
                                            " ID_CLI = :id_cli,         ".
                                            " ID_TPOSERV = :id_tp_serv, ".
                                            " ID_COLAB = :id_tec,       ".
                                            " OBS_OS = :obs,            ".
                                            " ORCAMENTO = :orcamento,   ".
                                            " FOTO = :foto,             ".
                                            " ATIVA_EMAIL = :email,     ".
                                            " ATIVO = :ativo,           ".
                                            " UPDATEDAT = now()         ".
                                            " WHERE ID_OS= :id          ");

            $result->execute(array(
               	':id'=> (int) $id,
                ':id_cli'=> (int) $id_cli,
                ':id_tp_serv'=> (int) $id_tp_serv,
                ':id_tec'=> (int) $id_tec,
                ':obs'=> (string) $obs,
                ':orcamento'=> (int) $orcamento,
                ':foto'=> (int) $foto,
                ':email'=> (int) $email,
                ':ativo'=> (int) $ativo
            ));

            //$retorno = 1;

            return 1;

        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }

        //return $retorno;
    }

    public function deleta_os($ID){
        try{
            $result = $this->con->prepare(	" UPDATE tb_os SET  ".
                " DELETADO = 1         ".
                " WHERE ID_OS = :id      ");
            $result->execute(array(
                ':id' => (int) $ID
            ));

            return 1;
        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }
    }

    public function total_abertas(){
        $consulta = $this->con->query("select count(ID_OS) abertas from tb_os where ID_STATUS in (1,2);");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $retorno = $linha['abertas'];
        }
        return $retorno;
    }

    public function total_orcadas(){
        $consulta = $this->con->query("select count(ID_OS) orcadas from tb_os where ID_STATUS in (3);");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $retorno = $linha['orcadas'];
        }
        return $retorno;
    }

    public function total_concluidas(){
        $consulta = $this->con->query("select count(ID_OS) concluidas from tb_os where ID_STATUS in (4);");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $retorno = $linha['concluidas'];
        }
        return $retorno;
    }

    public function manda_push_nova_os($tecnico){
        $key = "AIzaSyAYFaIiMrwXPKoap58vv6RZPjIpovrn4qQ";
        $result = $this->con->prepare( " SELECT ID_DEVICE_COLAB FROM tb_colaboradores WHERE ID_COLAB = ?");
        $result->bindParam(1,$tecnico);
        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $device = utf8_encode($row[0]);
        }

        $message = "Você tem uma nova tarefa!";
        $author = "";
        $title = "Meu Gerente";
        send_push($key,$device,$message,$author,$title);
        $retorno = 1;

        return $retorno;
    }

    public function altera_senha($usuario,$old_senha,$new_senha){
        $result = $this->con->prepare( " SELECT ID_COLAB FROM tb_colaboradores Where USUARIO_COLAB = ? AND SENHA_COLAB = ?");
        $result->bindParam(1,$usuario);
        $result->bindParam(2,base64_encode($old_senha));

        if($result->execute()){
            $row = $result->fetch(PDO::FETCH_BOTH);
            $id_colab = utf8_encode($row[0]);
        }

        if ($id_colab != 0){
            $result = $this->con->prepare(	" UPDATE tb_colaboradores SET   ".
                                            " SENHA_COLAB = :new_senha      ".
                                            " WHERE ID_COLAB = :id           ");

            $result->execute(array(
                ':id'=> (int) $id_colab,
                ':new_senha'=> base64_encode($new_senha)
            ));
            $retorno = 1;
        }else{
            $retorno = 2;
        }

        return $retorno;
    }

	};
?>
