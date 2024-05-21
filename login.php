
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Incluindo estilos da navbar -->
    <?php include("includes/navbar.php"); ?>
</head>
<body>
    <!-- Conteúdo da página -->
    <br><br><br><br><br>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">Entre como cliente já cadastrado</h1>
                <p class="col-lg-10 fs-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam deserunt quas optio voluptatum nobis pariatur, est amet, adipisci perspiciatis sapiente nihil excepturi numquam laborum repellat alias corporis ea veritatis quisquam?</p>
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
            <?php
                if(isset($_SESSION["error"])) {
                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION["error"] . '</div>';
                    unset($_SESSION["error"]);
                }
            ?>
                <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary text-dark" name="formLogin" method="POST" action="php/login_php.php">
                    <div class="mb-3">
                        <label for="floatingInput" class="form-label">Email</label>
                        <input type="email" class="form-control form-control-lg" id="floatingInput" placeholder="name@example.com" name="txtEmail"  autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="floatingPassword" class="form-label">Senha</label>
                        <input type="password" class="form-control form-control-lg" id="floatingPassword" placeholder="Password" name="txtSenha">
                    </div>
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me" name="chkRemember"> Remember me
                        </label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
                    <hr class="my-4">
                    <a href="cadastrar.php" class="text-body-secondary">Crie uma conta nova</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
