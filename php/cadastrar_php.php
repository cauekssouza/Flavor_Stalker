<?php include("../Conexão.php");

session_start();

$nome = $_POST["txtNome"];
$email = $_POST["txtEmail"];
$senha = $_POST["txtSenha"];

$senha = password_hash($senha, PASSWORD_DEFAULT);

$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION["error"] = "Email já cadastrado.";
    header("Location: ../cadastrar.php");
    exit;
} else {
    $sql = "INSERT INTO usuarios (email, senha, nome_user)
            VALUES ('$email', '$senha', '$nome')";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        header("Location: ../login.php");
    } else {
?>
        <script>
            alert("falha");
        </script>

<?php
    }
}
?>