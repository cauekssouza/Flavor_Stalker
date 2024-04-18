<?php
require 'Cad_restaurante_con.php'; // Inclui a conexão com o banco de dados

// Verifica se o parâmetro id foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta o restaurante com o ID fornecido
    $sql = "SELECT * FROM restaurantes WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome = $row['nome'];
        $endereco = $row['endereco'];
        $dono = $row['dono'];
        $telefone = $row['telefone'];
        $estilo_culinario = $row['estilo_culinario'];
        $descricao = $row['descricao'];
        $horario = $row['horario'];
        $capacidade = $row['capacidade'];
    } else {
        echo "Restaurante não encontrado.";
        exit;
    }
}

// Atualiza os dados do restaurante
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $dono = $_POST['dono'];
    $telefone = $_POST['telefone'];
    $estilo_culinario = $_POST['estilo_culinario'];
    $descricao = $_POST['descricao'];
    $horario = $_POST['horario'];
    $capacidade = $_POST['capacidade'];

    $sql = "UPDATE restaurantes SET nome='$nome', endereco='$endereco', dono='$dono', telefone='$telefone', estilo_culinario='$estilo_culinario', descricao='$descricao', horario='$horario', capacidade=$capacidade WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Restaurante atualizado com sucesso.";
        header("Location: index.php");
    } else {
        echo "Erro ao atualizar o restaurante: " . $conn->error;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>