<?php
header("Content-type: text/html; charset=utf-8");
include_once("banco.php");

  // Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
  if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
      header("Location: login.html"); exit;
  }

  // Tenta se conectar ao servidor MySQL
  mysql_connect('$host', '$user', '$password') or trigger_error(mysql_error());
  // Tenta se conectar a um banco de dados MySQL
  mysql_select_db('$database') or trigger_error(mysql_error());

  $usuario = mysql_real_escape_string($_POST['$usuario']);
  $senha = mysql_real_escape_string($_POST['$senha']);

  // Validação do usuário/senha digitados
  $sql = "SELECT 'usuarios_id', 'usuarios_email', 'usuarios_nivel' FROM 'usuarios WHERE (usuarios_email = '".$usuario ."') AND (usuarios_hash = '". sha1($senha) ."') AND (usuarios_ativo = 1) LIMIT 1";
  $query = mysql_query($sql);
  
  if (mysql_num_rows($query) != 1) {
      // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
      echo "Login inválido!"; exit;
  } else {
      // Salva os dados encontrados na variável $resultado
      $resultado = mysql_fetch_assoc($query);

      // Se a sessão não existir, inicia uma
      if (!isset($_SESSION)) session_start();

      // Salva os dados encontrados na sessão
      $_SESSION['UsuarioID'] = $resultado['usuarios_id'];
      $_SESSION['UsuarioNome'] = $resultado['usuarios_email'];
      $_SESSION['UsuarioNivel'] = $resultado['usuarios_nivel'];

      // Redireciona o visitante
      header("Location: tryhow_css_parallax_demo.htm"); exit;
  }

  ?>