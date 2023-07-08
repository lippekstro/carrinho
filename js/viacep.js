var campoCep = document.getElementById('zip');

campoCep.addEventListener('change', () => {
    var url = `https://viacep.com.br/ws/${campoCep.value}/json/`;

    // Fazendo a solicitação HTTP
    var request = new XMLHttpRequest();
    request.open('GET', url, true);

    request.onload = function() {
        if (request.status >= 200 && request.status < 400) {
            // Sucesso na solicitação
            var data = JSON.parse(request.responseText);

            // Atualizando os campos com os valores recebidos
            document.getElementById('logradouro').value = data.logradouro;
            document.getElementById('bairro').value = data.bairro;
           /* document.getElementById('cidade').value = data.localidade;
            document.getElementById('estado').value = data.uf; */
        } else {
            // Erro na solicitação
            console.error('Erro na solicitação. Status:', request.status);
        }
    };

    request.onerror = function() {
        console.error('Erro na solicitação. Falha de rede.');
    };

    request.send();
});

