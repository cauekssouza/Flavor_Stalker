function Validar() {
    var novaSenha = document.getElementById('nova_senha').value;
    var confirmarSenha = document.getElementById('confirmar_senha').value;

    if (novaSenha === '' || confirmarSenha === '') {
        Swal.fire('Erro', 'Por favor, preencha ambos os campos de senha.', 'error');
        return;
    }

    if (novaSenha !== confirmarSenha) {
        Swal.fire('Erro', 'As senhas não coincidem.', 'error');
        return;
    }

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
            Swal.fire('Sucesso', 'Senha alterada com sucesso!', 'success').then(() => {
                window.location.href = 'login.php';
            });
        } else {
            Swal.fire('Erro', 'Erro ao alterar a senha.', 'error');
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        Swal.fire('Erro', 'Erro ao alterar a senha.', 'error');
    });
}