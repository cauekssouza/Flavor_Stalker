<?php
include("../Conexão.php");
session_start();

// verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // recebe os dados do formulário(sem sanitização)
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $estilo_culinario = $_POST['estilo_culinario'];
    $descricao = $_POST['descricao'];
    $horario = $_POST['horario'];
    $capacidade = $_POST['capacidade'];

    // verifica se o usuário está logado e obtém o ID
    if (isset($_SESSION['id_user'])) {
        $id_user = $_SESSION['id_user'];

        // atualiza o tipo de usuário para "Dono de Restaurante" (ID 2) se ele for um cliente (ID 1)
        if ($_SESSION['id_tipo'] == 1) {
            $sql_update_tipo = "UPDATE usuarios SET id_tipo = 2 WHERE id_user = $id_user";
            $conn->query($sql_update_tipo);
            $_SESSION['id_tipo'] = 2; // Atualiza a sessão
        }
    } else {
        header("Location: ../login.php");
        exit; // encerra o script se o usuário não estiver logado
    }

    // Verifica se uma imagem foi enviada
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $nome_arquivo = $_FILES["imagem"]["name"];
        $caminho_temporario = $_FILES["imagem"]["tmp_name"];
        $caminho_destino = "../uploads/" . $nome_arquivo;

        // Move o arquivo para a pasta de uploads
        if (move_uploaded_file($caminho_temporario, $caminho_destino)) {
            $caminho_db = $caminho_destino; // Caminho da imagem no banco de dados
        } else {
            echo "Erro ao enviar imagem: " . $_FILES["imagem"]["error"];
            exit; // Encerra o script em caso de erro no upload
        }
    } else {
        $caminho_db = null; // Nenhuma imagem enviada
    }

    // Inclua o ID do usuário e o caminho da imagem na consulta SQL
    $sql = "INSERT INTO restaurantes (id_proprietario, nome, endereco, telefone, estilo_culinario, descricao, horario, capacidade, foto_restaurante)
            VALUES ('$id_user', '$nome', '$endereco', '$telefone', '$estilo_culinario', '$descricao', '$horario', '$capacidade', '$caminho_db')";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id; // Obtém o ID do restaurante inserido

        // Insere os pratos no banco de dados (SEM prepared statements)
        if (isset($_POST['pratos'])) {
            foreach ($_POST['pratos'] as $prato) {
                if (!empty($prato['nome']) && !empty($prato['ingredientes']) && !empty($prato['preco'])) {
                    $nomePrato = $prato['nome'];
                    $ingredientes = $prato['ingredientes'];
                    $preco = floatval(str_replace('R$ ', '', $prato['preco'])); // Remove "R$" e converte para float

                    $insertPratoSql = "INSERT INTO prato (nome, ingredientes, preco, id_restaurante) VALUES ('$nomePrato', '$ingredientes', $preco, $last_id)";
                    $conn->query($insertPratoSql);
                }
            }
        }

        header("Location: ../users.php");
    } else {
        echo "Erro ao cadastrar restaurante: " . $conn->error;
    }
}
?>
