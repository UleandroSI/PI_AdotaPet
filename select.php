<?php
//Incluindo a conexão com banco de dados   
include_once("conexao.php");  
	//Inicializado primeira a sessão para posteriormente recuperar valores das variáveis globais. 
    session_start();


echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Nome</th><th>Nome</th></tr>";

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}

$servername = "localhost";
$username = "ti";
$password = "senha";
$dbname = "bd1";

$email = 'admin@adotapet.com';
$senha = 'admin';

try {
  $conexao = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conexao->prepare("SELECT animais_id, animais_nome, animais_img, FROM animais WHERE animais_ativo = 1");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conexao = null;
echo "</table>";

?>