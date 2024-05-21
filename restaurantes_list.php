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

    if (!isset($_SESSION['id_tipo']) || $_SESSION['id_tipo'] != 3) { // se o usuário não for um administrador (ID 3), redireciona para a página de login
        header("Location: login.php");
        exit();
    }

    $sql = "SELECT id_restaurante, nome, dono, foto_restaurante, descricao, estilo_culinario, id_proprietario FROM restaurantes WHERE status_restaurante_id_status = 2"; // 2 é o ID do status "Aguardando"
    $result = $conn->query($sql);
    ?>

    <div class="container text-center mt-5 ">
        <nav class="navbar navbar-dark fixed-top">
            <a class="navbar-brand me-auto" href="users.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
                </svg></a>
        </nav>
        <h1 class="text-white">Restaurantes</h1>
        <table class="table table-hover border-dark table-dark">

            <tbody class="table-group-divider ">
                <?php
                if ($result->num_rows > 0) { // verifica se encontrou algum restaurante
                    while ($row = $result->fetch_assoc()) { // percorre todos os restaurantes encontrados e exibe na tela
                        $id_restaurante = $row['id_restaurante'];
                ?>
                        <tr>
                            <div class="d-flex justify-content-center">
                                <div class="card mb-5 text-bg-dark" style="--bs-bg-opacity: .4; width: 600px;">
                                    <div class="card-header d-flex align-items-center justify-content-between" id="heading<?php echo $row["id_restaurante"]; ?>" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $row["id_restaurante"]; ?>" aria-expanded="true" aria-controls="collapse<?php echo $row["id_restaurante"]; ?>">
                                        <div class="d-flex align-items-center">
                                            <div class="col-md-4">
                                                <img src="uploads/<?php echo $row["foto_restaurante"]; ?>" class="img-fluid rounded-start" alt="Foto do Restaurante" style="max-width: 100%; max-height:100px;">
                                            </div>
                                            <div class="col-md-8">
                                                <h3 class="mb-1 card-title"><?php echo $row["nome"]; ?></h3>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <form name="formAprovar" method="POST" action="php/aprovar_restaurante.php">
                                                <input type="hidden" name="id_restaurante" value="<?php echo $row["id_restaurante"]; ?>">
                                                <button class="btn btn-success me-2 btn-sm">&#10004;</button>
                                            </form>
                                            <form name="formRejeitar" method="POST" action="php/rejeitar_restaurante.php">
                                                <input type="hidden" name="id_restaurante" value="<?php echo $row["id_restaurante"]; ?>">
                                                <button type="submit" name="rejeitar" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja rejeitar este restaurante?')">&#10006;</button>
                                            </form>
                                        </div>

                                    </div>

                                    <div id="collapse<?php echo $row["id_restaurante"]; ?>" class="collapse" aria-labelledby="heading<?php echo $row["id_restaurante"]; ?>" data-bs-parent="#accordion">
                                        <div class="card-body text-start">
                                            <small class="card-text"><span class="badge text-bg-secondary rounded-pill"><?php echo $row["estilo_culinario"]; ?></span></small>
                                            <p class="card-text mt-3"><?php echo $row["descricao"]; ?></p>
                                            <p class="card-text text-end">Dono: <span class="fw-bold"><?php echo $row["dono"]; ?></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </tr>
                <?php
                    }
                } else {
                    // se não houver restaurantes aguardando aprovação
                    echo "<tr><td colspan='4'>Nenhum restaurante aguardando aprovação</td></tr>";
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