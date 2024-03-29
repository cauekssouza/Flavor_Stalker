<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senha</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="senha.css">
</head>
<body>
    <div class="Caixa-Senha">
        <div class="Senha">
            <h2><i class="fa-solid fa-right-to-bracket"></i> Esqueci Senha</h2>
            <i class="fa-solid fa-heart"></i>
            <input type="password" id="nova_senha" placeholder="Nova Senha">
            <input type="password" id="confirmar_senha" placeholder="Confirmar Nova Senha">
            <button onclick="Validar()">Validar</button>
            <button onclick="window.location.href = 'login.php'">Voltar</button>
            <script src="validar.js"></script>
        </div>
    </div>
</body>
</html>
