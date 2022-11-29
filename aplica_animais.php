<?php
    header("Content-type: text/html; charset=utf-8");
    include_once("conexao.php");

    // Recebendo dados do form
    $nome = addslashes($_POST['nome']);
    $especie = addslashes($_POST['especie']);
    $sexo = addslashes($_POST['sexo']);
    $castrado = addslashes($_POST['castrado']);
    $vacinado = addslashes($_POST['vacinado']);
    $fiv = addslashes($_POST['fiv']);
    $felv = addslashes($_POST['felv']);
    $foto = addslashes($_POST['foto']);
    $status = addslashes($_POST['status']);
    $endereco = addslashes($_POST['endereco']);
    $responsavel = addslashes($_POST['responsavel']);
    $contato = addslashes($_POST['contato']);

    // Inserindo dados
    $sql = "INSERT INTO animais (
        animais_nome, 
        animais_especie,
        animais_sexo,
        animais_castrado,
        animais_vacina, 
        animais_fiv, 
        animais_felv,
        animais_img,
        animais_status,
        animais_lar, 
        animais_nomeResponsavel,
        animais_contatoResponsavel,
        animais_ativo)
    VALUES (
        '$nome', 
        '$especie', 
        '$sexo', 
        '$castrado', 
        '$vacinado', 
        '$fiv', 
        '$felv',
        '$foto', 
        '$status', 
        '$endereco', 
        '$responsavel', 
        '$contato',
        '1')";
    
    // Executa comando SQL
    $result = mysqli_query($conn, $sql);

    //echo "New record created successfully";
    header("Location: animais.html");

    // Fecha conexão
    $conn->close();
    
?>