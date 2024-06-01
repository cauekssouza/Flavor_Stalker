<?php
include("../Conexão.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_restaurante = $_POST['id_restaurante'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $horario = $_POST['horario'];
    $capacidade = $_POST['capacidade'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $estilo_culinario = $_POST['estilo_culinario'];

    // Verifica se uma nova imagem foi enviada
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
            $foto_restaurante = basename($_FILES["imagem"]["name"]);
            $sqlUpdate = "UPDATE restaurantes SET nome='$nome', descricao='$descricao', horario='$horario', capacidade='$capacidade', endereco='$endereco', telefone='$telefone', estilo_culinario='$estilo_culinario', foto_restaurante='$foto_restaurante' WHERE id_restaurante=$id_restaurante";
        } else {
            echo "Erro ao fazer upload da imagem.";
            exit;
        }
    } else {
        $sqlUpdate = "UPDATE restaurantes SET nome='$nome', descricao='$descricao', horario='$horario', capacidade='$capacidade', endereco='$endereco', telefone='$telefone', estilo_culinario='$estilo_culinario' WHERE id_restaurante=$id_restaurante";
    }

    if ($conn->query($sqlUpdate) === TRUE) {
        // Atualizar os pratos
        if (isset($_POST['pratos'])) {
            foreach ($_POST['pratos'] as $prato) {
                $id_prato = $prato['id_prato'];
                $nome_prato = $conn->real_escape_string($prato['nome']);
                $ingredientes = $conn->real_escape_string($prato['ingredientes']);
                $preco = $conn->real_escape_string($prato['preco']);

                if ($id_prato == 0) {
                    // Novo prato
                    $sqlInsertPrato = "INSERT INTO prato (id_restaurante, nome, ingredientes, preco) VALUES ($id_restaurante, '$nome_prato', '$ingredientes', '$preco')";
                    $conn->query($sqlInsertPrato);
                } else {
                    // Atualizar prato existente
                    $sqlUpdatePrato = "UPDATE prato SET nome='$nome_prato', ingredientes='$ingredientes', preco='$preco' WHERE id_prato=$id_prato";
                    $conn->query($sqlUpdatePrato);
                }
            }
        }

        // Remover os pratos marcados para remoção
        if (isset($_POST['remover_pratos']) && !empty($_POST['remover_pratos'])) {
            $remover_pratos = json_decode($_POST['remover_pratos'], true);
            foreach ($remover_pratos as $id_prato) {
                $sqlDeletePrato = "DELETE FROM prato WHERE id_prato=$id_prato";
                $conn->query($sqlDeletePrato);
            }
        }

        // Redireciona para a página do restaurante após a atualização
        header("Location: ../restaurante.php?id=$id_restaurante");
        exit();
    } else {
        echo "Erro ao atualizar restaurante: " . $conn->error;
    }

    if (isset($_POST['remover_imagem'])) {
        $sqlRemoveImagem = "UPDATE restaurantes SET foto_restaurante='' WHERE id_restaurante=$id_restaurante";
        $conn->query($sqlRemoveImagem);
    }
} else {
    echo "Método de requisição inválido.";
}
