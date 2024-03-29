document.getElementById("cadastroForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário
    
    // Realiza a requisição AJAX para submeter o formulário
    var formData = new FormData(this);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "cadastrar.php", true); // Substitua "cadastrar.php" pelo nome do seu script PHP
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Verifica se o cadastro foi bem-sucedido
            if (xhr.responseText.trim() === "Cadastro realizado com sucesso!") {
                // Redireciona para a página home.html
                window.location.href = "home.html";
            } else {
                // Exibe mensagem de erro se houver algum problema no cadastro
                alert(xhr.responseText);
            }
        } else {
            alert("Erro ao processar a solicitação. Tente novamente mais tarde.");
        }
    };
    xhr.send(formData);
});