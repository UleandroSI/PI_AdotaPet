<?php
    session_start();   
    unset(
        $_SESSION['usuarios_id'],
        $_SESSION['usuarios_nome'],
        //$_SESSION['usuarioNiveisAcessoId'],
        $_SESSION['usuarios+email'],
        $_SESSION['usuarios_hash']
    );   
    $_SESSION['logindeslogado'] = "Deslogado com sucesso";
    //redirecionar o usuario para a página de login
    header("Location: login.php");
?>