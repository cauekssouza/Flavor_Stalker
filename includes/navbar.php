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

	<link rel="stylesheet" href="css/style.css">

	<script src="js/modernizr-2.6.2.min.js"></script>

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
							<li class="btn btn-primary"><a href="login.php">Entrar</a></li>
						</ul>
					</div>
				</div>

			</div>
		</nav>