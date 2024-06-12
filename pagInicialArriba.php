<?php
include './Logic/Connection/conexion.php';
session_start();

if ($_SESSION['login'] !== true) {
    header('location:  ../index.php');
} else {
    $usuario = $_SESSION['usuario'];
    $rol = $_SESSION['rol'];
    $id = $_SESSION['IdUsu'];
}
?>

<body class='divisionHorizontal2'>
    <div class='encabezado'>
        <?php
        $template_path = './cabeceraPrincipal.php';
        include $template_path;
        ?>
    </div>
    <div class='divisionVertical2NoProporcional'>
        <div class='ladoIzq30'>
            <div class='navegadorIzq'>
                <div class='Perfil'>
                    <div class='fotito'>
                        <img src="../Style/Images/usuario.png" alt="user">
                    </div>
                    <div class='textoPerfil'>
                        <div class="usuario">
                            <h1> <?php echo $rol ?></h1>
                        </div>
                        <div class="nombre">
                            <h2><?php echo $usuario ?></h2>
                        </div>
                    </div>
                    <div class='editarPerfil'>
                        <a <?php if ($rol === 'Administrador') { ?> href="./pagModificarDatosADMIN.php" <?php } else { ?> href="./pagModificarDatosPersona.php" <?php } ?>> <img src="../Style/Images/modificarDatos.png" alt="modificar"></a>
                        <a href="../Logic/PHP/cerrarSesion.php"><img src="../Style/Images/salir.png" alt="salir"></a>
                    </div>
                </div>
                <div class='lista'>
                    <div class="opcion">
                        <a class="opcion-lista" href="./Datosinstitucionales.php">
                            <img src="../Style/Images/instiDato.png" alt="instituto dato">
                            <p>Datos Institucionales</p>
                        </a>
                    </div>
                    <div class="opcion">
                        <a class="opcion-lista" href="./DirectivosTabla.php">
                            <img src="../Style/Images/directivos.png" alt="Directivos">
                            <p>Directivos</p>
                        </a>
                    </div>
                    <div class="opcion">
                        <a class="opcion-lista" href="./Docentes.php">
                            <img src="../Style/Images/maestros.png" alt="Maestros">
                            <p>Maestros</p>
                        </a>
                    </div>
                    <div class="opcion">
                        <a class="opcion-lista" href="./DistribucionDocente.php">
                            <img src="../Style/Images/distribucion.png" alt="distribucion">
                            <p>Distribucion Docente</p>
                        </a>
                    </div>
                    <div class="opcion">
                        <a class="opcion-lista" href="./Tutores.php">
                            <img src="../Style/Images/Tutores.png" alt="Tutores">
                            <p>Tutores</p>
                        </a>
                    </div>
                    <div class="opcion">
                        <a class="opcion-lista" href="./Estudiantes.php">
                            <img src="../Style/Images/estudiantes.png" alt="Estudiantes">
                            <p>Estudiante</p>
                        </a>
                    </div>
                    <div class="opcion">
                        <a class="opcion-lista" href="./grados.php">
                            <img src="../Style/Images/pizarra.png" alt="Grados">
                            <p>Grados</p>
                        </a>
                    </div>
                    <div class="opcion">
                        <a class="opcion-lista" href="./NotasMaterias.php">
                            <img src="../Style/Images/notas.png" alt="Notas">
                            <p>Notas Estudiantes</p>
                        </a>
                    </div>
                    <div class="opcion">
                        <a class="opcion-lista" href="./planillaAsistencia.php">
                            <img src="../Style/Images/asistencia.png" alt="Asistencia">
                            <p>Asistencia Estudiante</p>
                        </a>
                    </div>
                    <div class="opcion">
                        <a class="opcion-lista" href="./Observaciones.php">
                            <img src="../Style/Images/reporte.png" alt="reporte">
                            <p>Observaciones</p>
                        </a>
                    </div>
                    <div class="opcion">
                        <a class="opcion-lista" href="./Boletines.php">
                            <img src="../Style/Images/boletin.png" alt="boletin">
                            <p>Boletines</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php $template_path = './volveratras.php';
        include $template_path; ?>