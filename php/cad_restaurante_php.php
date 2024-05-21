<?php
include("../Conexão.php");
session_start();

// verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // recebe os dados do formulário
    $nome               = $_POST['nome'];
    $endereco           = $_POST['endereco'];
    $dono               = $_POST['dono'];
    $telefone           = $_POST['telefone'];
    $estilo_culinario   = $_POST['estilo_culinario'];
    $descricao          = $_POST['descricao'];
    $horario            = $_POST['horario'];
    $capacidade         = $_POST['capacidade'];

    // verifica se o usuário está logado
    if (isset($_SESSION['id_user'])) {
        $id_user = $_SESSION['id_user'];

        // atualiza o tipo de usuário para "Dono de Restaurante" (ID 2)
        $sql_update_tipo = "UPDATE usuarios SET id_tipo = 2 WHERE id_user = $id_user AND id_tipo = 1";

        // Verificar se o usuário é admin (id_tipo = 3)
        if ($_SESSION['id_tipo'] == 1) { // Verifica se o usuário é do tipo 1 (cliente)
            if ($conn->query($sql_update_tipo) === TRUE) {
                $_SESSION['id_tipo'] = 2; // Atualiza o tipo de usuário na sessão
            }
        }
    } else {
        header("Location: ../login.php");
        exit; // encerra o script se o usuário não estiver logado
    }

    // Inclua o ID do usuário na consulta SQL
    $sql = "INSERT INTO restaurantes (id_proprietario, nome, endereco, dono, telefone, estilo_culinario, descricao, horario, capacidade)
            VALUES ('$id_user', '$nome', '$endereco', '$dono', '$telefone', '$estilo_culinario', '$descricao', '$horario', '$capacidade')";

    if ($conn->query($sql) === TRUE) {      // se o cadastro for bem sucedido
        header("Location: ../users.php");   // redireciona para a página do usuário
    } else {
        echo "Erro ao cadastrar restaurante: " . $conn->error;
    }
}
