<?php include("../Conexão.php");

session_start();

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $dono = $_POST['dono'];
    $telefone = $_POST['telefone'];
    $estilo_culinario = $_POST['estilo_culinario'];
    $descricao = $_POST['descricao'];
    $horario = $_POST['horario'];
    $capacidade = $_POST['capacidade'];

    $sql = "INSERT INTO restaurantes (nome, endereco, dono, telefone, estilo_culinario, descricao, horario, capacidade)
            VALUES ('$nome', '$endereco', '$dono', '$telefone', '$estilo_culinario', '$descricao', '$horario', '$capacidade')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../users.php");
    } else {
        echo "Erro ao cadastrar restaurante: " . $conn->error;
    }
}
