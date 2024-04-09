<!DOCTYPE html>
<html>
<title>Lista de usuários</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-ios.css">

<style>
    a {
        text-decoration: none;
    }
</style>

<body>

    <?php include("../Conexão.php");
    $sql = "SELECT id_user, nome_user, email, senha FROM usuarios";
    $result = $conn->query($sql);
    ?>

    <div class="w3-container">
        <h2>Usuários</h2>

        <ul class="w3-ul w3-card-4">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id_user = $row['id_user'];
            ?>
                    <li class="w3-bar">
                        <img src="../images/default_icon.png" class="w3-bar-item w3-circle w3-hide-small w3-margin-top w3-margin-bottom" style="width:85px">
                        <div class="w3-bar-item w3-margin-top w3-margin-bottom">
                            <span class="w3-large"><?php echo $row['nome_user'] ?></span> <br>
                            <span><?php echo $row['email'] ?></span> <br>
                            <span><?php echo $row['senha'] ?></span>
                        </div>

                        <form action="users_del_php.php" method="post">
                            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                            <button class="w3-xlarge w3-right w3-button w3-circle w3-ios-red w3-hover-red w3-margin-left w3-margin">
                                ×
                            </button>
                        </form>

                    </li>
            <?php
                }
            }
            ?>
        </ul>
    </div>
</body>
</html>