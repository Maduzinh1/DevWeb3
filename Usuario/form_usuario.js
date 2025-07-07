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
        document.getElementById('salario').style.display = '';
        document.getElementById('salario-label').style.display = '';
        document.getElementById('nomeResponsavel').style.display = 'none';
        document.getElementById('nomeResponsavel-label').style.display = 'none';
        document.getElementById('quebra-linha1').style.display = '';
        document.getElementById('quebra-linha2').style.display = '';
    } else if (valorSelecionado === "2") {
        document.getElementById('salario').style.display = 'none';
        document.getElementById('salario-label').style.display = 'none';
        document.getElementById('nomeResponsavel').style.display = '';
        document.getElementById('nomeResponsavel-label').style.display = '';
        document.getElementById('quebra-linha1').style.display = '';
        document.getElementById('quebra-linha2').style.display = '';
    } else {
        document.getElementById('salario').style.display = 'none';
        document.getElementById('salario-label').style.display = 'none';
        document.getElementById('nomeResponsavel').style.display = 'none';
        document.getElementById('nomeResponsavel-label').style.display = 'none';
        document.getElementById('quebra-linha1').style.display = 'none';
        document.getElementById('quebra-linha2').style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', mostrarOuOcultarTipos);