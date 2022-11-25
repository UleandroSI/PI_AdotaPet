<?php
header("Content-type: text/html; charset=utf-8");
include("banco.php");
include("func.php");


// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
    //header("Location: cadastro.html"); exit;
    echo "verifica se tem dados";
  } else{
    echo "Dados vazios.";
  }

// Recebendo dados do form cadastro
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
        
$lista = conectaBD();

$conn = $lista[0]; 
$conectado = $lista[1];

if ($conectado = "sim"){
  // begin the transaction
  $conn->beginTransaction();
  // Verifica se email existe
  $sql = "SELECT 'usuarios_id', 'usuarios_nome', 'usuarios_nivel' FROM 'usuarios' WHERE ('usuarios_email' = '".$email ."') AND ('usuarios_senha' = '". sha1($senha) ."') AND ('usuarios_ativo' = 1) LIMIT 1";
  // use exec() because no results are returned
  $conn->exec($sql);

  $query = mysql_query($sql);
  if (mysql_num_rows($query) != 1) {
    // O usuário não foi encontrado
    //echo "Login inválido!"; exit;
    //Chama funcao SALVAR
    echo "Chama func salvar.";
    $salva = salvarUsuario();

    // begin the transaction
    $conn->beginTransaction();
    // use exec() because no results are returned
    $conn->exec($sql);
    // commit the transaction
    $conn->commit();
    echo "New record created successfully";
    } else {
      // Salva os dados encontados na variável $resultado
      $resultado = mysql_fetch_assoc($query);
      }
} else{
  $conn = null;
  // Redireciona a pagina
  //header("Location: login.html"); exit;

}

?>
