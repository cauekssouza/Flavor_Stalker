<?php
header('Content-Type: application/json');

// Simulação de histórico de senhas já utilizadas (geralmente, isso estaria em um banco de dados)
$historicoSenhas = [
    'senha123',   // Exemplo de senha anteriormente utilizada
    // Adicione outras senhas conforme necessário
];

// Inicializa a resposta padrão
$response = array('success' => false, 'message' => '');

// Obtém os dados do corpo da requisição
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['senha'])) {
    $novaSenha = $data['senha'];

    // Verifica se a nova senha já está no histórico de senhas
    if (in_array($novaSenha, $historicoSenhas)) {
        $response['message'] = 'Essa senha já foi utilizada anteriormente. Por favor, escolha uma senha diferente.';
        echo json_encode($response);
        return;
    }

    // Aqui você deve incluir a lógica para alterar a senha no banco de dados
    // Por exemplo, você pode usar PDO para interagir com o banco de dados
    // Este é um exemplo simples sem a lógica real de banco de dados
    try {
        // Suponha que a senha foi alterada com sucesso
        $senhaAlteradaComSucesso = true; // Mude isso conforme a lógica do seu banco de dados

        if ($senhaAlteradaComSucesso) {
            $response['success'] = true;
            $response['message'] = 'Senha alterada com sucesso!';
        } else {
        }
    } catch (Exception $e) {
        // Captura qualquer exceção e define a mensagem de erro apropriada
        $response['message'] = 'Ocorreu um erro ao tentar alterar a senha: ' . $e->getMessage();
    }
} else {
    $response['message'] = 'Dados inválidos enviados.';
}

// Retorna a resposta em formato JSON
echo json_encode($response);
?>

