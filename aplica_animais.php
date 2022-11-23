<?php
    header("Content-type: text/html; charset=utf-8");
    //header("Location: index.html");
    include_once("banco.php");
    //include_once("func.php");

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

    try {
        // Criando a conexao
        $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;    
    
?>