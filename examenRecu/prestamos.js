document.getElementById('fechaPrestamo').addEventListener('change', function() {
    const prestamo = document.getElementById('fechaPrestamo').value;
    const retorno = document.getElementById('fechaRetorno').value;
    if (prestamo && retorno) {
        const dias = Math.floor((new Date(retorno) - new Date(prestamo)) / (1000 * 60 * 60 * 24));
        document.getElementById('resultado').textContent = 'Días de préstamo: ' + dias;
    }
});

document.getElementById('fechaRetorno').addEventListener('change', function() {
    const prestamo = document.getElementById('fechaPrestamo').value;
    const retorno = document.getElementById('fechaRetorno').value;
    if (prestamo && retorno) {
        const dias = Math.floor((new Date(retorno) - new Date(prestamo)) / (1000 * 60 * 60 * 24));
        document.getElementById('resultado').textContent = 'Días de préstamo: ' + dias;
    }
});
