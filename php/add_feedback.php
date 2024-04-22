<?php
session_start();
include ("../Conexão.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_restaurante = $_POST['id_restaurante'];
    $comentario = $_POST['comentario'];
    $id_user = $_SESSION['id_user'];

    $sql = "INSERT INTO avaliacao (id_user, id_restaurante, comentario) VALUES ($id_user, $id_restaurante, '$comentario')";
    if (mysqli_query($conn, $sql)) {
        echo "Comentário adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar comentário: " . mysqli_error($conn);
    }
}


header("Location: ../restaurante.php?id=$id_restaurante");
?>
