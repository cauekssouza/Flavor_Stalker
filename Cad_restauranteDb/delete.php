<?php
require 'Cad_restaurante_con.php'; // Inclui a conexão com o banco de dados

// Verifica se o parâmetro id foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Deleta o restaurante com o ID fornecido
    $sql = "DELETE FROM restaurantes WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Restaurante excluído com sucesso.";
        header("Location: index.php");
    } else {
        echo "Erro ao excluir o restaurante: " . $conn->error;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
