<?php
include("includes/navbar.php");
include("Conexão.php");


if (isset($_GET['id'])) {
    $id_restaurante = $_GET['id'];

    // Verifica se o usuário é o dono do restaurante
    $sqlDono = "SELECT id_proprietario FROM restaurantes WHERE id_restaurante = $id_restaurante";
    $resultDono = $conn->query($sqlDono);
    $rowDono = $resultDono->fetch_assoc();

    // Modo de edição (true se o usuário for o dono e clicar em "Editar")
    $modoEdicao = isset($_GET['edit']) && $_SESSION['id_user'] == $rowDono['id_proprietario'];

    // Consulta SQL para os dados do restaurante
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
    $sqlPratos = "SELECT id_prato, nome, ingredientes, preco
                  FROM prato
                  WHERE id_restaurante = $id_restaurante";
    $resultPratos = $conn->query($sqlPratos);
} else {
    echo "ID do restaurante não fornecido.";
    exit;
}
?>

<style>
    .form-control,
    .prato-item {
        font-family: 'Cormorant Garamond', serif;
    }
    input, textarea {
        font-family: 'Cormorant Garamond', serif;
    }


    /* Cor de fundo e cor do texto quando o input está em foco */
    .form-control:focus {
        background-color: #24292e;
        color: white;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
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
        cursor: pointer;
    }

    .stars i.active {
        color: gold;
    }
</style>

<br><br><br><br><br><br>
<div id="page">
    <div class="m-5">
        <?php if ($modoEdicao) : ?>
            <form action="php/atualizar_restaurante.php" method="post" enctype="multipart/form-data" id="restauranteForm">
                <input type="hidden" name="id_restaurante" value="<?php echo $id_restaurante; ?>">
            <?php endif; ?>
            <div class="row m-5">
                <div class="col-md-3">
                    <?php if ($imagem_existente) : ?>
                        <img src="uploads/<?php echo $row["foto_restaurante"]; ?>" class="img-fluid rounded-start" alt="Foto do Restaurante" style="max-width: 100%; max-height: 300px;">
                        <?php if ($modoEdicao) : ?>
                            <button type="button" class="btn btn-danger btn-sm mt-2" id="removerImagemBtn">Remover Imagem</button>
                        <?php endif; ?>
                    <?php elseif ($modoEdicao) : ?>
                        <div class="bg-dark text-white text-center p-3">
                            <label for="imagem">Foto do Restaurante:</label> <input type="file" name="imagem" id="imagem">
                            <small>A imagem será exibida após o envio.</small>
                        </div>
                    <?php else : ?>
                        <div class="bg-dark text-white text-center">Imagem não disponível</div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <?php if ($modoEdicao) : ?>
                        <div class="mb-3">
                            <label for="nome" class="form-label text-white">Nome do Restaurante:</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $row["nome"]; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="descricao" class="form-label text-white">Descrição:</label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="3" required><?php echo $row["descricao"]; ?></textarea>
                        </div>
                    <?php else : ?>
                        <div class="d-flex align-items-center">
                            <h1 class="text-white ms-2"><?php echo $row["nome"]; ?></h1>
                            <form id="favoriteForm" action="php/favoritos_php.php" method="POST">
                                <input type='hidden' name='restaurante_favorito' value='<?php echo $id_restaurante; ?>'>
                                <button type="submit" id="favoriteButton" class="btn btn-danger btn-sm">
                                    <i id="favoriteIcon" class="bi bi-heart"></i>
                                </button>
                            </form>
                        </div>
                        <p class="fs-2 text-white text-break"><?php echo $row["descricao"]; ?></p>
                    <?php endif; ?>

                    <div id="cardapio-container" class="list-group">
                        <?php if ($resultPratos->num_rows > 0) : ?>
                            <h4 class="text-white">Cardápio:</h4>
                            <?php
                            $pratoCount = 0;
                            while ($prato = $resultPratos->fetch_assoc()) :
                                $pratoCount++;
                            ?>
                                <div class="list-group-item list-group-item-action d-flex gap-3 py-3 bg-dark text-white mb-0" style="--bs-bg-opacity: .4;" aria-current="true">
                                    <div class="d-flex gap-2 w-100 justify-content-between">
                                        <div>
                                            <?php if ($modoEdicao) : ?>
                                                <input type="text" class="form-control prato-item prato-nome" placeholder="Nome do Prato" name="pratos[<?php echo $pratoCount; ?>][nome]" value="<?php echo $prato['nome']; ?>">
                                                <input type="text" class="form-control prato-item prato-paragrafo" placeholder="Ingredientes" name="pratos[<?php echo $pratoCount; ?>][ingredientes]" value="<?php echo $prato['ingredientes']; ?>">


                                            <?php else : ?>
                                                <h3 class="text-white mb-0"><?php echo $prato['nome']; ?></h3>
                                                <p class="mb-0 opacity-75"><?php echo $prato['ingredientes']; ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <?php if ($modoEdicao) : ?>
                                                <div class="prato-preco-wrapper">
                                                    <input type="number" step="0.01" class="form-control prato-item prato-paragrafo prato-preco" placeholder="Preço" name="pratos[<?php echo $pratoCount; ?>][preco]" value="<?php echo isset($prato['preco']) ? $prato['preco'] : ''; ?>">
                                                </div>
                                                <button type="button" class="btn btn-danger mt-1" onclick="removerPrato(this)">Remover</button>
                                            <?php else : ?>
                                                <small class="opacity-50 text-nowrap">R$ <?php echo $prato['preco']; ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <?php if ($modoEdicao) : ?>
                                <button type="button" class="btn btn-secondary" id="add-prato">Adicionar Prato</button>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <?php if (!$modoEdicao) : ?>
                        <form method="POST" action="php/add_avaliacao.php" id="ratingForm">
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
                                    WHERE avaliacao.id_restaurante = $id_restaurante
                                    ORDER BY avaliacao.data_comentario DESC";
                        $result_comentarios = $conn->query($sql_comentarios);

                        if ($result_comentarios->num_rows > 0) {
                            while ($row_comentario = $result_comentarios->fetch_assoc()) {
                                echo "<p><strong>" . $row_comentario['email'] . "</strong> (" . $row_comentario['data_comentario'] . "): " . $row_comentario['comentario'] . "</p>";
                            }
                        }
                        ?>
                    <?php endif; ?>

                </div>
                <div class="col-md-3">
                    <?php if ($modoEdicao) : ?>
                        <div class="mb-3">
                            <label for="endereco" class="form-label text-white">Endereço:</label>
                            <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo $row["endereco"]; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="estilo" class="form-label text-white">Estilo:</label>
                            <input type="text" class="form-control" id="estilo" name="estilo" value="<?php echo $row["estilo_culinario"]; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="horario" class="form-label text-white">Horário de Funcionamento:</label>
                            <input type="text" class="form-control" id="horario" name="horario" value="<?php echo $row["horario"]; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="capacidade" class="form-label text-white">Capacidade:</label>
                            <input type="number" class="form-control" id="capacidade" name="capacidade" value="<?php echo $row["capacidade"]; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefone" class="form-label text-white">Telefone:</label>
                            <input type="tel" class="form-control" id="telefone" name="telefone" value="<?php echo $row["telefone"]; ?>" required>
                        </div>
                    <?php else : ?>
                        <div class="mb-3">
                            <p class="text-white"><strong>Endereço:</strong> <?php echo $row["endereco"]; ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="text-white"><strong>Estilo:</strong> <?php echo $row["estilo_culinario"]; ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="text-white"><strong>Horário de Funcionamento:</strong> <?php echo $row["horario"]; ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="text-white"><strong>Capacidade:</strong> <?php echo $row["capacidade"]; ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="text-white"><strong>Telefone:</strong> <?php echo $row["telefone"]; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($modoEdicao) : ?>
                <div class="mt-5 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    <a href="?id=<?php echo $id_restaurante; ?>" class="btn btn-secondary ms-2">Cancelar</a>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <?php if (!$modoEdicao && isset($_SESSION['id_user']) && $_SESSION['id_user'] == $row['id_proprietario']) : ?>
        <div class="d-flex justify-content-end mt-3 me-5">
            <a href="?id=<?php echo $id_restaurante; ?>&edit=true" class="btn btn-warning">Editar</a>
        </div>
    <?php endif; ?>


    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="icon-arrow-up22"></i></a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addPratoButton = document.getElementById('add-prato');
            const cardapioContainer = document.getElementById('cardapio-container');

            addPratoButton.addEventListener('click', function() {
                const newPrato = document.createElement('div');
                newPrato.className = 'list-group-item list-group-item-action d-flex gap-3 py-3 bg-dark text-white mb-0';
                newPrato.style = '--bs-bg-opacity: .4;';
                newPrato.setAttribute('aria-current', 'true');

                newPrato.innerHTML = `
            <div class="d-flex gap-2 w-100 justify-content-between">
                <div>
                    <input type="text" class="form-control prato-item prato-nome" placeholder="Nome do Prato" name="pratos[new][nome]" value="">
                    <input type="text" class="form-control prato-item prato-paragrafo" placeholder="Ingredientes" name="pratos[new][ingredientes]" value="">
                </div>
                <div>
                    <div class="prato-preco-wrapper">
                        <input type="number" step="0.01" class="form-control prato-item prato-paragrafo prato-preco" placeholder="Preço" name="pratos[new][preco]" value="">
                    </div>
                    <button type="button" class="btn btn-danger mt-1" onclick="removerPrato(this)">Remover</button>
                </div>
            </div>
        `;

                cardapioContainer.insertBefore(newPrato, addPratoButton);
            });
        });

        function removerPrato(button) {
            button.closest('.list-group-item').remove();
        }
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