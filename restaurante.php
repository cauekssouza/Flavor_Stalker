<?php
include("includes/navbar.php");
include("Conexão.php");


if (isset($_GET['id'])) { // verifica se o ID do restaurante foi fornecido na URL
    $id_restaurante = $_GET['id'];

    $sql = "SELECT id_restaurante, id_proprietario, nome, endereco, dono, estilo_culinario, descricao, horario, capacidade, telefone, foto_restaurante
            FROM restaurantes
            WHERE id_restaurante = $id_restaurante";
    $result = $conn->query($sql);



?>


    <br><br><br><br><br><br>
    <div class="container-fluid pb-3">
        <div class="d-grid gap-4" style="grid-template-columns: 1fr 6fr;">

            <?php
            // Inicializa a variável que checa a existência da imagem
            $imagem_existente = false;

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (!empty($row["foto_restaurante"])) {
                    $imagem_existente = $row["foto_restaurante"];
                }
            }

            // Verifica se o usuário está logado e se é o proprietário do restaurante
            if (isset($_SESSION['id_user']) && $_SESSION['id_user'] == $row['id_proprietario']) {
                if ($imagem_existente) {
                    // Exibe a imagem se existir
                    echo '<div><img src="uploads/' . $imagem_existente . '" alt="Foto do Restaurante" style="width: 100%; height: 100%; object-fit: cover;"></div>';
                } else {
                    // Exibe o formulário se não houver imagem
            ?>
                    <form action="php/upload_img.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_restaurante" value="<?php echo $id_restaurante; ?>">
                        <input type="file" name="imagem" id="imagem">
                        <input class="btn btn-primary" type="submit" name="submit" value="Enviar Imagem">
                    </form>
            <?php
                }
            } else {
                // Exibe apenas a imagem, sem o formulário
                if ($imagem_existente) {
                    // Exibe a imagem se existir
                    echo '<div><img src="uploads/' . $imagem_existente . '" alt="Foto do Restaurante" style="width: 100%; height: 100%; object-fit: cover;"></div>';
                } else {
                    // Exibe uma mensagem de que não há imagem disponível
                    echo '<div class="bg-dark text-white text-center">Imagem não disponível</div>';
                }
            }
            ?>


            <div class="bg-dark border rounded-3">
                <?php
                if ($result->num_rows > 0) {
                    // reposiciona o ponteiro do resultado para o início, se necessário
                    $result->data_seek(0);
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <h1 class="text-white"><?php echo $row["nome"] ?></h1>
                        <p class="fs-2 text-white"><?php echo $row["descricao"] ?></p>
                        Endereço: <?php echo $row["endereco"] ?><br>
                        Dono: <?php echo $row["dono"] ?><br>
                        Estilo: <?php echo $row["estilo_culinario"] ?><br>
                        Horário: <?php echo $row["horario"] ?><br>
                        Capacidade: <?php echo $row["capacidade"] ?><br>
                        Telefone: <?php echo $row["telefone"] ?><br>
                <?php
                    }
                } else {
                    echo "0 resultados";
                }
                ?>




            </div>
        </div>
    </div>
<?php
}
?>


<!-- comentario -->
<div class="form-floating my-4">
    <form action="php/add_feedback.php" method="POST">
        <input type='hidden' name='id_restaurante' value='<?php echo $id_restaurante; ?>'>
        <textarea class="form-control" name="comentario" placeholder="Adicione um comentário..." required></textarea>
        <button class="btn btn-primary mt-2" type="submit" id="button-addon2">Enviar</button>
    </form>
</div>


<?php // exibe os comentários
$sql_comentarios = "SELECT avaliacao.comentario, avaliacao.data_comentario, usuarios.email
FROM avaliacao
INNER JOIN usuarios ON avaliacao.id_user = usuarios.id_user
WHERE avaliacao.id_restaurante = '$id_restaurante'
ORDER BY avaliacao.data_comentario DESC";

$result_comentarios = $conn->query($sql_comentarios);

// se houver comentários
if ($result_comentarios->num_rows > 0) {
    while ($row_comentario = $result_comentarios->fetch_assoc()) {
        echo "<p><strong>" . $row_comentario['email'] . "</strong> (" . $row_comentario['data_comentario'] . "): " . $row_comentario['comentario'] . "</p>";
    }
}
?>


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