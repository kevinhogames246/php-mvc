// Arquivo JavaScript com as ações visuais das  páginas

// Modo Dark
document.body.style = "background-color: var(--bs-dark);transition: 0.5s;"
const sun = "https://www.uplooder.net/img/image/55/7aa9993fc291bc170abea048589896cf/sun.svg";
const moon = "https://www.uplooder.net/img/image/2/addf703a24a12d030968858e0879b11e/moon.svg";

const root = document.querySelector(":root");
const container = document.querySelector(".theme-container");
const container2 = document.querySelector("#menu .theme-container");
const themeIcon = document.getElementById("theme-icon");
const themeIcon2 = document.querySelector("#menu #theme-icon");
var theme = localStorage.getItem("theme", "dark");

if (container) {
    setTheme(theme);

    container.addEventListener("click", () => {
        theme = theme === "dark" ? "light" : "dark";
        setTheme(theme);
        localStorage.setItem("theme", theme);
    });
    container.addEventListener("keyup", (event) => {
        if (event.key === "Enter") {
            theme = theme === "dark" ? "light" : "dark";
            setTheme(theme);
            localStorage.setItem("theme", theme);
        }
    });
    container2.addEventListener("click", () => {
        theme = theme === "dark" ? "light" : "dark";
        setTheme(theme);
        localStorage.setItem("theme", theme);
    });

    function setTheme(theme) {
        if (theme === "dark") {
            setDark();
        } else {
            setLight();
        }
    }

    function setLight() {
        root.style.setProperty("--bs-dark", "white");
        root.style.setProperty("--bs-text-color", "black");
        container.classList.remove("shadow-dark");
        container2.classList.remove("shadow-dark");
        setTimeout(() => {
            container.classList.add("shadow-light");
            container2.classList.add("shadow-light");
            themeIcon.classList.remove("change");
            themeIcon2.classList.remove("change");
        }, 300);
        themeIcon.classList.add("change");
        themeIcon2.classList.add("change");
        themeIcon.src = sun;
        themeIcon2.src = sun;
    }

    function setDark() {
        root.style.setProperty("--bs-dark", "#000000");
        root.style.setProperty("--bs-text-color", "white");
        container.classList.remove("shadow-light");
        container2.classList.remove("shadow-light");
        setTimeout(() => {
            container.classList.add("shadow-dark");
            container2.classList.add("shadow-dark");
            themeIcon.classList.remove("change");
            themeIcon2.classList.remove("change");
        }, 300);
        themeIcon.classList.add("change");
        themeIcon2.classList.add("change");
        themeIcon.src = moon;
        themeIcon2.src = moon;

    }
}
//--------------------------------------------------------------/


// Botão Toggle Login
function toggle_login() {
    var campLogin = document.querySelector('#campos_login');
    var campConsulta = document.querySelector('#campo_consultar');

    if (campConsulta.style.display === 'none') {
        campConsulta.style.display = 'block';
        campLogin.style.display = 'none';
    } else {
        campConsulta.style.display = 'none';
        campLogin.style.display = 'block';
    }
}

function tabToggle() {
    var checkbox = document.querySelector("#checkbox");

    if (checkbox.checked) {
        checkbox.checked = false;
        toggle_login();
    }
    else {
        checkbox.checked = true;
        toggle_login();
    }
}
//--------------------------------------------------------------/


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
function dropdown(){
    var dropdown = document.getElementById("dropdown");

    if(dropdown.style.display === 'flex'){
        dropdown.style.display = 'none';
    }else{
        dropdown.style.display = 'flex';
    } 
}

document.addEventListener('click', function(event) {
    var divLogin = document.getElementById("div_login");
    var dropdown = document.getElementById("dropdown");    
  
    if (event.target !== divLogin && !divLogin.contains(event.target)) {
      dropdown.style.display = 'none';
    }
});
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