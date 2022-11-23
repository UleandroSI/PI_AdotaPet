include_once ("banco.php");

function conectaBD() {
    try {
        $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $resultado = "sim";
        } catch(PDOException $e) {
            $resultado = "falha";
            $conn = $e;
            }

    return $conn, $resultado;
}

function salvarUsuario(){
    $conn, $resultado = conectaBD();
    // Inserindo dados
    $sql = "INSERT INTO usuarios (
        usuarios_nome, 
        usuarios_email, 
        usuarios_hash,
        usuarios_ativo)
    VALUES (
    '$nome', 
    '$email', 
    '$senha', 
    '1')";
    
}