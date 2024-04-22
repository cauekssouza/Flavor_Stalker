<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>flavour Hunter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" />
    <meta name="keywords" />
    <meta name="author" />

    <meta property="og:title" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:description" content="" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:300,300i,400,400i,500,600i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">

    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/flexslider.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/style.css">

    <script src="js/modernizr-2.6.2.min.js"></script>

</head>

<body>

    <div class="fh5co-loader"></div>

    <?php
    include("Conexão.php");

    session_start();

    if (!isset($_SESSION['id_tipo']) || $_SESSION['id_tipo'] != 3) { // se o usuário não não for um administrador (ID 3), redireciona para a página de login
        header("Location: login.php");
        exit();
    }

    $sql = "SELECT id_user, nome_user, email, senha FROM usuarios";
    $result = $conn->query($sql);
    ?>

    <div class="container text-center mt-5 ">
        <nav class="navbar navbar-dark fixed-top">
            <a class="navbar-brand me-auto" href="users.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
                </svg></a>
        </nav>
        <h1 class="text-white">Usuários</h1>
        <table class="table table-hover border-dark table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Senha</th>
                    <th scope="col">Deletar</th>
                </tr>
            </thead>
            <tbody class="table-group-divider ">
                <?php
                if ($result->num_rows > 0) { // verifica se encontrou algum usuário
                    while ($row = $result->fetch_assoc()) { // percorre todos os usuários encontrados e exibe na tela
                        $id_user = $row['id_user'];
                ?>
                        <tr>
                            <th scope="row"><?php echo $id_user ?></th>
                            <td><img src="images/default_icon.png" class="rounded img-fluid" width="50"></td>
                            <td><?php echo $row['nome_user'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['senha'] ?></td>
                            <td>
                                <form action="php/users_del_php.php" method="post">
                                    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                                    <button type="submit" class="btn-close" aria-label="Close"></button>
                                </form>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    // se não houver usuários no banco de dados
                    echo "<tr><td colspan='5'>Nenhum usuário encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
















    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="icon-arrow-up22"></i></a>
    </div>


    <script src="js/jquery.min.js"></script>

    <script src="js/jquery.easing.1.3.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <script src="js/jquery.waypoints.min.js"></script>

    <script src="js/jquery.stellar.min.js"></script>

    <script src="js/jquery.flexslider-min.js"></script>

    <script src="js/main.js"></script>

</body>

</html>