<?php
    header("Content-type: text/html; charset=utf-8");
    //header("Location: index.html");
    include_once("banco.php");
    include_once("func.php");

    // Recebendo dados do form
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $telefone = addslashes($_POST['telefone']);
    $familiares = addslashes($_POST['familiares']);
    $menores = addslashes($_POST['menores']);
    $casaApe = addslashes($_POST['casaApe']);
    $alimentacao = addslashes($_POST['alimentacao']);
    $janelas = addslashes($_POST['janelas']);
    $rua = addslashes($_POST['rua']);
    $castracao = addslashes($_POST['castracao']);
    $cuidados = addslashes($_POST['cuidados']);
    $cienteAdocao = addslashes($_POST['cienteAdocao']);
    $tratamento = addslashes($_POST['tratamento']);
    $link = addslashes($_POST['link']);
    $autorizacao = addslashes($_POST['autorizacao']);

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
            formulario_alimentacao, 
            formulario_janelas, 
            formulario_rua, 
            formulario_castracao, 
            formulario_cuidados,
            formulario_cienteAdocao,
            formulario_tratamento,
            formulario_link,
            formulario_autorizacao,
            formulario_data)
        VALUES (
            '$nome', 
            '$email', 
            '$telefone', 
            '$familiares', 
            '$menores', 
            '$casaApe', 
            '$endereco',
            '$alimentacao', 
            '$janelas', 
            '$rua', 
            '$castracao', 
            '$cuidados',
            '$cienteAdocao',
            '$tratamento',
            '$link',
            '$autorizacao',
            'now()')";
    
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;    
    
?>