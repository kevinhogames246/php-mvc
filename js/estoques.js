const page = document.getElementById('page');
const isMobile = window.matchMedia("(max-width: 768px)").matches;
const search = document.getElementById('busca');
const campo = document.getElementById('campo');
const selectElement = document.querySelector('tbody');

function nextPage() {
    page.value = parseInt(page.value) + 1;
    getEnd();
}

function previousPage() {
    if (Number(page.value > 1)) {
        page.value = parseInt(page.value) - 1;
        getEnd();
    } else {
        alert("Primeira Pagina");
    }
}
function searchEnd() {
    // console.info(search.value.replace("%,**"));
    let item = search.value.replaceAll("%", "**");
    if (item == "") {
        item = "****";
    }

    fetch(`../controllers/Ajax.php?method=getEnderecosFilterPage&param=${encodeURIComponent(campo.value)}~${encodeURIComponent(item)}~${encodeURIComponent(page.value)}`)
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
                selectElement.innerHTML = ""; // Limpa o select antes de preencher
                // const isMobile = window.matchMedia("(max-width: 768px)").matches;
                // Percorrer a lista de produtos e criar uma opção para cada produto
                data.forEach(endereco => {
                    const tr = document.createElement('tr');
                    // console.log(endereco);
                    tr.innerHTML += `<td>${endereco.codigo}</td>`;
                    tr.innerHTML += `<td>${endereco.codigo_produto}</td>`;
                    if (!isMobile && !(url.includes("index") || url.endsWith("/"))) {
                        tr.innerHTML += `<td>${endereco.nome}</td>`;
                    }
                    tr.innerHTML += `<td>${endereco.peso}</td>`;
                    tr.innerHTML += `<td><a href="movimentos.php?codigo=${endereco.codigo}"><img alt="Ícone de lápis"
                                src="../img/logo_visualizar.png" width="31px" height="30.25px" alt="" srcset=""></a></td>`;
                    if (!(url.includes("index") || url.endsWith("/"))) {

                        tr.innerHTML += `<td><a href="movimentar.php?codigo=${endereco.codigo}"><img alt="Ícone de lápis"
                       src="../img/logo_editar.png" width="31px" height="30.25px" alt="" srcset=""></a></td>`;
                    }
                    selectElement.appendChild(tr); // Adiciona a opção ao select
                });
            } else {
                if(!(url.includes("index") || url.endsWith("/"))){
                    alert("Ultima Pagina");
                    previousPage();
                }
            }

        })
        .catch(error => console.error('Erro ao obter os dados:', error));
}
// document.addEventListener("onload", getEnd());
document.addEventListener("DOMContentLoaded", function () {
    const theadElement = document.querySelector('thead');
    let url = window.location.href;
    const tr1 = document.createElement('tr');
    tr1.innerHTML += `<th>Endereço</th>`;
    tr1.innerHTML += `<th>Codigo Produto</th>`;
    if (!isMobile && !(url.includes("index") || url.endsWith("/"))) {
        tr1.innerHTML += `<th>Produto</th>`;
    }
    tr1.innerHTML += `<th>peso (Kg)</th>`;
    tr1.innerHTML += `<th>Visualizar</th>`;
    if (!(url.includes("index") || url.endsWith("/"))) {
        tr1.innerHTML += `<th>Movimentar</th>`;
    }
    theadElement.appendChild(tr1);
    searchEnd();
});