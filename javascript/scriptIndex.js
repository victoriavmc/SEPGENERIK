const botonDirectivo = document.getElementById("directivo");
const botonMaestro = document.getElementById("maestro");
const imagenRolFormulario = document.getElementById('imagen-rol-formulario');
const textoRolFormulario = document.getElementById('texto-rol-formulario');

botonDirectivo.addEventListener("click", function () {
    cambiarRol("Directivo");
});

botonMaestro.addEventListener("click", function () {
    cambiarRol("Maestro");
});

function cambiarRol(rol) {
    if (rol === 'Directivo') {
        textoRolFormulario.textContent = rol;
        imagenRolFormulario.src = 'estilos/img/direc.png';
    } else {
        textoRolFormulario.textContent = rol;
        imagenRolFormulario.src = 'estilos/img/maestra.png';
    }
}