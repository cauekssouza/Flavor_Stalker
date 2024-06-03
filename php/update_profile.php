<?php
session_start();
include("../Conexão.php");

if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];

    // Recebe os dados do formulário
    $novoNome = $_POST['nome_user'];
    $novoEmail = $_POST['email'];
    $novaSenha = $_POST['nova_senha'];
    $confirmacaoSenha = $_POST['confirmacao_senha'];

    // Validação da senha
    if (!empty($novaSenha)) { // Verifica se a nova senha não está vazia
        if ($novaSenha != $confirmacaoSenha) {
            $_SESSION['error'] = "As senhas não coincidem.";
            header("Location: ../users.php");
            exit();
        }

        // Codifica (faz o hash) da nova senha usando password_hash
        $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

        // Atualiza os dados no banco de dados (incluindo a senha)
        $sql = "UPDATE usuarios SET nome_user='$novoNome', email='$novoEmail', senha='$novaSenhaHash' WHERE id_user=$id_user";
    } else {
        // Atualiza os dados no banco de dados (sem atualizar a senha) - CORRIGIDO
        $sql = "UPDATE usuarios SET nome_user='$novoNome', email='$novoEmail' WHERE id_user=$id_user";
    }

    $result = $conn->query($sql);

    if ($result) {
        // Atualiza os dados na sessão
        $_SESSION['nome_user'] = $novoNome;
        $_SESSION['email'] = $novoEmail;

        header("Location: ../users.php");
        exit();
    } else {
        echo "Erro ao atualizar perfil: " . $conn->error;
    }
} else {
    echo "Acesso negado.";
}
