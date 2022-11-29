<?php
header("Content-type: text/html; charset=utf-8");
include_once("conexao.php");

// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
    //header("Location: cadastro.html"); exit;
  }

// Recebendo dados do form cadastro
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

// Verifica se email existe
$login = "SELECT usuarios_id, usuarios_nome, usuarios_ativo FROM usuarios WHERE usuarios_email = '$email' && usuarios_ativo = 1 LIMIT 1";
$result = mysqli_query($conn, $login);
$res = mysqli_fetch_assoc($result);
//$res = mysql_fetch_row($result);
if(empty($res)){
    // O usuário não foi encontrado, insere no banco.
    $sql = "INSERT INTO usuarios (
        usuarios_nome, 
        usuarios_email, 
        usuarios_hash,
        usuarios_ativo)
        VALUES (
            '$nome', 
            '$email', 
            md5('.$senha.'), 
            '1')";

    $resultado = mysqli_query($conn, $sql);
    $exec = mysqli_fetch_assoc($resultado);
    if (mysql_num_rows($exec) != 1){
        echo "Inserido.";
        header("Location: modelo.html");
    }else{
        header('location:restrito.php');
    }
    
}else{
    echo "Usuário já existe.";
    header('location:login.php');
  }

$conn->close();

    
// Redireciona a pagina
//header("Location: login.html"); exit;

?>
