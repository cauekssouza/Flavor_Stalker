<?php include("../Conexão.php");

$nome = $_POST["txtNome"];
$email = $_POST["txtEmail"];
$senha = $_POST["txtSenha"];

$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo  "<script>alert('Email ja cadastrado);</script>";
    header("Location: ../cadastrar.php");
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