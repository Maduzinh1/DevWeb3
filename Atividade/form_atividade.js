function mostrarOuOcultarTipos() {
    const tipoRadios = document.getElementsByName('tipo');
    let valorSelecionado = '';
    for (const radio of tipoRadios) {
        if (radio.checked) {
            valorSelecionado = radio.value;
            break;
        }
    }

    if (valorSelecionado === "1") {
        document.getElementById('recuperacao').style.display = '';
        document.getElementById('recuperacao-label').style.display = '';
        document.getElementById('equipe').style.display = 'none';
        document.getElementById('equipe-label').style.display = 'none';
        document.getElementById('quebra-linha1').style.display = '';
        document.getElementById('quebra-linha2').style.display = '';
    } else if (valorSelecionado === "2") {
        document.getElementById('recuperacao').style.display = 'none';
        document.getElementById('recuperacao-label').style.display = 'none';
        document.getElementById('equipe').style.display = '';
        document.getElementById('equipe-label').style.display = '';
        document.getElementById('quebra-linha1').style.display = '';
        document.getElementById('quebra-linha2').style.display = '';
    } else {
        document.getElementById('recuperacao').style.display = 'none';
        document.getElementById('recuperacao-label').style.display = 'none';
        document.getElementById('equipe').style.display = 'none';
        document.getElementById('equipe-label').style.display = 'none';
        document.getElementById('quebra-linha1').style.display = 'none';
        document.getElementById('quebra-linha2').style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', mostrarOuOcultarTipos);