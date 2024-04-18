<?php
require 'Cad_restaurante_con.php'; // Inclui a conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $dono = $_POST['dono'];
    $telefone = $_POST['telefone'];
    $estilo_culinario = $_POST['estilo_culinario'];
    $descricao = $_POST['descricao'];
    $horario = $_POST['horario'];
    $capacidade = $_POST['capacidade'];

    // Insere os dados no banco de dados
    $sql = "INSERT INTO restaurantes (nome, endereco, dono, telefone, estilo_culinario, descricao, horario, capacidade) VALUES ('$nome', '$endereco', '$dono', '$telefone', '$estilo_culinario', '$descricao', '$horario', $capacidade)";
    if ($conn->query($sql) === TRUE) {
        echo "Restaurante cadastrado com sucesso.";
        header("Location: index.php");
    } else {
        echo "Erro ao cadastrar o restaurante: " . $conn->error;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

