<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Restaurante</title>
    <link rel="stylesheet" href="restaurante.css">
</head>
<body>
    <h2>Cadastro de Restaurante</h2>
    <div class="box">
        <form class="restaurante" action="#" method="post">
            <input type="text" placeholder="Nome do Restaurante" name="nome" required>
            <input type="text" placeholder="Endereço" name="endereco"required>
            <input type="text" placeholder="Dono" name="dono">
            <input type="tel" placeholder="Telefone" name="telefone"required>
            <input type="text" placeholder="Estilo Culinário" name="estilo_culinario"required>
            <input type="text" placeholder="Descrição" name="descricao"required>
            <input type="time" placeholder="Horário de Funcionamento" name="horario"required>
            <input type="number" placeholder="Capacidade" name="capacidade"required>
            <button onclick="validar()">Enviar</button>
            <button onclick="window.location.href='index.php'">Voltar</button>
        </form>
        <script src="valida.js"></script>
    </div>
</body>

</html>