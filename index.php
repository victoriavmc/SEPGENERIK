<?php
$template_path = './head.php';
include './Logic/Connection/conexion.php';
include $template_path;

session_start();

$Bd = conexionBaseDatos();
$query = "SELECT nombrecolegioInst, numerocolegioInst, linkInst FROM institucion";
$resultado = mysqli_query($Bd, $query);

$colegio = mysqli_fetch_assoc($resultado);
$nombreColegio = $colegio['nombrecolegioInst'];
$numeroColegio = $colegio['numerocolegioInst'];
$link = $colegio['linkInst'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_REQUEST['usuario'];
    $contrasenia = $_REQUEST['password'];
    $rolSeleccionado = $_REQUEST['rol_seleccionado'];
    $query = "SELECT * FROM usuario WHERE userUsu = '$usuario' and contraseniaUsu = '$contrasenia' and eliminacionLogUsu = 'A' ";

    $resultado = mysqli_query($Bd, $query);
    $persona = mysqli_fetch_assoc($resultado);

    if (mysqli_num_rows($resultado) > 0) {
        session_start();
        $id = $persona['IdUsu'];
        $query = "SELECT p.nombreRol FROM preestablecerrol as p
                    JOIN usuario as u ON p.idPreRol = u.PreestablecerRol_PreestablecerRol_id
                    WHERE u.IdUsu = $id";
        $resultado = mysqli_query($Bd, $query);
        $persona = mysqli_fetch_assoc($resultado);

        $rol = $persona['nombreRol'];


        if ($rol === $rolSeleccionado or $rol === 'Administrador') {
            $_SESSION['login'] = true;
            $_SESSION['rol'] = $rol;
            $_SESSION['usuario'] = $usuario;
            $_SESSION['IdUsu'] = $id;
            header('location:  ./pagInicial.php');
        } else {
            echo "<script>alert('Error al iniciar sesión. Rol incorrecto!');</script>";
        }
    } else {
        echo "<script>alert('Error al iniciar sesión. Verifique los datos!');</script>";
    }
}
?>

<body class='divisionHorizontal3'>
    <div class='encabezado'>
        <?php
        $template_path = './cabeceraPrincipal.php';
        include $template_path;
        ?>
        <div class='barra-institucional'>
            <div class='nombreInstitucion'>
                <?php
                if (isset($nombreColegio) && !empty($nombreColegio) && isset($numeroColegio) && !empty($numeroColegio)) {
                ?>
                    <h1><?php echo 'E.P.E.P. Nº ' . $numeroColegio . ' - ' . $nombreColegio; ?></h1>
                <?php
                } else {
                    echo "<h1>Nombre del Colegio - No Disponible</h1>";
                }
                ?>
            </div>


            <div class="links">
                <div class="cuadro">
                    <div class="imagenLink">
                        <?php
                        if (isset($link) && !empty($link)) {
                        ?>
                            <a href="<?php echo $link; ?>" target="_blank">
                                <img class="logo-contacto" src="./Style/Images/linkInstituto.jpeg" alt="Datos del Escuela">
                            </a>
                        <?php
                        } else {
                        ?>
                            <a href="./HTML/pag404.php" target="">
                                <img class="logo-contacto" src="./Style/Images/linkInstituto.jpeg" alt="Datos del Escuela">
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="imagenYoutube">
                        <a href="https://www.youtube.com/channel/UCH0NoMWB6_53WwK14RJALCA" target="_blank">
                            <img class="logo-contacto" src="./Style/Images/youtu.png" alt="Tutorial de como usar la pagina">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='fondo'>
        <div class='fondo2'>
            <div class='divisionVertical3NOProporcional'>
                <div class='ladoIzq40'>
                    <div class='sep'>
                        <h1 class="principalTexto">Sistema Educativo Primario</h1>
                        <h1 class="principalTexto">-</h1>
                        <h1 class="principalTexto">Generik</h1>
                    </div>
                </div>

                <div class='ladoDere60'>
                    <div class='formLogin'>
                        <div class='SelecUser'>
                            <div class="rol-directivo">
                                <button id="directivo" class="button-rol">
                                    <img class="imagen-rol" src="./Style/Images/direc.png" alt="">
                                    <p class="texto-rol">Directivo</p>
                                </button>
                            </div>
                            <div class="rol-maestro">
                                <button id="maestro" class="button-rol">
                                    <img class="imagen-rol" src="./Style/Images/maestra.png" alt="">
                                    <p class="texto-rol">Maestro</p>
                                </button>
                            </div>
                        </div>
                        <div class="formulario">
                            <div class="formulario-titulo">
                                <img id="imagen-rol-formulario" class="imagen-rol-inicio" src="./Style/Images/maestra.png" alt="Maestros">
                                <h2 id="texto-rol-formulario" class="texto-rol-inicio">Maestro</h2>
                            </div>
                            <form action="" method="POST">
                                <div class="usuario-campo">
                                    <label for="usuario">Usuario</label>
                                    <input type="usuario" name="usuario" id="usuario" required>
                                </div>
                                <div class="contrasenia-campo">
                                    <label for="password">Contraseña</label>
                                    <input type="password" name="password" id="password" required>
                                </div>
                                <input type="hidden" name="rol_seleccionado" id="rol-seleccionado" value="Maestro">
                                <a class="recuperar-cuenta" href="./pag404.php">Olvido la Contraseña</a>
                                <div class="boton-centrar">
                                    <input class="boton" type="submit" value="Iniciar sesion">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='footer'>
        <?php $template_path = './footer.php';
        include $template_path; ?>
    </div>
    <script src="./Logic/javascript/scripts.js"></script>
</body>

</html>