<?php
include("../Conexão.php");
session_start();

if (isset($_POST['id_restaurante'])) {
    $id_restaurante = $_POST['id_restaurante'];

    // Exclui os pratos relacionados ao restaurante
    $sqlDeletePratos = "DELETE FROM prato WHERE id_restaurante = $id_restaurante";
    $conn->query($sqlDeletePratos);

    $sql = "DELETE FROM restaurantes WHERE id_restaurante = $id_restaurante";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['notificacao'] = "Restaurante rejeitado!";
        header("Location: ../restaurantes_list.php");
    } else {
        echo "Erro ao excluir restaurante: " . $conn->error;
    }
} else {
    echo "ID do restaurante não fornecido.";
}

$conn->close();
