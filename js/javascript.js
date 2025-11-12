// Arquivo JavaScript com as ações visuais das  páginas

// Botão voltar de tela
function btn_voltar() {
    window.history.back();
}
//--------------------------------------------------------------/


// Notificação
const toast = document.querySelector(".notificacao");
(closeIcon = document.querySelector(".close"));
(progress = document.querySelector(".progresso"));

let timer1, timer2;

function notificar() {
    toast.classList.add("active");
    progress.classList.add("active");

    timer1 = setTimeout(() => {
        toast.classList.remove("active");
    }, 4000); //1s = 1000 milliseconds

    timer2 = setTimeout(() => {
        progress.classList.remove("active");
    }, 4300);
}

if (toast) {
    closeIcon.addEventListener("click", () => {
        toast.classList.remove("active");

        setTimeout(() => {
            progress.classList.remove("active");
        }, 300);

        clearTimeout(timer1);
        clearTimeout(timer2);
    });
}
//--------------------------------------------------------------/


// Dialog (Caixa de Confirmação)
const dialogo = document.querySelector('.dialogo');

if (dialogo) {
    document.querySelector('#cancelar').addEventListener('click', () => { dialogo.close() });
    document.querySelector('#confirmar').addEventListener('click', () => { dialogo.close() });
}

function dialog() {
    dialogo.show();
}
//--------------------------------------------------------------/


// Mudar ícone no select do cadastro de procedimento
function mudarIcone() {
    var select = document.getElementById("select");
    var valorIcone = select.options[select.selectedIndex].value;
    let icone = document.getElementById("icone");
    var classe = icone.getAttribute("class");

    icone.classList.remove(classe);
    icone.classList.add(valorIcone);
};
//--------------------------------------------------------------/


// Menu Mobile
const menu = document.querySelector("#menu");
const btn_menu = document.querySelector("#btn_menu");
const barra = document.querySelector("#barra_menu");
const btn_fechar = document.querySelector("#barra_menu #btn_menu");

if (btn_menu) {
    btn_menu.addEventListener("click", () => {
        setTimeout(() => {
            barra.style = "transform: translateX(-8px);";
        }, 10);
        menu.style = 'display: flex !important;';
    });

    btn_fechar.addEventListener("click", () => {
        setTimeout(() => {
            menu.style = 'display: none !important;';
        }, 400);
        barra.style = "transform: translateX(-100%);";
    });

    menu.addEventListener("click", (event) => {
        if (event.target === menu) {
            setTimeout(() => {
                menu.style = 'display: none !important;';
            }, 400);
            barra.style = "transform: translateX(-100%);";
        }
    });
}
//--------------------------------------------------------------/

// Dropdown
// function dropdown(){
//     var dropdown = document.getElementById("dropdown");

//     if(dropdown.style.display === 'flex'){
//         dropdown.style.display = 'none';
//     }else{
//         dropdown.style.display = 'flex';
//     } 
// }

// document.addEventListener('click', function(event) {
//     var divLogin = document.getElementById("div_login");
//     var dropdown = document.getElementById("dropdown");    
  
//     if (event.target !== divLogin && !divLogin.contains(event.target)) {
//       dropdown.style.display = 'none';
//     }
// });
//--------------------------------------------------------------/

function mascaraTelefone(event) {
    var telefone = event.target;
    var valor = telefone.value.replace(/\D/g, ''); // Remove caracteres não numéricos
    var formatoMascara = '(XX) XXXXX-XXXX';

    var i = 0;
    var mascara = formatoMascara.replace(/X/g, function() {
        return valor[i++] || '_';
    });

    telefone.value = mascara;
}
function mascaraCPF(event) {
    var CPF = event.target;
    var valor = CPF.value.replace(/\D/g, ''); // Remove caracteres não numéricos
    var formatoMascara = 'XXX.XXX.XXX-XX';

    var i = 0;
    var mascara = formatoMascara.replace(/X/g, function() {
        return valor[i++] || '_';
    });

    CPF.value = mascara;
}
function mascaraData(event) {
    var data = event.target;
    var valor = data.value.replace(/\D/g, ''); // Remove caracteres não numéricos
    var formatoMascara = 'XX-XX-XXXX';

    var i = 0;
    var mascara = formatoMascara.replace(/X/g, function() {
        return valor[i++] || '_';
    });

    data.value = mascara;
}   