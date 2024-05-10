<?php
if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION["Login"];
if (!$auth) {
    header('Location: ./');
}
require "./estilos/templates/barraSuperior.php";
?>

<div class="contenedor-pagina">
    <div class="barra-lateral min-barra-lateral">
        <div class="nombre-pagina">
            <img id="img-usuario" class="imagen-usuario" src="./estilos/img/admin.jpeg" alt="">
            <div class="nombres">
                <h3 class="rol-usuario oculto">administrador</h3>
                <p class="nombre-usuario oculto"><?php echo $_SESSION['Usuario'] ?></p>
            </div>
            <a class="cerrar-sesion oculto" href="cerrarSesion.php">
                <img class="imagen-salir" src="./estilos/img/Salir.png" alt="">
            </a>
        </div>
        <nav class="navegacion">
            <ul>
                <li>
                    <img src="./estilos/img/directivos.png" alt="">
                    <p class="oculto">Directivos</p>
                </li>
                <li>
                    <img src="./estilos/img/maestros.png" alt="">
                    <p class="oculto">Maestros</p>
                </li>
                <li>
                    <img src="./estilos/img/estudiantes.png" alt="">
                    <p class="oculto">Estudiantes</p>
                </li>
                <li>
                    <img src="./estilos/img/DatosInstitucionales.png" alt="">
                    <p class="oculto">Datos institucionales</p>
                </li>
                <li>
                    <img src="./estilos/img/Datos Maestros.png" alt="">
                    <p class="oculto">Distribución Docente</p>
                </li>
                <li>
                    <img src="./estilos/img/pizarra.png" alt="">
                    <p class="oculto">Grados</p>
                </li>
                <li>
                    <img src="./estilos/img/materias.png" alt="">
                    <p class="oculto">Materias</p>
                </li>
                <li>
                    <img src="./estilos/img/report.png" alt="">
                    <p class="oculto">Reportes</p>
                </li>
                <li>
                    <img src="./estilos/img/historial.png" alt="">
                    <p class="oculto">Registro Estudiantes</p>
                </li>
                <li>
                    <img src="./estilos/img/adminMovimientos.png" alt="">
                    <p class="oculto">Movimientos</p>
                </li>
            </ul>
        </nav>
    </div>
    <div class="contenido-principal">
    </div>
</div>

<footer>
    <div class="pie-pagina">
        <p>Sistema Educativo Primario Generik</p>
    </div>
</footer>


<script src="./javascript/script.js"></script>
</body>

</html>