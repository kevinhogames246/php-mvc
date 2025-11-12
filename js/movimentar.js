function limparEnd() {
    // console.log("asd");
    document.getElementById("end").value = '';
}

function getProdutos() {
    const endereco = document.getElementById("end").value;
    fetch('../controllers/Ajax.php?method=getAllProdutosCampos&param=id~nome~codigo')
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao obter os dados: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            const selectElement = document.querySelector('#prod');
            selectElement.innerHTML = ""; // Limpa o select antes de preencher

            const isMobile = window.matchMedia("(max-width: 768px)").matches;
            console.log(window.matchMedia("(max-width: 768px)"));
            // Percorrer a lista de produtos e criar uma opção para cada produto
            data.forEach(produto => {
                const option = document.createElement('option');
                option.value = produto.id;
                option.textContent = `${produto.codigo}`; // id e nome para telas maiores
                if(!isMobile){
                option.innerHTML += `<spam class="prod-nome"> - ${produto.nome}</spam>`;
                }
                selectElement.appendChild(option); // Adiciona a opção ao select
            });
            if (endereco!='') {
                getProdutoByEnd();
            }
            selectElement.value = null;
        })
        .catch(error => console.error('Erro ao obter os dados:', error));
    // limparEnd();
}
function getProdutoByEnd() {

    const endereco = document.getElementById("end").value;
    fetch(`../controllers/Ajax.php?method=getProdutoByEnderecoCod&param=${encodeURIComponent(endereco)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao obter os dados: ' + response.status);
            }
            return response.json();
        })
        .then(data => {

            const selectElement = document.getElementById('prod');
            const quantElement = document.getElementById('quant');

            console.log(data.id);

            selectElement.value = data.id;
            quantElement.value = data.peso;
        })
        .catch(error => console.error('Erro ao obter os dados:', error));
    // limparEnd();
}

function checkEnd() {
    const endereco = document.getElementById("end").value;
    const produto = document.getElementById('prod').value;
    let quantidade = document.getElementById('quant');
    const tipo = document.getElementById('tipo');
    const tipoEnt = document.getElementById('ent');
    const tipoSai = document.getElementById('sai');


    if (endereco != "") {
        fetch(`../controllers/Ajax.php?method=checkProdutoInEndereco&param=${encodeURIComponent(produto)}~${encodeURIComponent(endereco)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao obter os dados: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                // console.log(data);

                tipoSai.disabled = false;
                if (data === false) {
                    limparEnd();
                    quantidade.value = 0;
                    alert("Esse endereco não existe");
                } else if (Number.isFinite(data)) {
                    // console.log(quantidade.value);
                    quantidade.value = Number.parseFloat(data);
                } else if (data === true) {
                    tipo.value = 'Entrada';
                    tipoSai.disabled = true;
                    quantidade.value = 0;
                } else {
                    alert(data);
                    limparEnd();
                    quantidade.value = 0;
                }
            })
            .catch(error => console.error('Erro ao obter os dados:', error));

    }
}