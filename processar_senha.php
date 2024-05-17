<?php
include("../Conexão.php");

$data = json_decode(file_get_contents('php://input'), true);
$nova_senha = $data['senha'];

if (empty($nova_senha)) {
    echo json_encode(['success' => false, 'message' => 'A nova senha não pode estar vazia.']);
    exit;
}

$hash_senha = password_hash($nova_senha, PASSWORD_BCRYPT);

session_start();
$id_user = $_SESSION['id_user'];

$sql = "UPDATE usuarios SET senha = ? WHERE id_user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('si', $hash_senha, $id_user);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Senha alterada com sucesso!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao alterar a senha.']);
}

$stmt->close();
$conn->close();
?>
