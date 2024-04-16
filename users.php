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


            <?php
            session_start();

            if (isset($_SESSION['id_user'])) {  // se o usuário estiver logado
                $id_user = $_SESSION['id_user'];
                $nome_user = $_SESSION['nome_user'];
            } else {
                header("Location: login.php");
                exit();
            }
            ?>
            <div class="row gx-5">
                <div class="border border-dark rounded m-5 bg-dark col-md-3 col-lg-3" style="--bs-bg-opacity: .5;">
                    <img src="images/default_icon.png" class="rounded-circle img-fluid p-3" width="150" height="150">
                    <p class=""><?php echo $nome_user ?></p>
                    <p class=""> Data criação: </p>
                    <p class=""> Dono de restaurante </p>
                    <div class="d-grid gap-2 btn-sm">
                        <!-- Button trigger modal -->
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Launch demo modal
                        </button>


                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                            </div>
                        </div>
                        </div> -->
                        <!-- <button class=" btn btn-primary">Favoritos</button> -->
                        <button class=" btn btn-primary">Editar perfil</button>
                        <a class="btn btn-primary" href="php/logout_php.php">Sair</a>
                    </div>
                </div>
                <div class="border border-dark rounded col col-md-8 col-lg-8">
                    <p class="border-bottom border-dark">Feedback</p>

                    <div class="row border">IIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII</div>
                    <div class="row border">IIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII</div>
                    <div class="row border">IIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII</div>
                </div>
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