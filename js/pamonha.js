function teste(teste, teste22){
    alert(teste + teste22);
}


function mostraNotificacao(mensagem, icon) {
    // Remover notificações antigas
    const notificacoesAntigas = document.querySelectorAll(".notificacao");
    notificacoesAntigas.forEach((notificacao) => notificacao.remove());

    // Definir a classe com base no tipo
    let classeTipo = "padrao";
    if (icon == "x") {
        classeTipo = "erro";
    } else if (icon === "exclamation") {
        classeTipo = "alerta";
    } else if (icon === "check") {
        classeTipo = "check";
    }

    // Adicionar o novo elemento com a classe definida pelo tipo
    document.body.innerHTML +=
        '<div class="notificacao ' + classeTipo + ' active">' +
            '<div class="notificacao-content">' +
                '<i class="bi bi-' + icon + '-lg ' + classeTipo + '-icone icone" style="font-size: 25px;"></i>' +
                '<div class="mensagem">' +
                '<span class="' + classeTipo + '-texto">' + mensagem + '</span>' +
                '</div>' +
            '</div>' +
            '<i class="bi bi-x-lg close"></i>' +
            '<div class="progresso active"></div>' +
        '</div>';

    // Chamar a função notifica() (assumindo que ela está definida em outro lugar)
    top = notifica();
}


function notifica() {
    const toast = document.querySelector(".notificacao");
    (closeIcon = document.querySelector(".close"));
    (progress = document.querySelector(".progresso"));

    let timer1, timer2;
    toast.classList.add("active");
    progress.classList.add("active");

    timer1 = setTimeout(() => {
        toast.classList.remove("active");
    }, 4000); //1s = 1000 milliseconds

    timer2 = setTimeout(() => {
        progress.classList.remove("active");
        progress.remove();
        toast.remove();
    }, 5000);



    if (toast) {
        closeIcon.addEventListener("click", () => {
            toast.classList.remove("active");

            setTimeout(() => {
                progress.classList.remove("active");
                progress.remove();
                toast.remove();
            }, 300);

            clearTimeout(timer1);
            clearTimeout(timer2);
        });
    }

    return 'Certo';
}