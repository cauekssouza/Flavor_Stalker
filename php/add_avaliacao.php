<?php
include("../Conexão.php");
session_start();

if (isset($_POST['rating-value'])) {
    $rating = $_POST['rating-value'];
    $idRestaurante = $_POST['id_restaurante'];
    $idUser = $_SESSION['id_user'];

    $sqlAvaliacao = "INSERT INTO nota (id_user, id_restaurante, id_nota)
    VALUES ($idUser, $idRestaurante, $rating)
    ON DUPLICATE KEY UPDATE id_nota = $rating;
    ";
    $conn->query($sqlAvaliacao);

    echo "Avaliação enviada com sucesso!";
}
