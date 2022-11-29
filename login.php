<?php
include_once "valida.php";
	//Inicializado primeira a sessão para posteriormente recuperar valores das variáveis globais. 
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="UleandroSP">
        <title>Login</title>
    </head>
    <body>
		<!-- Criado o formulário para o usuário colocar os dados de acesso.  -->
        <form method="POST" action="valida.php">
            <h2>Área Restrita</h2>
            <label>Email</label>
            <input type="email" name="email" placeholder="Email" required autofocus>
            <label>Senha</label>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Acessar</button>
        </form>
        <p>
            <?php 
			//Recuperando o valor da variável global, os erro de login.
			if(isset($_SESSION['loginErro'])){
                echo $_SESSION['loginErro'];
                unset($_SESSION['loginErro']);
            }?>
        </p>
        <p>
            <?php 
			//Recuperando o valor da variável global, deslogado com sucesso.
            if(isset($_SESSION['logindeslogado'])){
                echo $_SESSION['logindeslogado'];
                unset($_SESSION['logindeslogado']);
            }
            ?>
        </p>
    </body>
</html>