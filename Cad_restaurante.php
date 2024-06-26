<?php
include("includes/navbar.php");
include("Conexão.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php"); // Redireciona para a página de login se não estiver logado
    exit();
}
?>
<style>
    /* Estilos para inputs */
    .prato-item {
        border: none;
        background-color: transparent;
        padding: 0;
        width: 100%;
        color: white;
        font-family: inherit;
        font-size: inherit;
        cursor: pointer;
        text-align: left;
        /* Alinha o texto à esquerda */
    }

    .prato-item:focus {
        background-color: #333;
        /* Fundo escuro quando em foco */
        outline: none;
        /* Remove a borda de foco padrão */
    }


    .prato-item.prato-nome {
        border: none;
        background-color: transparent;
        padding: 0;
        width: 100%;
        color: white;
        /* Cor do texto do h3 */
        font-family: inherit;
        font-size: 1.5em;
        /* Tamanho de fonte do h3 */
        font-weight: bold;
        /* Negrito como em um h3 */
        cursor: pointer;
        text-align: left;
    }

    .prato-item.prato-nome:focus {
        background-color: #333;
        outline: none;
    }

    /* Estilo para o input de ingredientes */
    .prato-item.prato-paragrafo {
        border: none;
        background-color: transparent;
        padding: 0;
        width: 100%;
        color: #6c757d;
        /* Cor cinza do parágrafo */
        font-family: inherit;
        font-size: 1em;
        /* Tamanho de fonte do parágrafo */
        cursor: pointer;
        text-align: left;
    }

    .prato-item.prato-paragrafo:focus {
        background-color: #333;
        outline: none;
    }

    .form-control:focus {
        background-color: #24292e;
        color: white;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .form-control,
    .prato-item {
        font-family: 'Cormorant Garamond', serif;
    }

    input,
    textarea {
        font-family: 'Cormorant Garamond', serif;
    }
</style>
<br><br><br><br><br><br>
<div id="page">
    <div class="container mt-5">
        <form action="php/cad_restaurante_php.php" id="restauranteForm" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_restaurante" value="<?php echo $id_restaurante; ?>">

            <div class="row">
                <div class="col-md-4">
                    <div class="bg-dark text-white text-center p-3">
                        <label for="imagem">Foto do Restaurante:</label> <input type="file" name="imagem" id="imagem">
                        <small class="">A imagem será exibida após o envio.</small>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="mb-3">
                        <label for="nome" class="form-label text-white">Nome do Restaurante:</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label text-white">Descrição:</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                    </div>


                    <div class="col-12">
                        <label for="cardapio" class="form-label text-white">Cardápio:</label>
                        <div id="cardapio-container" class="list-group">
                        </div>
                        <button type="button" class="btn btn-secondary" id="add-prato">Adicionar Prato</button>
                    </div>








                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="endereco" class="form-label text-white">Endereço:</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" required>
                    </div>
                    <div class="mb-3">
                        <label for="estilo_culinario" class="form-label text-white">Estilo Culinário:</label>
                        <select class="form-control" id="estilo_culinario" name="estilo_culinario" required>
                            <option value="" disabled selected>Selecione um estilo</option>
                            <option value="Italiana">Italiana</option>
                            <option value="Japonesa">Japonesa</option>
                            <option value="Chinesa">Chinesa</option>
                            <option value="Brasileira">Brasileira</option>
                            <option value="Mexicana">Mexicana</option>
                            <option value="Indiana">Indiana</option>
                            <option value="Tailandesa">Tailandesa</option>
                            <option value="Francesa">Francesa</option>
                            <option value="Mediterrânea">Mediterrânea</option>
                            <option value="Árabe">Árabe</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="horario" class="form-label text-white">Horário de Funcionamento:</label>
                        <input type="text" class="form-control" id="horario" name="horario" placeholder="Ex: 08:00 - 18:00" title="O horário deve estar no formato 0800 - 1800" required>
                    </div>

                    <div class="mb-3">
                        <label for="capacidade" class="form-label text-white">Capacidade:</label>
                        <input type="number" class="form-control" id="capacidade" name="capacidade" value="<?php echo $row["capacidade"] ?? ''; ?>" pattern="[0-9]+" title="Apenas números são permitidos" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label text-white">Telefone:</label>
                        <input type="tel" class="form-control" id="telefone" name="telefone" value="<?php echo $row["telefone"] ?? ''; ?>" pattern="\([0-9]{2}\) [0-9]{4,5}-[0-9]{4}" title="Formato: (99) 9999-9999 ou (99) 99999-9999" required>
                    </div>
                </div>
            </div>
            <div class="mt-5 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" id="enviarBtn">Enviar para Aprovação</button>
            </div>
        </form>
    </div>
</div>











<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up22"></i></a>
</div>

<script>
    // ! Adiciona máscara ao input de horario
    const horarioInput = document.getElementById('horario');

    horarioInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        if (value.length > 8) {
            value = value.slice(0, 8);
        }

        if (value.length >= 5) {
            this.value = value.replace(/(\d{2})(\d{2})(\d{2})/, '$1:$2 - $3:');
        } else {
            this.value = value;
        }
    });

    // Evento keydown para detectar o Backspace
    horarioInput.addEventListener('keydown', function(event) {
        if (event.key === 'Backspace') {
            // Remove a máscara antes de apagar o caractere
            this.value = this.value.replace(/[-: ]/g, '');
        }
    });




    // ! Adiciona pratos ao cardápio
    const cardapioContainer = document.getElementById('cardapio-container');
    const addPratoButton = document.getElementById('add-prato');
    let pratoCount = 0;

    function adicionarPrato() {
        pratoCount++;

        const newPratoItem = `
                <div class="list-group-item list-group-item-action d-flex gap-3 py-3 bg-dark text-white mb-0" style="--bs-bg-opacity: .4;">
                    <div class="d-flex gap-2 w-100 justify-content-between">
                        <div>
                            <input type="text" class="form-control prato-item prato-nome" placeholder="Nome do Prato" name="pratos[${pratoCount}][nome]" readonly>
                            <input type="text" class="form-control prato-item prato-paragrafo" placeholder="Ingredientes" name="pratos[${pratoCount}][ingredientes]" readonly>
                        </div>
                        <div>
                            <div class="prato-preco-wrapper">
                                <input type="number" step="0.01" class="form-control prato-item prato-paragrafo prato-preco" placeholder="Preço" name="pratos[${pratoCount}][preco]" readonly>
                            </div>
                            <button type="button" class="btn btn-danger mt-1" onclick="removerPrato(this)">Remover</button>
                        </div>
                    </div>
                </div>`;
        cardapioContainer.insertAdjacentHTML('beforeend', newPratoItem);
    }

    function removerPrato(button) {
        button.parentNode.parentNode.parentNode.remove();
    }

    function validarPratoPreenchido() {
        const pratos = document.querySelectorAll('.list-group-item');
        for (let i = 0; i < pratos.length; i++) {
            const inputs = pratos[i].querySelectorAll('.prato-item');
            for (let j = 0; j < inputs.length; j++) {
                if (inputs[j].value.trim() === '') {
                    inputs[j].focus();
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: 'Por favor, preencha todos os campos do prato antes de adicionar um novo.',
                    });
                    return false;
                }
            }
        }
        return true;
    }

    addPratoButton.addEventListener('click', function() {
        if (validarPratoPreenchido()) {
            adicionarPrato();
        }
    });

    cardapioContainer.addEventListener('click', function(event) {
        const target = event.target;
        if (target.classList.contains('prato-item')) {
            target.readOnly = false;
            target.focus();
            target.addEventListener('blur', function() {
                this.readOnly = true;
            });
        }
    });

    const form = document.getElementById('restauranteForm');

    form.addEventListener('submit', function(event) {
        const pratos = document.querySelectorAll('.list-group-item');
        let pratoPreenchido = false;

        pratos.forEach(prato => {
            const inputs = prato.querySelectorAll('.prato-item');
            inputs.forEach(input => {
                if (input.value.trim() !== '') {
                    pratoPreenchido = true;
                }
            });

            // Verifica se todos os campos do prato estão preenchidos
            for (let i = 0; i < inputs.length; i++) {
                if (inputs[i].value.trim() === '') {
                    inputs[i].focus();
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: 'Por favor, preencha todos os campos de cada prato.',
                    });
                    event.preventDefault(); // Evita o envio do formulário
                    return;
                }
            }
        });

        if (!pratoPreenchido) {
            event.preventDefault(); // Evita o envio do formulário
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'É necessário cadastrar pelo menos um prato no cardápio.',
            });
        }
    });
</script>



<script src="js/jquery.min.js"></script>

<script src="js/jquery.easing.1.3.js"></script>

<script src="js/bootstrap.min.js"></script>

<script src="js/jquery.waypoints.min.js"></script>

<script src="js/jquery.stellar.min.js"></script>

<script src="js/jquery.flexslider-min.js"></script>

<script src="js/main.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.min.js"></script>


</body>

</html>