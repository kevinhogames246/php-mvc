const page = document.getElementById('page');
const isMobile = window.matchMedia("(max-width: 768px)").matches;

function nextPage() {
    page.value = parseInt(page.value) + 1;
    getProd();
}

function previousPage() {
    if (Number(page.value > 1)) {
        page.value = parseInt(page.value) - 1;
        getProd();
    } else {
        alert("Primeira Pagina");
    }
}
function getProd() {
    
    // console.log(page); 
    fetch(`../controllers/Ajax.php?method=getAllProdutosPage&param=${encodeURIComponent(page.value)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao obter os dados: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            // console.log(data);
            if (data.length > 0) {

                let url = window.location.href;
                const selectElement = document.querySelector('tbody');
                selectElement.innerHTML = ""; // Limpa o select antes de preencher
                // Percorrer a lista de produtos e criar uma opção para cada produto
                data.forEach(produto => {
                    const tr = document.createElement('tr');
                    // console.log(endereco);
                    tr.innerHTML += `<td>${produto.codigo}</td>`;
                    console.log(window.location.href.includes("index"));
                    if (!isMobile && !(url.includes("index") || url.endsWith("/"))) {
                        tr.innerHTML += `<td>${produto.nome}</td>`;
                    }
                    tr.innerHTML += `<td>${produto.peso}</td>`;
                    tr.innerHTML += `<td><a href="estoques.php?codigo=${produto.codigo}&campo=2"><img alt="Ícone de lápis"
                                src="../img/logo_visualizar.png" width="31px" height="30.25px" alt="" srcset=""></a></td>`;
                    selectElement.appendChild(tr); // Adiciona a opção ao select
                });
            } else {
                alert("Ultima Pagina");
                previousPage();
            }

        })
        .catch(error => console.error('Erro ao obter os dados:', error));
}


document.addEventListener("DOMContentLoaded", function () {
    const theadElement = document.querySelector('thead');
    const tr1 = document.createElement('tr');
    tr1.innerHTML += `<th>Codigo Produto</th>`;
    let url = window.location.href;
    if (!isMobile && !(url.includes("index") || url.endsWith("/"))) {
        tr1.innerHTML += `<th>Produto</th>`;
    }
    tr1.innerHTML += `<th>peso (Kg)</th>`;
    tr1.innerHTML += `<th>Visualizar</th>`;
    theadElement.appendChild(tr1);
    getProd();
});