<?php
    header("Content-type: text/html; charset=utf-8");
    include_once("banco.php");

    // Recebendo dados do form
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $telefone = addslashes($_POST['telefone']);
    $familiares = addslashes($_POST['familiares']);
    $menores = addslashes($_POST['menores']);
    $casaApe = addslashes($_POST['casaApe']);
    $endereco = addslashes($_POST['endereco']);
    $adaptacao = addslashes($_POST['adaptacao']);
    $alimentacao = addslashes($_POST['alimentacao']);
    $janelas = addslashes($_POST['janelas']);
    $rua = addslashes($_POST['rua']);
    $cienteAdocao = addslashes($_POST['cienteAdocao']);
    $tratamento = addslashes($_POST['tratamento']);
    $autorizacao = addslashes($_POST['autorizacao']);
    $posAdocao = addslashes($_POST['posAdocao']);

    try {
        // Criando a conexao
        $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Inserindo dados
        $sql = "INSERT INTO formulario (
            formulario_nome, 
            formulario_email, 
            formulario_telefone, 
            formulario_familiares, 
            formulario_menores, 
            formulario_casaApe, 
            formulario_endereco,
            formulario_adaptacao,
            formulario_alimentacao, 
            formulario_janelas, 
            formulario_rua,
            formulario_cienteAdocao,
            formulario_tratamento,
            formulario_autorizacao,
            formulario_posAdocao,
            formulario_data)
        VALUES (
            '$nome', 
            '$email', 
            '$telefone', 
            '$familiares', 
            '$menores', 
            '$casaApe', 
            '$endereco',
            '$adaptacao',
            '$alimentacao', 
            '$janelas', 
            '$rua',
            '$cienteAdocao',
            '$tratamento',
            '$autorizacao',
            '$posAdocao',
            NOW())";
    
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

    $conn = null;

    
    // Redireciona a pagina
    header("Location: index.html"); exit;
?>
