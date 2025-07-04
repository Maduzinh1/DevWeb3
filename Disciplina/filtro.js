function mostrarOuOcultarBusca() {
    const tipoSelect = document.getElementById('tipo');
    const buscaInput = document.getElementById('busca');
    const buscaLabel = document.getElementById('busca-label');
    if (tipoSelect.value === "0") {
        buscaInput.style.display = 'none';
        if (buscaLabel) buscaLabel.style.display = 'none';
    } else {
        buscaInput.style.display = '';
        if (buscaLabel) buscaLabel.style.display = '';
    }
}

document.addEventListener('DOMContentLoaded', mostrarOuOcultarBusca);