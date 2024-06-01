<?php
include("../Conexão.php");

if (isset($_GET['id'])) {
    $id_restaurante = $_GET['id'];

    // Deletar todas as avaliações associadas ao restaurante
    $sqlDeleteAvaliacoes = "DELETE FROM avaliacao WHERE id_restaurante = $id_restaurante";
    if ($conn->query($sqlDeleteAvaliacoes) === TRUE) {
        // Deletar todas as notas associadas ao restaurante
        $sqlDeleteNotas = "DELETE FROM nota WHERE id_restaurante = $id_restaurante";
        if ($conn->query($sqlDeleteNotas) === TRUE) {
            // Deletar todos os pratos associados ao restaurante
            $sqlDeletePratos = "DELETE FROM prato WHERE id_restaurante = $id_restaurante";
            if ($conn->query($sqlDeletePratos) === TRUE) {
                // Deletar o restaurante
                $sqlDeleteRestaurante = "DELETE FROM restaurantes WHERE id_restaurante = $id_restaurante";
                if ($conn->query($sqlDeleteRestaurante) === TRUE) {
                    echo "Restaurante deletado com sucesso!";
                } else {
                    echo "Erro ao deletar restaurante: " . $conn->error;
                }
            } else {
                echo "Erro ao deletar pratos do restaurante: " . $conn->error;
            }
        } else {
            echo "Erro ao deletar notas do restaurante: " . $conn->error;
        }
    } else {
        echo "Erro ao deletar avaliações do restaurante: " . $conn->error;
    }

    // Redireciona para a página principal após a exclusão
    header("Location: ../restaurantes.php");
    exit();
} else {
    echo "ID do restaurante não fornecido.";
}
?>
