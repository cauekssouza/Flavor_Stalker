<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flavour_Stalker</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="first-content">
                <div class="first-colunn">
                    <h2 class="tittle"><i class="fas fa-right-to-bracket icon-modify"></i>Login</h2>
                    <?php session_start();
                    if (isset($_SESSION["error"])) {
                        echo '
                            <div class="w3-panel w3-pale-red w3-border">
                                <p>'  . $_SESSION["error"] . '</p>
                            </div>
                        ';
                        unset($_SESSION["error"]);
                    }
                    ?>

                    <form method="POST" name="formLogin" action="php/login_php.php" class="form">

                        <div class="label-input">
                            <i class="fas fa-user icon-modify"></i>
                            <input name="txtEmail" type="text" placeholder="Email">
                        </div>

                        <div class="label-input">
                            <i class="fas fa-lock icon-modify"></i>
                            <input name="txtSenha" type="password" id="senha" placeholder="Senha">
                        </div>

                        <input type="submit" value="Entrar" class="btn">
                    </form>
                    

                    <div class="social-media">
                        <div class="btn">
                            <a href="senha.php" class="btn-primary">Esqueci Minha Senha</a>
                        </div>
                        <div class="btn">
                            <a href="cadastrar.php" class="btn-primary">Cadastre-se</a>
                        </div>
                        <div class="btn">
                        <button class="btn-primary" onclick="window.location.href='index.php'">Voltar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include("Conexão.php");
        ?>
</body>

</html>
