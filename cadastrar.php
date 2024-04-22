<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/cadastro.css">
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="first-content">
                <div class="first-colunn">
                    <h2 class="tittle"><i class="fa-solid fa-right-to-bracket"></i>Cadastro</h2>
                    <i class="fa-solid fa-heart"></i>
                    <?php session_start();
                    if (isset($_SESSION["error"])) { // verifica se existe uma mensagem de erro
                        echo '
                            <div class="w3-panel w3-pale-red w3-border">
                                <p>'  . $_SESSION["error"] . '</p>
                            </div>
                        ';
                        unset($_SESSION["error"]);
                    }
                    ?>
                    <div class="form">
                        <form method="POST" id="cadastroForm" action="php/cadastrar_php.php" onsubmit="entrar(); return false;">
                            <input type="text" name="txtNome" id="nome" placeholder="Nome do Usuário" pattern="^[a-zA-ZÀ-ÿ]+(?: [a-zA-ZÀ-ÿ]+)*$" title="Digite um nome válido" required>
                            <input type="email" name="txtEmail" id="email" placeholder="Digite seu Email" pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" title="Digite um email válido" required>
                            <input type="password" name="txtSenha" id="senha" placeholder="Crie uma Senha" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="A senha deve conter pelo menos 8 caracteres, incluindo pelo menos um número, uma letra minúscula e uma letra maiúscula" required>
                            <button type="submit" id="idcadastrar" name="cadastrar">Cadastrar</button>
                        </form>
                    </div>
                    <button class="btn-primary" onclick="window.location.href='login.php'">Voltar</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    include("Conexão.php");
    ?>
</body>

</html>