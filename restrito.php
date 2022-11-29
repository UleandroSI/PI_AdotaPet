<?php
    session_start();
    echo "Usuario: ". $_SESSION['usuarios_nome'];    
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Armazenar leituras feitas para consulta posterior.">
    <meta name="keywords" content="leitura, livro, livros, compreenção de texto, textos">
    <meta name="author" content="uLeandroSP">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="author" href="https://github.com/UleandroSI/Ficha-de-leitura">
    <link rel="license" href="MIT License">
    <link rel="icon" type="image/x-icon" href="Caminho da imagem .ico">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="script.js"></script>
    <title>Modelo</title>
</head>

<body>
  <main class="main">
    <!-- Header-->
    <header class="header">
      <h1>Ficha de Leitura para Textos Acadêmicos</h1>
      <h5 class="d-none d-print-block">Use o formulário para guardar tudo de mais importante que conseguiu colher da leitura.</h5>
    </header>

    <br>
    <a href="sair.php">Sair</a>

  </main>
</body>
</html>