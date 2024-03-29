<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="cadastro.css">
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="first-content">
                <div class="first-colunn">
                    <h2 class="tittle"><i class="fa-solid fa-right-to-bracket"></i>Cadastro</h2>
                    <i class="fa-solid fa-heart"></i>
                    <div class="form">
                        <form method="post" id="cadastroForm">
                            <input type="text" name="nome" id="nome" placeholder="Nome do Usuário" pattern="^[a-zA-ZÀ-ÿ]+(?: [a-zA-ZÀ-ÿ]+)*$" title="Digite um nome válido" required>
                            <input type="email" name="email" id="email" placeholder="Digite seu Email" pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" title="Digite um email válido" required>
                            <input type="password" name="senha" id="senha" placeholder="Crie uma Senha" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="A senha deve conter pelo menos 8 caracteres, incluindo pelo menos um número, uma letra minúscula e uma letra maiúscula" required>
                            <button type="submit" id="idcadastrar" name="cadastrar">Cadastrar</button>
                        </form>
                    </div>
                    <button class="btn-primary" onclick="window.location.href='login.php'">Voltar</button>
                </div>
            </div>
        </div>
</div>
<script src="cad.js"></script>

<?php
include("Conexão.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verificar se o email já está cadastrado
    $sql_verificar_email = "SELECT * FROM cadastro WHERE Email = ?";
    $stmt_verificar_email = $conn->prepare($sql_verificar_email);
    $stmt_verificar_email->bind_param("s", $email);
    $stmt_verificar_email->execute();
    $result_verificar_email = $stmt_verificar_email->get_result();

    // Verificar se o nome já está cadastrado
    $sql_verificar_nome = "SELECT * FROM cadastro WHERE Nome = ?";
    $stmt_verificar_nome = $conn->prepare($sql_verificar_nome);
    $stmt_verificar_nome->bind_param("s", $nome);
    $stmt_verificar_nome->execute();
    $result_verificar_nome = $stmt_verificar_nome->get_result();

    // Verificar se a senha já está cadastrada (não é uma prática comum, mas é possível se necessário)
    $sql_verificar_senha = "SELECT * FROM cadastro WHERE Senha = ?";
    $stmt_verificar_senha = $conn->prepare($sql_verificar_senha);
    $stmt_verificar_senha->bind_param("s", $senha);
    $stmt_verificar_senha->execute();
    $result_verificar_senha = $stmt_verificar_senha->get_result();

    if ($result_verificar_email->num_rows > 0 || $result_verificar_nome->num_rows > 0 || $result_verificar_senha->num_rows > 0) {
        echo "Estes dados já estão registrados.";
    } else {
        $sql_inserir = "INSERT INTO cadastro (Nome, Email, Senha) VALUES (?, ?, ?)";
        $stmt_inserir = $conn->prepare($sql_inserir);
        $stmt_inserir->bind_param("sss", $nome, $email, $senha);

        if ($stmt_inserir->execute()) {
            echo "Cadastro realizado com sucesso!";
            header("Location: home.html"); // Redirecionar para homem.html após o cadastro
            exit;
        } else {
            echo "Erro ao cadastrar: " . $stmt_inserir->error;
        }
    }
} else {
    echo "Ocorreu um erro ao processar o formulário.";
}

$conn->close();
?>
</body>
</html>


