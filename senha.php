<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senha</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="css/senha.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="Caixa-Senha">
        <div class="Senha">
            <h2><i class="fa-solid fa-right-to-bracket"></i> Esqueci Senha</h2>
            <input type="password" id="nova_senha" placeholder="Nova Senha">
            <input type="password" id="confirmar_senha" placeholder="Confirmar Nova Senha">
            <button onclick="Validar()">Validar</button>
            <button onclick="window.location.href = 'login.php'">Voltar</button>
        </div>
    </div>

    <script>
        function successAlert(message) {
            Swal.fire({
                title: 'Sucesso',
                text: message,
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'login.php';
            });
        }

        function errorAlert(message) {
            Swal.fire('Erro', message, 'error');
        }

        function Validar() {
            var novaSenha = document.getElementById('nova_senha').value;
            var confirmarSenha = document.getElementById('confirmar_senha').value;

            if (novaSenha === '' || confirmarSenha === '') {
                errorAlert('Por favor, preencha ambos os campos de senha.');
                return;
            }

            if (novaSenha !== confirmarSenha) {
                errorAlert('As senhas não coincidem.');
                return;
            }

            var passwordErrors = validatePassword(novaSenha);

            if (passwordErrors.length > 0) {
                errorAlert(passwordErrors.join(' '));
                return;
            }

            // Envio da senha para o servidor
            fetch('processar_senha.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ senha: novaSenha })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    successAlert('Senha alterada com sucesso!');
                } else {
                    errorAlert(data.message || 'Erro ao alterar a senha.');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                errorAlert('Erro ao alterar a senha. Verifique sua conexão e tente novamente.');
            });
        }

        function validatePassword(password) {
            var errors = [];

            if (password.length < 8) {
                errors.push('A senha deve ter pelo menos 8 caracteres.');
            }
            if (!/[A-Z]/.test(password)) {
                errors.push('A senha deve conter pelo menos uma letra maiúscula.');
            }
            if (!/[a-z]/.test(password)) {
                errors.push('A senha deve conter pelo menos uma letra minúscula.');
            }
            if (!/[0-9]/.test(password)) {
                errors.push('A senha deve conter pelo menos um número.');
            }
            if (!/[\W]/.test(password)) {
                errors.push('A senha deve conter pelo menos um caractere especial.');
            }

            return errors;
        }
    </script>
</body>
</html>


