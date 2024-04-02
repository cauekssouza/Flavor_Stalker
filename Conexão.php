<?php
// Banco de Dados
$servidor = "localhost:3307"; // seu servidor MySQL
$usuario = "root"; // seu usuário MySQL
$senha = "2204ckss"; // sua senha MySQL
$banco = "cadastro"; // seu banco de dados

// Conexão com o banco de dados
$conn = mysqli_connect($servidor, $usuario, $senha, $banco);

// Verifica se a conexão foi bem sucedida
if (mysqli_connect_errno()) {
    echo "Falha ao conectar ao MySQL: " . mysqli_connect_error();
    exit();
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos foram preenchidos
    if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])) {
        // Obtém os valores do formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Prepara a consulta SQL para inserir os dados
        $sql = "INSERT INTO cadastro (Nome, Email, Senha) VALUES ('$nome', '$email', '$senha')";

        // Executa a consulta SQL
        if (mysqli_query($conn, $sql)) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro ao cadastrar: " . mysqli_error($conn);
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.";
    }
}

// Fechar conexão com o banco de dados
mysqli_close($conn);
?>
