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

    <div id="page">
        <div class="container text-center mt-5">


            <nav class="navbar navbar-dark fixed-top">
                <a class="navbar-brand me-auto" href="restaurantes.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
                    </svg></a>
            </nav>





            <?php
            session_start();

            if (isset($_SESSION['id_user'])) {  // se o usuário estiver logado
                $id_user = $_SESSION['id_user'];
                $id_tipo = $_SESSION['id_tipo'];
                $nome_user = $_SESSION['nome_user'];
                $email = $_SESSION['email'];
                $data_criacao = $_SESSION['data_criacao'];
            } else {
                header("Location: login.php");
                exit();
            }
            ?>

            <div class="row gx-5">
                <div class="border border-dark rounded m-5 bg-dark  col-md-3 col-lg-3" style="--bs-bg-opacity: .5;">
                    <img src="images/default_icon.png" class="rounded-circle img-fluid p-3" width="150" height="150">
                    <p class=""><?php echo $nome_user ?></p>
                    <p class=""> Data de criação: <?php echo date('d/m/Y', strtotime($data_criacao)); ?> </p> <!-- strtotime converte a data para o formato brasileiro -->

                    <?php
                    // verifica o tipo de usuário e exibe o texto correspondente
                    if ($_SESSION['id_tipo'] == 2) {
                        echo "<p class=''>Dono de Restaurante</p>";
                    } elseif ($_SESSION['id_tipo'] == 3) {
                        echo "<p class=''>Admin</p>";
                    }
                    ?>

                    <div class="d-grid gap-2 btn-sm">
                        <button class=" btn btn-primary">Editar perfil</button>
                        <a href="cad_restaurante.php" class=" btn btn-primary">Criar Restaurante</a>
                        <?php

                        // verifica se o usuário está logado
                        if (isset($_SESSION['id_user'])) {
                            // verifica se o tipo de usuário é administrador
                            if ($_SESSION['id_tipo'] == 3) {
                                // se for administrador, exibe os botões
                        ?>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="users_list.php" class="btn btn-primary">Usuários</a>
                                    <a href="restaurantes_list.php" class="btn btn-primary">Restaurantes</a>
                                </div>
                        <?php
                            }
                        }
                        ?>
                        <a href="php/logout_php.php" class="btn btn-outline-danger ">Sair <span class="fs-5">(<?php echo $email ?>)</span></a>

                    </div>
                </div>
                <?php

                include("Conexão.php");


                // Consulta os feedbacks do usuário atualmente logado
                $sql = "SELECT comentario, data_comentario FROM avaliacao WHERE id_user = $id_user ORDER BY data_comentario DESC";
                $result = $conn->query($sql);

                // Verifica se há feedbacks
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                ?>
                        <div class="border border-dark rounded col col-md-8 col-lg-8">
                            <p class="border-bottom border-dark">Feedback</p>
                            <div class="row border-bottom border-dark text-white">
                                <p> <?php echo $row['comentario'] ?> </p>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="border border-dark rounded col col-md-8 col-lg-8">
                        <p class="border-bottom border-dark"> Nenhum feedback feito</p>
                        
                    </div>
                <?php
                }

                $conn->close();
                ?>

            </div>









        </div>
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