const page = document.getElementById('page');
const isMobile = window.matchMedia("(max-width: 768px)").matches;
const search = document.getElementById('busca');
const campo = document.getElementById('campo');
const selectElement = document.querySelector('tbody');

function nextPage() {
    page.value = parseInt(page.value) + 1;
    searchUser();
}

function previousPage() {
    if(Number(page.value > 1)){
        page.value = parseInt(page.value) - 1;
        searchUser();
    }else{
        alert("Primeira Pagina");
    }
}
function searchUser() {
    let item = search.value;
    if(item == ""){
        item = "%%";
    }
    // console.info(search.value.replace("%,**"));
    fetch(`../controllers/Ajax.php?method=getUsuariosFilterPage&param=${encodeURIComponent(campo.value)}~${encodeURIComponent(item)}~${encodeURIComponent(page.value)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao obter os dados: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            // console.log(data);

            if (data.length > 0) {
                
                selectElement.innerHTML = ""; // Limpa o select antes de preencher
                // const isMobile = window.matchMedia("(max-width: 768px)").matches;
                // Percorrer a lista de produtos e criar uma opção para cada produto
                data.forEach(usuario => {
                    const tr = document.createElement('tr');
                    // console.log(usuario);
                    if (!isMobile) {
                        tr.innerHTML += `<td>${usuario.nome}</td>`;
                    }
                    tr.innerHTML += `<td>${usuario.user}</td>`;
                    tr.innerHTML += `<td>${usuario.nivel}</td>`;
                    tr.innerHTML += `<td><a href="usuario.php?codigo=${usuario.id}"><img alt="Ícone de lápis"
                                src="../img/logo_editar.png" width="31px" height="30.25px" alt="" srcset=""></a></td>`;
                    selectElement.appendChild(tr); // Adiciona a opção ao select
                });
            }else{
                alert("Nada Encontrado");
            }

        })
        .catch(error => console.error('Erro ao obter os dados:', error));
}
// document.addEventListener("onload", getEnd());
document.addEventListener("DOMContentLoaded", function(){
    const theadElement = document.querySelector('thead');
    const tr1 = document.createElement('tr');
    if (!isMobile) {
        tr1.innerHTML += `<th>Nome</th>`;
    }
    tr1.innerHTML += `<th>User</th>`;
    tr1.innerHTML += `<th>Nivel</th>`;
    tr1.innerHTML += `<th>Alterar</th>`;
    theadElement.appendChild(tr1);
    searchUser();
});