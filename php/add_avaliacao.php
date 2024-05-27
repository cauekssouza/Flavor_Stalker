<?php
include("../Conexão.php");
session_start();

if (isset($_POST['rating-value']) && isset($_POST['comentario'])) {
    $rating = $_POST['rating-value'];
    $id_restaurante = $_POST['id_restaurante'];
    $id_user = $_SESSION['id_user'];
    $comentario = $_POST['comentario'];

    // 1. Inserir avaliação na tabela avaliacao
    $sqlAvaliacao = "INSERT INTO avaliacao (id_user, id_restaurante, comentario) VALUES ($id_user, $id_restaurante, '$comentario')";
    $conn->query($sqlAvaliacao);
    $idAvaliacao = $conn->insert_id; // Obter o ID da avaliação inserida

    // 2. Inserir nota na tabela nota
    $sqlNota = "INSERT INTO nota (id_user, id_restaurante, id_nota) VALUES ($id_user, $id_restaurante, $rating) ON DUPLICATE KEY UPDATE id_nota = $rating";
    $conn->query($sqlNota);

    echo "Avaliação e comentário enviados com sucesso!";

    header("Location: ../restaurante.php?id=$id_restaurante");
}
?>
