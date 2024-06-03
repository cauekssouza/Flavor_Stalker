<?php include("includes/navbar.php"); ?>

<style>
	input,
	textarea,
	option,
	select {
		font-family: 'Cormorant Garamond', serif;
	}

	.fonte-normal {
		font-family: Arial, Helvetica, sans-serif;
		/* ou outra fonte sem serifa */
	}
</style>

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
						<i class="bi bi-filter"></i>Filtrar

						<form method="GET" action="" class="mb-5">
							<div class="row">
								<div class="col-md-4">
									<label for="estilo_culinario">Estilo Culinário:</label>
									<select name="estilo_culinario" id="estilo_culinario" class="form-control">
										<option value="">Todos</option>
										<option value="italiana">Italiana</option>
										<option value="japonesa">Japonesa</option>
										<option value="brasileira">Brasileira</option>
										<option value="chinesa">Chinesa</option>
										<option value="mexicana">Mexicana</option>
										<option value="indiana">Indiana</option>
										<option value="tailandesa">Tailandesa</option>
										<option value="francesa">Francesa</option>
										<option value="mediterranea">Mediterrânea</option>
										<option value="arabe">Árabe</option>
									</select>
								</div>
								<div class="col-md-4">
									<label for="ordem">Ordenar por:</label>
									<select name="ordem" id="ordem" class="form-control">
										<option value="nome">Nome</option>
										<option value="nota">Nota</option>
									</select>
								</div>
								<div class="col-md-4">
									<label>&nbsp;</label>
									<button type="submit" class="btn btn-primary btn-block">Filtrar</button>
								</div>
							</div>
						</form>



						<?php
						include("Conexão.php");

						$estilo_culinario = isset($_GET['estilo_culinario']) ? $_GET['estilo_culinario'] : '';
						$ordem = isset($_GET['ordem']) ? $_GET['ordem'] : 'nome';

						$sql = "SELECT id_restaurante, nome, endereco, descricao, estilo_culinario, foto_restaurante
								FROM restaurantes
								WHERE status_restaurante_id_status = 1";

						if ($estilo_culinario != '') {
							$sql .= " AND estilo_culinario = '$estilo_culinario'";
						}

						if ($ordem == 'nota') {
							$sql .= " ORDER BY (SELECT AVG(id_nota) FROM nota WHERE nota.id_restaurante = restaurantes.id_restaurante) DESC";
						} else {
							$sql .= " ORDER BY nome";
						}

						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
						?>
								<div href="#" class="card mb-3 text-bg-dark " style="--bs-bg-opacity: .4;">
									<div class="row g-0">
										<div class="col-md-4">
											<img src="uploads/<?php echo $row["foto_restaurante"]; ?>" class="img-responsive img-fluid rounded-start" style="min-width: 300px; min-height:100px;">
										</div>
										<div class="col-md-8">
											<div class="card-body">
												<div class="d-flex w-100 justify-content-between">
													<div class="d-flex align-items-center">
														<h3 class="mb-1 card-title"><?php echo $row["nome"]; ?></h3>
														<small class="card-text ms-2">
															<?php
															// Consulta para obter a média de avaliações do restaurante (SEM prepared statement)
															$sqlMedia = "SELECT AVG(id_nota) AS media FROM nota WHERE id_restaurante = " . $row["id_restaurante"];
															$resultMedia = $conn->query($sqlMedia);

															if ($resultMedia->num_rows > 0) {
																$rowMedia = $resultMedia->fetch_assoc();
																$mediaAvaliacoes = number_format($rowMedia['media'], 1);
																echo "<span class='badge text-bg-warning rounded-pill ms-2 fs-4 fonte-normal'>&#9733; $mediaAvaliacoes</span>";
															}
															?>
														</small>
													</div>
													<small class="card-text"><span class="badge text-bg-secondary rounded-pill estilo"><?php echo $row["estilo_culinario"]; ?></span></small>
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