<?php
$servername = "locahost:3307"; // Endereço do servidor
$username = "root"; // Usuário do banco de dados
$password = "2204ckss"; // Senha do banco de dados
$dbname = "cad_restaurante"; // Nome do banco de dados

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
