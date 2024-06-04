<?php
include("../Conexão.php");
session_start();

if (isset($_POST['id_restaurante'])) {
    $id_restaurante = $_POST['id_restaurante'];

    $sql = "UPDATE restaurantes SET status_restaurante_id_status = 1 WHERE id_restaurante = $id_restaurante";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['notificacao'] = "Restaurante Aprovado!";
        header("Location: ../restaurantes_list.php");
    } else {
        echo "Erro ao atualizar restaurante: " . $conn->error;
    }
} else {
    echo "ID do restaurante não fornecido.";
}

$conn->close();
