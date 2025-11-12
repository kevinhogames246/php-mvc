const page = document.getElementById('page');
const isMobile = window.matchMedia("(max-width: 768px)").matches;
const search = document.getElementById('busca');
const campo = document.getElementById('campo');
const selectElement = document.querySelector('tbody');
const theadElement = document.querySelector('thead');
const tr1 = document.createElement('tr');

function nextPage() {
    page.value = parseInt(page.value) + 1;
    searchMov();
}

function previousPage() {
    if (Number(page.value > 1)) {
        page.value = parseInt(page.value) - 1;
        searchMov();
    } else {
        alert("Primeira Pagina");
    }
}

function searchMov() {
    let item = search.value.replaceAll("%", "**");
    if (item == "") {
        item = "****";
    }
    fetch(`../controllers/Ajax.php?method=getMovimentosFilterPage&param=${encodeURIComponent(campo.value)}~${encodeURIComponent(item)}~${encodeURIComponent(page.value)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao obter os dados: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            let url = window.location.href;
            if (data.length > 0) {

                selectElement.innerHTML = ""; // Limpa o select antes de preencher
                // const isMobile = window.matchMedia("(max-width: 768px)").matches;
                // Percorrer a lista de produtos e criar uma opção para cada produto
                data.forEach(movimento => {
                    const tr = document.createElement('tr');
                    // console.log(movimento);
                    tr.innerHTML += `<td><a href="estoques.php?codigo=${movimento.eCodigo}">${movimento.eCodigo}</a></td>`;
                    tr.innerHTML += `<td>${movimento.pCodigo}</td>`;
                    if (!isMobile && !(url.includes("index") || url.endsWith("/"))) {
                        tr.innerHTML += `<td>${movimento.nome}</td>`;
                    }
                    tr.innerHTML += `<td>${movimento.peso}</td>`;
                    tr.innerHTML += `<td>${movimento.tipo}</td>`;
                    if (!(url.includes("index") || url.endsWith("/"))) {
                        tr.innerHTML += `<td>${movimento.usuario}</td>`;
                    }
                    // tr.innerHTML += `<td><a href="movimentar.php?codigo=${movimento.codigo}"><img alt="Ícone de lápis"
                    //             src="../img/logo_editar.png" width="31px" height="30.25px" alt="" srcset=""></a></td>`;
                    selectElement.appendChild(tr); // Adiciona a opção ao select
                });
            } else {
                if (!(url.includes("index") || url.endsWith("/"))) {
                    alert("Ultima Pagina");
                    previousPage();
                } else {
                    theadElement.innerHTML = "<tr><td>sem movimentos</td><tr>";
                }
            }

        })
        .catch(error => console.error('Erro ao obter os dados:', error));
}

// document.addEventListener("onload", searchMov());
document.addEventListener("DOMContentLoaded", function () {
    let url = window.location.href;

    tr1.innerHTML += `<th>Estoque</th>`;
    tr1.innerHTML += `<th>Codigo Produto</th>`;
    if (!isMobile && !(url.includes("index") || url.endsWith("/"))) {
        tr1.innerHTML += `<th>Produto</th>`;
    }
    tr1.innerHTML += `<th>peso (Kg)</th>`;
    tr1.innerHTML += `<th>Tipo</th>`;
    if (!(url.includes("index") || url.endsWith("/"))) {

        tr1.innerHTML += `<th>Usuário</th>`;
    }
    theadElement.appendChild(tr1);
    searchMov();

});