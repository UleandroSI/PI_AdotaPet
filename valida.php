<?php
    session_start(); 
    //Incluindo a conexão com banco de dados   
    include_once("conexao.php");    
    
    //O campo usuário e senha preenchido entra no if para validar
    if((isset($_POST['email'])) && (isset($_POST['senha']))){
        $usuario = mysqli_real_escape_string($conn, $_POST['email']); //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
        $senha = mysqli_real_escape_string($conn, $_POST['senha']);
        //$senha = md5($senha);

        //Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
        $sql = "SELECT * FROM usuarios WHERE usuarios_email = '$usuario' && usuarios_hash = md5('.$senha.') && usuarios_ativo = 1 LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $resultado = mysqli_fetch_assoc($result);

        if(empty($resultado)){
            $_SESSION['loginErro'] = 'Usuario ou senha inválido.';
            header("Location: login.php");
        //Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
        }elseif(isset($resultado)){
            $_SESSION['usuarios_id'] = $resultado['usuarios_id'];
            $_SESSION['usuarios_nome'] = $resultado['usuarios_nome'];
            $_SESSION['usuarios_ativo'] = $resultado['usuarios_ativo'];
            $_SESSION['usuarios_email'] = $resultado['usuarios_email'];
            $_SESSION['usuarios_hash'] = $resultado['usuarios_hash'];
            if($_SESSION['usuarios_ativo'] == 1){
                header("Location: restrito.php");
            }else{
                header("Location: login.php");
            }
        //Não foi encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
        }else{
            //redireciona o usuario para a página de login
            $_SESSION['loginErro'] = 'Usuario ou senha inválido.';
            header("Location: login.php");
        }
        $conn->close();
}
?>