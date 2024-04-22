<?php include("../Conexão.php");

$id = $_POST["id_user"];

// exclui o usuário do banco
$sql = "DELETE FROM usuarios WHERE id_user = '$id'";
$result = $conn->query($sql);

if ($result === TRUE) {
    header("Location: ../users_list.php");
    exit();
} else {
?>

    <script>
        alert("falha");
    </script>

<?php
}
