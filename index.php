<?php
if (!isset($_SESSION)) {
    session_start();
}

require "./clases/usuarios.php";
include './estilos/templates/barraSuperior.php'
?>

<!-- P1 -->
<section class="informacion">
    <!-- Informacion del Colegio -->
    <div class="nombre-colegio">
        <h1 class="texto-nombre"></h1>
    </div>
    <!-- Links Externos -->
    <div class="contacto">
        <div class="cuadro">
            <a href="./pagInex.php" target="">
                <img class="logo-contacto" src="estilos/img/PagInstitucional.jpeg" Datos del Escuela">
            </a>
            <a href="https://www.youtube.com/channel/UCH0NoMWB6_53WwK14RJALCA" target="_blank">
                <img class="logo-contacto" src="estilos/img/youtuber.png" alt="Tutorial de como usar la pagina">
            </a>
        </div>
    </div>
</section>

<main class="main">
    <div class="overlay"></div>
    <div class="contenido">
        <div class="contenido-titulo"> <!-- contenido-titulo -->
            <h1 class="SEP">Sistema Educativo Primario</h1>
            <h1 class="SEP">-</h1>
            <h1 class="SEP">Generik</h1>
        </div>
        <div class="contenido-inicio">
            <div class="roles">
                <div class="rol-directivo">
                    <button id="directivo" class="button-rol">
                        <img class="imagen-rol" src="estilos/img/direc.png" alt="">
                        <p class="texto-rol">Directivo</p>
                    </button>
                </div>
                <div class="rol-maestro">
                    <button id="maestro" class="button-rol">
                        <img class="imagen-rol" src="estilos/img/maestra.png" alt="">
                        <p class="texto-rol">Maestro</p>
                    </button>
                </div>
            </div>
            <div class="fondo-formulario">
                <div class="formulario">
                    <div class="formulario-titulo">
                        <img id="imagen-rol-formulario" class="imagen-rol-inicio" src="estilos/img/maestra.png" alt="Maestros">
                        <h2 id="texto-rol-formulario" class="texto-rol-inicio">Maestro</h2>
                    </div>
                    <div class="formulario-campos">
                        <form action="" method="POST">
                            <label for="usuario">Usuario</label>
                            <input type="usuario" name="usuario" id="usuario" required>
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" id="password" required>
                            <a class="recuperar-cuenta" href="">Olvide la Contraseña</a>
                            <div class="boton-centrar">
                                <input class="boton" type="submit" value="Iniciar sesion">
                            </div>
                        </form> <!-- campos -->
                    </div> <!-- formulario-campos -->
                </div> <!-- formulario -->
            </div> <!-- fondo formulario -->
        </div> <!-- contenido-inicio -->
    </div> <!-- contenedor -->
</main>
<script src="./javascript/scriptIndex.js"></script>
<?php require "estilos/templates/barraInferior.php"; ?>