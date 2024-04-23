<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Restaurantes</title>
    <style>
        /* Adicione os estilos CSS necessários aqui */
        /* Estilos para a tabela */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<?php
// Configurações de conexão com o banco de dados
$servername = "localhost:3307";
$username = "root";
$password = "2204ckss";
$database = "cad_restaurante";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Query para selecionar todos os registros da tabela 'restaurantes'
$sql = "SELECT * FROM restaurantes";
$result = $conn->query($sql);

// Verifica se há resultados
if ($result->num_rows > 0) {
    // Exibe os dados em forma de tabela
    echo "<h2>Lista de Restaurantes</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nome</th><th>Endereço</th><th>Dono</th><th>Telefone</th><th>Estilo Culinário</th><th>Descrição</th><th>Horário</th><th>Capacidade</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['endereco'] . "</td>";
        echo "<td>" . $row['dono'] . "</td>";
        echo "<td>" . $row['telefone'] . "</td>";
        echo "<td>" . $row['estilo_culinario'] . "</td>";
        echo "<td>" . $row['descricao'] . "</td>";
        echo "<td>" . $row['horario'] . "</td>";
        echo "<td>" . $row['capacidade'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum restaurante encontrado.";
}

// Fecha a conexão
$conn->close();
?>
<?php include 'footer.php';
include 'navbar.php'; ?>
</body>
</html>
