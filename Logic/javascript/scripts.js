const botonDirectivo = document.getElementById("directivo");
const botonMaestro = document.getElementById("maestro");
const imagenRolFormulario = document.getElementById("imagen-rol-formulario");
const textoRolFormulario = document.getElementById("texto-rol-formulario");
const rolSeleccionado = document.getElementById("rol-seleccionado");

botonDirectivo.addEventListener("click", function () {
    cambiarRol("Directivo");
});

botonMaestro.addEventListener("click", function () {
    cambiarRol("Maestro");
});

function cambiarRol(rol) {
    textoRolFormulario.textContent = rol;
    rolSeleccionado.value = rol;

    if (rol === 'Directivo') {
        imagenRolFormulario.src = './Style/Images/direc.png';
    } else {
        imagenRolFormulario.src = './Style/Images/maestra.png';
    }
}