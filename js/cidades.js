const ulrUf = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados';
const uf = document.getElementById("selectEstado");
const cidade = document.getElementById("selectCidade");
const EstadoAtual = document.getElementById("EstadoAtual").value;

uf.addEventListener('change', async ()=>{
    const urlCidades = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/' + uf.value + '/municipios';
    const request = await fetch(urlCidades);
    const response = await request.json();

    let options = '';
    response.forEach(function(cidadeObj){
        options += '<option>' + cidadeObj.nome + '</option>';
    });

    cidade.innerHTML = options;

})

window.addEventListener('load', async ()=>{
    const request = await fetch(ulrUf);
    const response = await request.json();

    // console.log('teste');

    const options = document.createElement("optgroup");
    // options.setAttribute('label', 'UFs');
    response.forEach(function(ufObj){
        let cond = '';
        if (EstadoAtual === ufObj.sigla) {
             cond = ' selected';
            };
        options.innerHTML += '<option' + cond + '>' + ufObj.sigla + '</option>';
    });

    uf.append(options);
})