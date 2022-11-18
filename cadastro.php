<?php
header("Content-type: text/html; charset=utf-8");
include_once("banco.php");


// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
    header("Location: cadastro.html"); exit;
  }

// Recebendo dados do form cadastro
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

try {
        // Criando a conexao
        $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Verifica se email existe
        //$sql = "SELECT 'usuarios_id', 'usuarios_nome', 'usuarios_nivel' FROM 'usuarios' WHERE ('usuarios_email' = '".$email ."') AND ('usuarios_senha' = '". sha1($senha) ."') AND ('usuarios_ativo' = 1) LIMIT 1";
        $sql = "SELECT 'usuarios_id', 'usuarios_nome', 'usuarios_nivel' FROM 'usuarios' WHERE ('usuarios_email' = '".$email ."') AND ('usuarios_ativo' = 1) LIMIT 1";
        $query = mysql_query($sql);
        if (mysql_num_rows($query) != 1) {
          // O usuário não foi encontrado
          //echo "Login inválido!"; exit;

            //Criar funcao SALVAR
            // Inserindo dados
            $sql = "INSERT INTO usuarios (
                usuarios_nome, 
                usuarios_email, 
                usuarios_hash,
                usuarios_ativo)
            VALUES (
                '$nome', 
                '$email', 
                sha1('$senha'), 
                '1')";
    
    // begin the transaction
    $conn->beginTransaction();
    // use exec() because no results are returned
    $conn->exec($sql);
    // commit the transaction
    $conn->commit();

    echo "New record created successfully";
    } catch(PDOException $e) {
        // roll back the transaction if something failed
        $conn->rollback();
        echo $sql . "<br>" . $e->getMessage();
    }

        } else {
          // Salva os dados encontados na variável $resultado
          $resultado = mysql_fetch_assoc($query);
          echo "Falha na gravaçao";
          }


        
    $conn = null;

    
    // Redireciona a pagina
    header("Location: login.html"); exit;

?>
