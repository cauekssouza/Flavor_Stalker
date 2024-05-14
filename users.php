<?php include("includes/navbar.php"); ?>

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
            <div class="border border-dark rounded m-5 bg-dark  col-md-3 col-lg-3" style="--bs-bg-opacity: .5;">
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

                <div class="d-grid gap-2 btn-sm">
                    <a href="cad_restaurante.php" class="text-white btn btn-primary">Criar Restaurante</a>
                    <?php

                    // verifica se o usuário está logado
                    if (isset($_SESSION['id_user'])) {
                        // verifica se o tipo de usuário é administrador
                        if ($_SESSION['id_tipo'] == 3) {
                            // se for administrador, exibe os botões
                    ?>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="users_list.php" class="text-white btn btn-primary">Usuários</a>
                                <a href="restaurantes_list.php" class="text-white btn btn-primary">Restaurantes</a>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <button class="trigger-custom btn btn-primary" data-izimodal-open="#modal-custom">Login/Custom example</button>


                    <div id="modal-custom" data-iziModal-group="grupo1">
                        <button data-iziModal-close class="icon-close">x</button>
                        <header>
                            <a href="" id="signin">Sign in</a>
                            <a href="" class="active">New Account</a>
                        </header>
                        <section class="hide">
                            <input type="text" placeholder="Username">
                            <input type="password" placeholder="Password">
                            <footer>
                                <button data-iziModal-close>Cancel</button>
                                <button class="submit">Log in</button>
                            </footer>
                        </section>
                        <section>
                            <input type="text" placeholder="Username">
                            <input type="text" placeholder="Email">
                            <input type="password" placeholder="Password">
                            <label for="check"><input type="checkbox" name="checkbox" id="check" value="1"> I agree to the <u>Terms</u>.</label>
                            <footer>
                                <button data-iziModal-close>Cancel</button>
                                <button class="submit">Create Account</button>
                            </footer>
                        </section>
                    </div>

                    <a href="php/logout_php.php" class="">Sair <span class="fs-5">(<?php echo $email ?>)</span></a>

                </div>
            </div>
            <?php

            include("Conexão.php");


            // Consulta os feedbacks do usuário atualmente logado
            $sql = "SELECT comentario, data_comentario FROM avaliacao WHERE id_user = $id_user ORDER BY data_comentario DESC";
            $result = $conn->query($sql);

            // Verifica se há feedbacks
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

            ?>
                    <div class="border border-dark rounded col col-md-8 col-lg-8">
                        <p class="border-bottom border-dark">Feedback</p>
                        <div class="row border-bottom border-dark text-white">
                            <p> <?php echo $row['comentario'] ?> </p>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="border border-dark rounded col col-md-8 col-lg-8">
                    <p class="border-bottom border-dark"> Nenhum feedback feito</p>

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