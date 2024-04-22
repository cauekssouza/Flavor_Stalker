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

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/flexslider.css">

	<link rel="stylesheet" href="css/style.css">

	<script src="js/modernizr-2.6.2.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<body>

	<div class="fh5co-loader"></div>

	<div id="page">
		<nav class="fh5co-nav" role="navigation">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-center logo-wrap">
						<div id="fh5co-logo"><a href="index.php">Flavour Hunter<span>.</span></a></div>
					</div>
					<div class="col-xs-12 text-center menu-1 menu-wrap">
						<ul>
							<?php $currentPage = basename($_SERVER['SCRIPT_NAME']); ?> <!-- pega o nome do arquivo atual -->
							<!-- analisa qual é a página atual e adiciona a classe active -->
							<li <?php if ($currentPage === 'index.php') : ?>class="active" <?php endif; ?>>
								<a href="index.php">Home</a>
							</li>
							<li <?php if ($currentPage === 'restaurantes.php') : ?>class="active" <?php endif; ?>>
								<a href="restaurantes.php">Restaurantes</a>
							</li>
							<li <?php if ($currentPage === 'about.php') : ?>class="active" <?php endif; ?>>
								<a href="about.php">About</a>
							</li>
							<li <?php if ($currentPage === 'contato.php') : ?>class="active" <?php endif; ?>>
								<a href="contato.php">Contato</a>
							</li>
							<?php
							session_start();
							if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {  // se o usuário estiver logado adiciona o botão de perfil
								$user = $_SESSION['email'];
							?>

								<li>
									<a href="users.php">
										<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
											<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
											<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
										</svg>
										Perfil
									</a>
								</li>

					</div>

				<?php } else { ?> <!-- se o usuário não estiver logado adiciona o botão para Entrar -->
					<li class="btn btn-primary"><a href="login.php">Entrar</a></li>
				<?php } ?>

				</ul>
				</div>
			</div>

	</div>
	</nav>