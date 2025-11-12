const id = document.getElementById("id");
const nome = document.getElementById("nome");
const usuario = document.getElementById("usuario");
const nivel = document.getElementById("nivel");
function searchUser() {
    if (id.value != "") {
        fetch(`../controllers/Ajax.php?method=getUsuarioById&param=${encodeURIComponent(id.value)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao obter os dados: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                nome.value = data.nome;
                usuario.value = data.usuario;
                nivel.value = data.nivel;
            })
            .catch(error => console.error('Erro ao obter os dados:', error));

    }
}

document.addEventListener("DOMContentLoaded", function () {
    searchUser();
});