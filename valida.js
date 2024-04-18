function valida() {
    // Seleciona os campos do formulário usando querySelectorAll
    var form = document.querySelector("form");
    var nome = form.querySelector("[name='nome']");
    var endereco = form.querySelector(".endereco");
    var dono = form.querySelector(".dono");
    var tel = form.querySelector(".telefone");
    var estilo = form.querySelector(".estilo_culinario");
    var des = form.querySelector(".descricao");
    var hora = form.querySelector(".horario");
    var cap = form.querySelector(".capacidade");
    
    // Função para verificar se um campo está vazio
    function isEmpty(str) {
        return !str || str.trim() === "";
    }

    // Validações
    if (isEmpty(nome.value)) {
        alert("Preencha o campo Nome");
        return false;
    } else if (isEmpty(endereco.value)) {
        alert("Insira o Endereço");
        return false;
    } else if (isEmpty(dono.value)) {
        alert("Digite o nome do Dono");
        return false;
    } else if (isEmpty(tel.value)) {
        alert("Insira o Telefone");
        return false;
    } else if (isEmpty(estilo.value)) {
        alert("Digite o estilo de comida");
        return false;
    } else if (isEmpty(des.value)) {
        alert("Insira uma descrição");
        return false;
    } else if (isEmpty(hora.value)) {
        alert("Insira o horário de funcionamento");
        return false;
    } else if (isEmpty(cap.value)) {
        alert("Digite a Capacidade");
        return false;
    }

    return true;
}
