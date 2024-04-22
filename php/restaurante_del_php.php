<?php include("../Conexão.php");

$id_restaurante = $_POST["id_restaurante"];

// exclui o restaurante do banco
$sql = "DELETE FROM restaurantes WHERE id_restaurante = '$id_restaurante'";
$result = $conn->query($sql);

if ($result === TRUE) {
    header("Location: ../restaurantes_list.php");
    exit();
} else {
?>

    <script>
        alert("falha");
    </script>

<?php
}
