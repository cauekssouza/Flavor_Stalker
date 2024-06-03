<?php
ob_start();
include("includes/navbar.php");
?>
<style>
    .form-control,
    .prato-item {
        font-family: 'Cormorant Garamond', serif;
    }

    input,
    textarea {
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
</style>
<br><br><br><br><br>
<div id="page">
    <div class="container text-center mt-5">

        <?php
        if (!isset($_SESSION['id_user'])) {  // se o usuário estiver logado
            header("Location: ./login.php");
            exit();
        }
        $id_user = $_SESSION['id_user'];
        $id_tipo = $_SESSION['id_tipo'];
        $nome_user = $_SESSION['nome_user'];
        $email = $_SESSION['email'];
        $data_criacao = $_SESSION['data_criacao'];
        $senha = $_SESSION['senha'];
        ?>

        <div class="row gx-5">
            <div class="border border-dark rounded m-5 bg-dark text-white col-lg-4" style="--bs-bg-opacity: .5;">
                <img src="images/default_icon.png" class="rounded-circle img-fluid p-3" width="150" height="150">
                <div class="text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <p class="mb-0 me-2"><?php echo $nome_user; ?></p>
                        <?php
                        // verifica o tipo de usuário e exibe a badge correspondente
                        if ($_SESSION['id_tipo'] == 2) {
                            echo "<span class='badge text-bg-primary'>Dono de Restaurante</span>";
                        } elseif ($_SESSION['id_tipo'] == 3) {
                            echo "<span class='badge text-bg-primary'>Admin</span>";
                        }
                        ?>
                    </div>
                    <p class="mt-2 p-2 border-bottom border-white">Data de criação: <?php echo date('d/m/Y', strtotime($data_criacao)); ?></p> <!-- strtotime converte a data para o formato brasileiro -->
                </div>


                <div class="d-grid gap-4 text-start">
                    <!-- <button class="trigger-custom btn btn-primary w-100" data-izimodal-open="#modal-custom">Cadastrar Restaurante</button> -->
                    <button class="btn btn-primary w-100" id="editProfileBtn">Editar Perfil</button>
                    <a href="" class="text-white ">Favoritos</a>
                    <a href="./cad_restaurante.php" class="text-white ">Cadastrar Restaurante</a>
                    <?php
                    // verifica se o usuário está logado
                    if (isset($_SESSION['id_user'])) {
                        // verifica se o tipo de usuário é administrador
                        if ($_SESSION['id_tipo'] == 3) {
                            // se for administrador, exibe os botões
                    ?>
                            <a href="restaurantes_list.php" class="text-white">Restaurantes</a>
                    <?php
                        }
                    }
                    ?>
                    <a href="php/logout_php.php" class="">Sair <span class="fs-5">(<?php echo $email ?>)</span></a>
                </div>
            </div>




            <div class="border border-dark rounded col col-lg-7" id="editProfileForm" style="display: none;">
                <?php
                if (isset($_SESSION["error"])) {
                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION["error"] . '</div>';
                    unset($_SESSION["error"]);
                }
                ?>
                <form action="php/update_profile.php" method="POST">
                    <div class="mb-3">
                        <label for="nome_user" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome_user" name="nome_user" value="<?php echo $nome_user; ?>" pattern="^[a-zA-ZÀ-ÿ]+(?: [a-zA-ZÀ-ÿ]+)*$" title="Digite um nome válido" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" title="Digite um email válido" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Nova Senha</label>
                        <input type="password" class="form-control" id="password" name="nova_senha" value="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="A senha deve conter pelo menos 8 caracteres, incluindo pelo menos um número, uma letra minúscula e uma letra maiúscula">
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirmação da senha</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirmacao_senha" value="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="A senha deve conter pelo menos 8 caracteres, incluindo pelo menos um número, uma letra minúscula e uma letra maiúscula">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </form>
            </div>

            <div id="favoritosContainer" class="border border-dark rounded col col-lg-7">
                <p class="border-bottom border-dark">Restaurante Favoritado</p>
                <?php
                include("Conexão.php");

                // Consulta os restaurantes favoritados do usuário atualmente logado
                $sql = "SELECT r.id_restaurante, r.nome, r.foto_restaurante, r.estilo_culinario, r.descricao
            FROM restaurantes r
            JOIN favoritos f ON r.id_restaurante = f.id_restaurante
            LEFT JOIN avaliacao a ON r.id_restaurante = a.id_restaurante AND a.id_user = $id_user
            WHERE f.id_user = $id_user AND a.comentario IS NULL
            ORDER BY r.nome";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="border border-dark mb-5" style="margin-bottom: 20px;">
                            <a href="restaurante.php?id=<?php echo $row['id_restaurante']; ?>" class="text-decoration-none text-white">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="uploads/<?php echo $row["foto_restaurante"]; ?>" class="img-fluid rounded-start" alt="Foto do Restaurante">
                                    </div>
                                    <div class="col-md-8">
                                        <h3 class="mb-1 card-title"><?php echo $row["nome"]; ?></h3>
                                        <small class="card-text"><span class="badge text-bg-secondary rounded-pill"><?php echo $row["estilo_culinario"]; ?></span></small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <p class="border-bottom border-dark">Nenhum Restaurante Favoritado</p>
                <?php
                }
                ?>
            </div>




            <?php
            if (isset($_SESSION['notificacao'])) {
                echo "<script>
    Swal.fire({
        title: 'Notificação',
        text: '{$_SESSION['notificacao']}',
        icon: 'info',
        confirmButtonText: 'Ok'
    });
    </script>";
                unset($_SESSION['notificacao']);
            }
            ob_end_flush(); // Envia o buffer de saída
            ?>







        </div>
    </div>


    <script>
        $(document).ready(function() {
            // Mostrar restaurantes favoritados quando a página for carregada
            $("#favoritosContainer").show();
            $("#editProfileForm").hide();

            // Mostrar formulário de edição de perfil quando o botão Editar Perfil for clicado
            $("#editProfileBtn").click(function() {
                $("#editProfileForm").toggle();
                $("#favoritosContainer").toggle(); // Alteração aqui
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

    <script src="iziModal.min.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/js/iziModal.min.js"></script>

    <script src="js/modal.js"></script>


    </body>

    </html>