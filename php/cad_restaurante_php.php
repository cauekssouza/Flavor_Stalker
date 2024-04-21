<?php
include("../Conexão.php");
session_start();

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome                = $_POST['nome'];
    $endereco           = $_POST['endereco'];
    $dono               = $_POST['dono'];
    $telefone           = $_POST['telefone'];
    $estilo_culinario   = $_POST['estilo_culinario'];
    $descricao          = $_POST['descricao'];
    $horario            = $_POST['horario'];
    $capacidade         = $_POST['capacidade'];

    // Verifica se o usuário está logado
    if (isset($_SESSION['id_user'])) {
        $id_user = $_SESSION['id_user'];

        // Atualiza o tipo de usuário para "Dono de Restaurante" (ID 2)
        $sql_update_tipo = "UPDATE usuarios SET id_tipo = 2 WHERE id_user = $id_user";
        if ($conn->query($sql_update_tipo) === TRUE) {
            $_SESSION['id_tipo'] = 2;
        }
    } else {
        echo "Usuário não está logado.";
        exit; // Encerra o script se o usuário não estiver logado
    }

    $sql = "INSERT INTO restaurantes (nome, endereco, dono, telefone, estilo_culinario, descricao, horario, capacidade)
            VALUES ('$nome', '$endereco', '$dono', '$telefone', '$estilo_culinario', '$descricao', '$horario', '$capacidade')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../users.php");
    } else {
        echo "Erro ao cadastrar restaurante: " . $conn->error;
    }
}
?>

