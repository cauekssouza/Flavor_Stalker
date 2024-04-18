<?php 
require 'Cad_restaurante_con.php';
$sql = "SELECT * FROM restaurantes";
$result = $conn->query($sql);

echo "<h2>Lista de Restaurantes</h2>";
echo "<a href='list.php'>Adicionar Novo Restaurante</a><br><br>";

// Exibe a lista de restaurantes
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Nome</th><th>Endereço</th><th>Telefone</th><th>Estilo Culinário</th><th>Ações</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['endereco'] . "</td>";
        echo "<td>" . $row['telefone'] . "</td>";
        echo "<td>" . $row['estilo_culinario'] . "</td>";
        echo "<td><a href='edit.php?id=" . $row['id'] . "'>Editar</a> | ";
        echo "<a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este restaurante?\")'>Excluir</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum restaurante encontrado.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
