<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <!-- Incluindo estilos da navbar -->
    <?php include("includes/navbar.php"); ?>
</head>

<body>

    <br><br><br><br><br>

    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Crie uma conta nova</h1>
                <p class="col-lg-10 fs-4">Estamos felizes que você decidiu se juntar à nossa comunidade!</p>
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                <?php
                if (isset($_SESSION["error"])) {
                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION["error"] . '</div>';

                    unset($_SESSION["error"]);
                }
                ?>
                <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary text-dark" name="formRegister" method="POST" action="php/cadastrar_php.php" onsubmit="entrar(); return false;">

                    <div class="mb-3">
                        <label for="floatingInput">Nome</label>
                        <input type="txt" class="form-control" id="floatingInput" placeholder="Nome do usuario" name="txtNome" autocomplete="off" pattern="^[a-zA-ZÀ-ÿ]+(?: [a-zA-ZÀ-ÿ]+)*$" title="Digite um nome válido" required>
                    </div>

                    <div class="mb-3">
                        <label for="floatingInput">Email</label>
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="txtEmail" autocomplete="off" pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" title="Digite um email válido" required>
                    </div>

                    <div class="mb-3">
                        <label for="floatingPassword">Senha</label>
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Senha" name="txtSenha" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="A senha deve conter pelo menos 8 caracteres, incluindo pelo menos um número, uma letra minúscula e uma letra maiúscula" required>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit" name="cadastrar">Criar conta</button>
                    <hr class="my-4">
                    <a href="login.php" class="text-body-secondary">ou Entre como cliente já cadastrado</a>
                </form>
            </div>
        </div>
    </div>