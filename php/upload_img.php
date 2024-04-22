<?php
include("../Conexão.php");


// Verifica se o ID do restaurante foi enviado
if(isset($_POST["id_restaurante"])) {
    $id_restaurante = $_POST["id_restaurante"]; // ID do restaurante
    $nome_arquivo = $_FILES["imagem"]["name"];
    $caminho_temporario = $_FILES["imagem"]["tmp_name"];
    $caminho_destino = "../uploads/" . $nome_arquivo;

    // Move o arquivo para a pasta de uploads
    if(move_uploaded_file($caminho_temporario, $caminho_destino)) {
        // Insere o caminho da imagem no banco de dados
        $caminho_db = $caminho_destino;

        // Atualiza o caminho da imagem na tabela restaurantes para o restaurante específico
        $sql = "UPDATE restaurantes SET foto_restaurante = '$caminho_db' WHERE id_restaurante = $id_restaurante";
        if ($conn->query($sql) === TRUE) {
            echo "Imagem enviada com sucesso.";
        } else {
            echo "Erro ao enviar imagem: " . $conn->error;
        }
    } else {
        echo "Erro ao fazer o upload do arquivo.";
    }
} else {
    echo "ID do restaurante não foi enviado.";
}
?>
