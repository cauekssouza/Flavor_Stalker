<?php
include("includes/navbar.php");
include("Conexão.php");

$sql = "SELECT id_restaurante, nome, endereco, dono, estilo_culinario, descricao, horario, capacidade, telefone FROM restaurantes";
$result = $conn->query($sql);

?>


<br><br><br><br><br><br>
<div class="container-fluid pb-3">
    <div class="d-grid gap-4" style="grid-template-columns: 1fr 3fr;">
        <div class="bg-dark border rounded-3">
            oi
            <br><br><br><br><br><br><br><br><br><br>
            oi
        </div>
        <div class="bg-dark border rounded-3">
            <?php


            if ($result->num_rows > 0) {
                // saida de dados de cada linha
                while ($row = $result->fetch_assoc()) {
            ?>
                    ID:         <?php echo $row["id_restaurante"] ?> <br>
                    Nome:       <?php echo $row["nome"] ?> <br>
                    Endereço:   <?php echo $row["endereco"] ?> <br>
                    Dono:       <?php echo $row["dono"] ?> <br>
                    Estilo:     <?php echo $row["estilo_culinario"] ?> <br>
                    Descrição:  <?php echo $row["descricao"] ?> <br>
                    Horário:    <?php echo $row["horario"] ?> <br>
                    Capacidade: <?php echo $row["capacidade"] ?> <br>
                    Telefone:   <?php echo $row["telefone"] ?> <br>

            <?php
                }
            } else {
                echo "0 resultados";
            }
            $conn->close();
            ?>

        </div>
    </div>
</div>


<?php include("includes/footer.php") ?>