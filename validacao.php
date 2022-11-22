<?php
header("Content-type: text/html; charset=utf-8");
include_once("banco.php");

  //$usuario = mysql_real_escape_string($_POST['$usuario']);
  $usuario = addslashes($_POST['usuario']);
  //$senha = mysql_real_escape_string($_POST['$senha']);
  $senha = addslashes($_POST['senha']);

  // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
  if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
      header("refresh:3;Location: login.html"); exit;
  }
  
  // Tenta se conectar ao servidor MySQL
  try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Validação do usuário/senha digitados
    $sql = "SELECT usuarios_id, usuarios_email 
      FROM usuarios 
      WHERE (usuarios_nome = ".$usuario .") AND (usuarios_hash = ". sha1($senha) .") AND (usuarios_ativo = 1) LIMIT 1";
    
    // begin the transaction
    $conn->beginTransaction();
    // use exec() because no results are returned
    $conn->exec($sql);

    $query = mysql_query($sql);
    if (mysql_num_rows($query) != 1) {
      // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
      echo "Login inválido!"; exit;
    } else {
        // Salva os dados encontrados na variável $resultado
        $resultado = mysql_fetch_assoc($query);
        echo "$resultado";

        // Se a sessão não existir, inicia uma
        if (!isset($_SESSION)) { 
          session_start();

        // Salva os dados encontrados na sessão
        $_SESSION['UsuarioID'] = $resultado['usuarios_id'];
        $_SESSION['UsuarioNome'] = $resultado['usuarios_nome'];

        // commit the transaction
        $conn->commit();


        // Redireciona o visitante
        header("Location: tryhow_css_parallax_demo.htm"); exit;
        //echo 'You\'ll be redirected in about 5 secs. If not, click <a href="http://localhost/PI_AdotaPet/login.html">here</a>.';
        //header( "refresh:3;url=login.html" );
      }

    } 
  }catch(PDOException $e) {
        // roll back the transaction if something failed
        //$conn->rollback();
        echo $sql . "<br>" . $e->getMessage();
    }

        // Redireciona o visitante
        //header("Location: tryhow_css_parallax_demo.htm"); exit;


    $conn = null;


  ?>