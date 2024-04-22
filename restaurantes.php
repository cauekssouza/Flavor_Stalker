<?php include("includes/navbar.php"); ?>

<header id="fh5co-header" class="fh5co-cover js-fullheight" role="banner" style="background-image: url(images/hero_1.jpeg);" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="display-t js-fullheight">
					<div class="display-tc js-fullheight animate-box" data-animate-effect="fadeIn">
						<h1>Restaurantes</h1>
						<h2>Veja as opcoes de restaurantes em Curitiba!</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<div id="fh5co-featured-menu" class="fh5co-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 fh5co-heading animate-box">
				<h2>Restaurantes</h2>
				<div class="row">
					<div class="col-md-12">

						<?php
						include("Conexão.php");

						$sql = "SELECT id_restaurante, nome, endereco, descricao, estilo_culinario, foto_restaurante FROM restaurantes";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) { // verifica se encontrou algum restaurante
							while ($row = $result->fetch_assoc()) { // percorre todos os restaurantes encontrados e exibe na tela
						?>
								<div href="#" class="card mb-3 text-bg-dark " style="--bs-bg-opacity: .4;">
									<div class="row g-0">
										<div class="col-md-4">
											<img src="uploads/<?php echo $row["foto_restaurante"]; ?>" class="img-responsive img-fluid rounded-start" style="min-width: 300px; min-height:100px;">
										</div>
										<div class="col-md-8">
											<div class="card-body">
												<div class="d-flex w-100 justify-content-between">
													<h3 class="mb-1 card-title"><?php echo $row["nome"]; ?></h3>
													<small class="card-text"><span class="badge text-bg-secondary rounded-pill"><?php echo $row["estilo_culinario"]; ?></span></small>
												</div>
												<p class="card-text mt-3"><?php echo $row["descricao"]; ?></p>
												<a class="icon-link-hover" href="restaurante.php?id=<?php echo $row["id_restaurante"]; ?>" style="--bs-link-hover-color-rgb: 25, 135, 84;">
													Ver Mais
													<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
														<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
													</svg>
												</a>
											</div>
										</div>
									</div>
								</div>
						<?php
							}
						} else {
							echo "Não há restaurantes cadastrados.";
						}
						?>









					</div>
				</div>
			</div>







			<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-item-wrap">
				<div class="fh5co-item animate-box">
					<img src="images/gallery_1.jpeg" class="img-responsive">
					<h3></h3>
					<p></p>
				</div>
				<div class="fh5co-item animate-box">
					<img src="images/gallery_2.jpeg" class="img-responsive">
					<h3></h3>
					<p></p>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-item-wrap">
				<div class="fh5co-item margin_top animate-box">
					<img src="images/gallery_3.jpeg" class="img-responsive">
					<h3></h3>
					<p></p>
				</div>
				<div class="fh5co-item animate-box">
					<img src="images/gallery_4.jpeg" class="img-responsive">
					<h3></h3>
					<p></p>
				</div>
			</div>
			<div class="clearfix visible-sm-block visible-xs-block"></div>
			<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-item-wrap">
				<div class="fh5co-item animate-box">
					<img src="images/gallery_5.jpeg" class="img-responsive">
					<h3></h3>
					<p></p>
				</div>
				<div class="fh5co-item animate-box">
					<img src="images/gallery_6.jpeg">
					<h3></h3>
					<p></p>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-item-wrap">
				<div class="fh5co-item margin_top animate-box">
					<img src="images/gallery_7.jpeg" class="img-responsive">
					<h3></h3>
					<p></p>
				</div>
				<div class="fh5co-item animate-box">
					<img src="images/gallery_8.jpeg" class="img-responsive">
					<h3></h3>
					<p></p>
				</div>
			</div>
		</div>


		<div class="row">
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis atque magnam, officiis aspernatur perferendis commodi minus debitis velit fugiat neque, enim veniam assumenda rem beatae sed laborum. Natus, unde porro.</p>
		</div>


	</div>
</div>



<div id="fh5co-started" class="fh5co-section animate-box" style="background-image: url(images/hero_1.jpeg);" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row animate-box">
			<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
				<h2>Sobre nos</h2>
				<p>Somos a equipe 11 de experiemcia criativa, com posta por:
					Caue, Joao Pedro, Kael, Lucas Rodrigues e Lucas Zacarias.
				</p>
				<p><a href="contato.php" class="btn btn-primary btn-outline">Contato</a></p>
			</div>
		</div>
	</div>
</div>

<?php include("includes/footer.php"); ?>