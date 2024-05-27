<?php
include("includes/navbar.php");
include("Conexão.php");

if (isset($_GET['id'])) {
    $id_restaurante = $_GET['id'];

    $sql = "SELECT id_restaurante, id_proprietario, nome, endereco, dono, estilo_culinario, descricao, horario, capacidade, telefone, foto_restaurante
            FROM restaurantes
            WHERE id_restaurante = $id_restaurante";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imagem_existente = !empty($row["foto_restaurante"]);
    } else {
        echo "Restaurante não encontrado.";
        exit; // Encerra o script se o restaurante não existir
    }
    // Consulta SQL para os pratos do restaurante
    $sqlPratos = "SELECT nome, ingredientes, preco
                  FROM prato
                  WHERE id_restaurante = $id_restaurante";
    $resultPratos = $conn->query($sqlPratos);
} else {
    echo "ID do restaurante não fornecido.";
    exit; // Encerra o script se o ID não for fornecido
}
?>

<style>
    .rating-box {
        display: flex;
        align-items: center;
    }

    .stars {
        display: flex;
    }

    .stars i {
        font-size: 1.5em;
        color: #ccc;
        /* Unrated stars */
        cursor: pointer;
    }

    .stars i.active {
        color: gold;
        /* Rated stars */
    }
</style>

<br><br><br><br><br><br>
<div id="page">
    <div class="m-5">
        <div class="row m-5">
            <div class="col-md-3">

                <?php if ($imagem_existente) : ?>
                    <img src="uploads/<?php echo $row["foto_restaurante"]; ?>" class="img-fluid rounded-start" alt="Foto do Restaurante" style="max-width: 100%; max-height: 300px;">
                <?php elseif (isset($_SESSION['id_user']) && $_SESSION['id_user'] == $row['id_proprietario']) : ?>
                    <form action="php/upload_img.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_restaurante" value="<?php echo $id_restaurante; ?>">
                        <input type="file" name="imagem" id="imagem">
                        <input class="btn btn-primary" type="submit" name="submit" value="Enviar Imagem">
                    </form>
                <?php else : ?>
                    <div class="bg-dark text-white text-center">Imagem não disponível</div>
                <?php endif; ?>
            </div>

            <div class="col-md-7">
                <div class="d-flex align-items-center">
                    <h1 class="text-white ms-2"><?php echo $row["nome"]; ?></h1>
                    <form id="favoriteForm" action="php/favoritos_php.php" method="POST">
                        <input type='hidden' name='restaurante_favorito' value='<?php echo $id_restaurante; ?>'>
                        <button type="submit" id="favoriteButton" class="btn btn-danger">
                            <i id="favoriteIcon" class="bi bi-heart"></i>
                        </button>
                    </form>
                </div>
                <p class="fs-2 text-white text-break"><?php echo $row["descricao"]; ?></p>


                <!-- cardapio -->
                <div class="list-group">
                    <?php if ($resultPratos->num_rows > 0) {
                        echo "<h4 class='text-white'>Cardápio:</h4>";
                        while ($prato = $resultPratos->fetch_assoc()) {
                    ?>
                            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3 bg-dark text-white" style="--bs-bg-opacity: .4;" aria-current="true">
                                <div class="d-flex gap-2 w-100 justify-content-between">
                                    <div>
                                        <h3 class="text-white mb-0"><?php echo $prato['nome'] ?></h3>
                                        <p class="mb-0 opacity-75"><?php echo $prato['ingredientes'] ?></p>
                                    </div>
                                    <small class="opacity-50 text-nowrap">R$: <?php echo $prato['preco'] ?></small>
                                </div>
                            </a>
                    <?php }
                    } ?>


                </div>

                <!-- avaliação -->
                <form method="POST" action="php/add_avaliacao.php">
                    <div class="rating-box mt-5">
                        <label for="rating">Avaliação:</label>
                        <div class="stars">
                            <i class="bi bi-star" data-rating="1"></i>
                            <i class="bi bi-star" data-rating="2"></i>
                            <i class="bi bi-star" data-rating="3"></i>
                            <i class="bi bi-star" data-rating="4"></i>
                            <i class="bi bi-star" data-rating="5"></i>
                        </div>
                    </div>
                    <input type="hidden" id="rating-value" name="rating-value" value="0">
                    <input type="hidden" id="id_restaurante" name="id_restaurante" value="<?php echo $id_restaurante; ?>">

                    <!-- comentario -->
                    <div class="form-floating my-4">
                        <div>
                            <input type='hidden' name='id_restaurante' value='<?php echo $id_restaurante; ?>'>
                            <textarea class="form-control" name="comentario" placeholder="Adicione um comentário..." required></textarea>
                            <button class="btn btn-primary mt-2" type="submit" id="submit-avaliacao">Enviar</button>
                        </div>
                    </div>
                </form>

                <?php
                // consulta os comentários
                $sql_comentarios = "SELECT avaliacao.comentario, avaliacao.data_comentario, usuarios.email
                                    FROM avaliacao
                                    INNER JOIN usuarios ON avaliacao.id_user = usuarios.id_user
                                    WHERE avaliacao.id_restaurante = '$id_restaurante'
                                    ORDER BY avaliacao.data_comentario DESC";

                $result_comentarios = $conn->query($sql_comentarios);

                if ($result_comentarios->num_rows > 0) {
                    while ($row_comentario = $result_comentarios->fetch_assoc()) {
                        echo "<p><strong>" . $row_comentario['email'] . "</strong> (" . $row_comentario['data_comentario'] . "): " . $row_comentario['comentario'] . "</p>";
                    }
                }
                ?>


            </div>

            <div class="col-md-2">
                <p class="text-white">Endereço: <?php echo $row["endereco"]; ?></p>
                <p class="text-white">Estilo: <?php echo $row["estilo_culinario"]; ?></p>
                <p class="text-white">Horário: <?php echo $row["horario"]; ?></p>
                <p class="text-white">Capacidade: <?php echo $row["capacidade"]; ?></p>
                <p class="text-white">Telefone: <?php echo $row["telefone"]; ?></p>
            </div>
        </div>
    </div>
</div>











<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up22"></i></a>
</div>

<script>
    const stars = document.querySelectorAll('.stars i');
    const ratingValue = document.getElementById('rating-value');

    stars.forEach((star) => {
        star.addEventListener('click', () => {
            const rating = star.dataset.rating;
            ratingValue.value = rating; // Update the hidden input value

            stars.forEach((s, index) => {
                s.classList.toggle('active', index < rating);
            });
        });
    });
</script>

<script src="js/jquery.min.js"></script>

<script src="js/jquery.easing.1.3.js"></script>

<script src="js/bootstrap.min.js"></script>

<script src="js/jquery.waypoints.min.js"></script>

<script src="js/jquery.stellar.min.js"></script>

<script src="js/jquery.flexslider-min.js"></script>

<script src="js/main.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.min.js"></script>


</body>

</html>