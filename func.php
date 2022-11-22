include_once ("banco.php");

function conectaBD() {
    try {
        $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conectado corretamente";
        } catch(PDOException $e) {
            echo "Falha na conexão: " . $e->getMessage();
            }
}
