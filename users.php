<?php include("includes/navbar.php"); ?>
<style>
    #modal-custom {
        background-color: #1a1a1a;
        /* Fundo preto clarinho */
        color: white;
        /* Texto branco */
        padding: 20px;
        border-radius: 8px;
    }

    #modal-custom .modal-header {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    #modal-custom .modal-header a {
        color: white;
        text-decoration: none;
        font-size: 1.5em;
    }

    #modal-custom .modal-input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #000;
        /* Borda preta */
        color: white;
        background-color: #333;
        /* Fundo dos inputs */
        border-radius: 4px;
    }

    #modal-custom .modal-button {
        background-color: red;
        /* Botões vermelhos */
        color: white;
        border: none;
        padding: 10px 20px;
        margin: 5px;
        cursor: pointer;
        border-radius: 4px;
    }

    #modal-custom .modal-button.cancel {
        background-color: darkred;
        /* Botão Cancel mais escuro */
    }

    #modal-custom .icon-close {
        color: white;
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
    }


</style>
<br><br><br><br><br>
<div id="page">
    <div class="container text-center mt-5">

        <?php
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
            <div class="border border-dark rounded m-5 bg-dark  col-lg-4" style="--bs-bg-opacity: .5;">
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

                <div class="d-grid gap-2">
                    <button class="trigger-custom btn btn-primary w-100" data-izimodal-open="#modal-custom">Cadastrar Restaurante</button>
                    <?php
                    // verifica se o usuário está logado
                    if (isset($_SESSION['id_user'])) {
                        // verifica se o tipo de usuário é administrador
                        if ($_SESSION['id_tipo'] == 3) {
                            // se for administrador, exibe os botões
                    ?>
                            <a href="restaurantes_list.php" class="text-white btn btn-primary w-100">Restaurantes</a>
                    <?php
                        }
                    }
                    ?>




                    <div id="modal-custom" data-iziModal-group="grupo1">
                        <button data-iziModal-close class="icon-close" style="color: black;">x</button>
                        <a href="" id="signin" class="active" style="color: white;">Cadastrar Restaurante</a>
                        <section>
                            <form method="POST" action="php/cad_restaurante_php.php" class="restaurante">
                                <input type="text" placeholder="Nome do Restaurante" name="nome" required style="color: black;">
                                <input type="text" placeholder="Endereço" name="endereco" required style="color: black;">
                                <input type="text" placeholder="Dono" name="dono" required style="color: black;">
                                <input type="tel" placeholder="Telefone" name="telefone" required style="color: black;">
                                <input type="text" placeholder="Estilo Culinário" name="estilo_culinario" required style="color: black;">
                                <input type="text" placeholder="Descrição" name="descricao" required style="color: black;">
                                <input type="time" placeholder="Horário de Funcionamento" name="horario" required style="color: black;">
                                <input type="number" placeholder="Capacidade" name="capacidade" required style="color: black;">
                                <button onclick="validar()">Enviar</button> <!-- adiciona a função de validação -->
                                <button onclick="window.location.href='users.php'">Voltar</button>
                            </form>
                            <script src="valida.js"></script>
                            <footer>
                                <button data-iziModal-close class="modal-button cancel">Cancel</button>
                                <button class="modal-button submit">Log in</button>
                            </footer>
                        </section>
                    </div>


                    <a href="php/logout_php.php" class="">Sair <span class="fs-5">(<?php echo $email ?>)</span></a>

                </div>
            </div>
            <?php

            include("Conexão.php");


            // Consulta os feedbacks do usuário atualmente logado
            $sql = "SELECT r.id_restaurante, r.nome, r.foto_restaurante, r.estilo_culinario, r.descricao, a.comentario, a.data_comentario
            FROM restaurantes r
            JOIN favoritos f ON r.id_restaurante = f.id_restaurante
            LEFT JOIN avaliacao a ON r.id_restaurante = a.id_restaurante AND a.id_user = $id_user
            WHERE f.id_user = $id_user
            ORDER BY a.data_comentario DESC";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="border border-dark rounded col col-lg-6">
                        <p class="border-bottom border-dark">Restaurante Favoritado</p>
                        <div class="row">
                            <div class="col-md-4">
                                <img src="uploads/<?php echo $row["foto_restaurante"]; ?>" class="img-fluid rounded-start" alt="Foto do Restaurante">
                            </div>
                            <div class="col-md-8">
                                <h3 class="mb-1 card-title"><?php echo $row["nome"]; ?></h3>
                                <small class="card-text"><span class="badge text-bg-secondary rounded-pill"><?php echo $row["estilo_culinario"]; ?></span></small>
                                <?php if (!empty($row['comentario'])) : ?>
                                    <p class="mt-2">Feedback: <?php echo $row['comentario']; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="border border-dark rounded col col-lg-7">
                    <p class="border-bottom border-dark"> Nenhum restaurante favoritado ou feedback feito</p>
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

<script src="iziModal.min.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/js/iziModal.min.js"></script>

<script src="js/modal.js"></script>


</body>

</html>