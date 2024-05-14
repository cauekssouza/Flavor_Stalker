<?php
session_start();
include ("../Conexão.php");

$restaurante_favorito = $_POST['restaurante_favorito'];

if(isset($_SESSION['id_user'])){  // se o usuário estiver logado pega o id dele
    $id_user = $_SESSION['id_user'];
} else {
    header("Location: ../login.php");
    exit();
}

// ve se o restaurante já está na lista de desejos
$query = "SELECT * FROM favoritos WHERE id_user = $id_user AND id_restaurante = $restaurante_favorito";
$result = $conn->query($query);

if ($result->num_rows > 0) {
  // se o restaurante já está na lista de desejos, remove ele
  $query = "DELETE FROM favoritos WHERE id_user = $id_user AND id_restaurante = $restaurante_favorito";
} else {
  // se nao, adiciona ele
  $query = "INSERT INTO favoritos (id_user, id_restaurante) VALUES ($id_user, $restaurante_favorito)";
}

if ($conn->query($query) === TRUE) {
    header("Location: ../restaurante.php?id=$restaurante_favorito");
    exit(); // Finaliza o script após o redirecionamento
} else {
  echo "Erro ao atualizar: " . $conn->error;
}

$conn->close();

?>
