<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 07/05/2016
 * Time: 11:23
 */
    // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
    if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
        header("Location: login2.php"); exit;
    }

    // Tenta se conectar ao servidor MySQL
    mysql_connect('localhost', 'root', '') or trigger_error(mysql_error());

    // Tenta se conectar a um banco de dados MySQL
    mysql_select_db('mg') or trigger_error(mysql_error());

    $usuario = mysql_real_escape_string($_POST['usuario']);
    $senha = mysql_real_escape_string($_POST['senha']);

    // Validação do usuário/senha digitados
    $sql = "SELECT `ID_COLAB`, `NOME_COLAB`, `ID_PERFIL` FROM `tb_colaboradores` WHERE (`USUARIO_COLAB` = '". $usuario ."') AND (`SENHA_COLAB` = '". base64_encode($senha) ."') AND (`ATIVO` = 1) LIMIT 1";
    $query = mysql_query($sql);
    if (mysql_num_rows($query) != 1) {
        // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
        echo 0;
        exit;
    } else {
        // Salva os dados encontados na variável $resultado
        $resultado = mysql_fetch_assoc($query);

        // Se a sessão não existir, inicia uma
        if (!isset($_SESSION)) session_start();
        // Salva os dados encontrados na sessão
        $_SESSION['UsuarioID'] = $resultado['ID_COLAB'];
        $_SESSION['UsuarioNome'] = $resultado['NOME_COLAB'];
        $_SESSION['UsuarioNivel'] = $resultado['ID_PERFIL'];

        // Redireciona o visitante
        //header("Location: index2.php");
        //exit;
        echo 1;
    }