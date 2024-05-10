const imgUsuario = document.getElementById('img-usuario');
const barraLateral = document.querySelector('.barra-lateral');
const nombre = document.querySelector('.nombre-usuario');
const rol = document.querySelector('.rol-usuario');
const nombreOpciones = document.querySelectorAll('.navegacion li p');
const cerrarSesion = document.querySelector('.cerrar-sesion');

imgUsuario.addEventListener('click', () => {
    barraLateral.classList.toggle("min-barra-lateral");
    nombre.classList.toggle("oculto");
    rol.classList.toggle("oculto");
    nombreOpciones.forEach(opcion => opcion.classList.toggle("oculto"));
    cerrarSesion.classList.toggle("oculto");
});