<?php include("../Conexão.php");

session_start();

$email = $_POST['txtEmail'];
$senha = $_POST['txtSenha'];

// verifica se os campos estão preenchidos
if(empty($email) || empty($senha)) {
    $_SESSION["error"] = "Preencha todos os campos!";
    header('Location: ../login.php');
    exit;
}

$sql = "SELECT id_user, id_tipo, nome_user, email, senha, data_criacao FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql);

// verifica se o email existe no banco
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        if(password_verify($senha, $row['senha'])){ // verifica se a senha está correta
            session_start();
            $_SESSION['id_user']        = $row['id_user'];
            $_SESSION['id_tipo']        = $row['id_tipo'];
            $_SESSION['email']          = $row['email'];
            $_SESSION['nome_user']      = $row['nome_user'];
            $_SESSION['nome_user']      = $row['nome_user'];
            $_SESSION['data_criacao']   = $row['data_criacao'];
            $_SESSION["loggedIn"]       = true;

            header("Location: ../index.php");
            exit();
        }
    }
}

session_start();
$_SESSION["error"] = "Email ou senha incorretos"; // cria uma mensagem de erro
header('Location: ../login.php');
?>