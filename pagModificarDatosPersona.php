<?php
include './pagInicialArriba.php';
include './Logic/PHP/enviarCorreo.php';

if ($rol == 'Administrativo') {
    $rol = 'administrativos';
} else {
    $rol = 'docentes';
}

$Bd = conexionBaseDatos();

$query = "SELECT p.idPers, p.nombrePers, p.apellidoPers, p.fechanacimientoPers, p.cuilPers, p.sexoPers, p.nacionalidadPers, p.provinciaPers, p.dniPers, u.IdUsu, u.userUsu, u.pinolvidoUsu, c.idCont, c.correoCont, c.telefonoCont FROM $rol as pT 
JOIN personas as p ON pT.id = p.idPers
JOIN usuario as u ON pT.usuario_Usu_Id = u.IdUsu
JOIN contacto as c ON c.personas_Pers_id = p.idPers
WHERE pT.id = p.idPers  AND p.idPers = c.personas_Pers_id AND pT.usuario_Usu_Id = u.IdUsu";
// var_dump($query);

$resultado = mysqli_query($Bd, $query);
$personaBd = mysqli_fetch_assoc($resultado);

$idPersona = $personaBd['idPers'];
$nombre = $personaBd['nombrePers'];
$apellido = $personaBd['apellidoPers'];
$fechaNacimiento = $personaBd['fechanacimientoPers'];
$cuil = $personaBd['cuilPers'];
$sexo = $personaBd['sexoPers'];
$nacionalidad = $personaBd['nacionalidadPers'];
$provincia = $personaBd['provinciaPers'];
$dni = $personaBd['dniPers'];
$idUsuario = $personaBd['IdUsu'];
$usuario = $personaBd['pinolvidoUsu'];
$idContacto = $personaBd['idCont'];
$correoContacto = $personaBd['correoCont'];
$telefonoContacto = $personaBd['telefonoCont'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $idPersona = $_POST['idPers'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $cuil = $_POST['cuil'];
    $sexo = $_POST['sexo'];
    $nacionalidad = $_POST['nacionalidad'];
    $provincia = $_POST['provincia'];
    $dni = $_POST['dni'];
    $usuario = $_POST['usuario'];
    $correoContacto = $_POST['correoContacto'];
    $telefonoContacto = $_POST['telefonoContacto'];

    $query = "CALL ActualizarPersonasBD($idPersona, '$nombre', '$apellido', '$fechaNacimiento', '$cuil', '$sexo', '$nacionalidad', '$provincia', '$dni', '$idUsuario', '$usuario', '$idContacto', '$correoContacto', '$telefonoContacto')";
    $resultado = mysqli_query($Bd, $query);

    // header('Location: ./pagModificarDatosADMIN.php');
} elseif (isset($_POST['enviarAlCorreo'])) {
    correoSend($correo, $pinOlvido, $usuario);
}

?>
<div class='ladoDere70'>
    <div class='usarDisenio'>
        <div class="fondoDerechoCrud">
            <div class="crudDerecho">
                <div class='TituloCrud'>
                    <h1>Modificar Usuario</h1>
                </div>
                <form class="formulario-admin" method="POST">
                    <input type="hidden" name="idPers" value="<?php echo $idPersona; ?>">

                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required><br><br>

                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>" required><br><br>

                    <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $fechaNacimiento; ?>" required><br><br>

                    <label for="cuil">CUIL:</label>
                    <input type="text" id="cuil" name="cuil" value="<?php echo $cuil; ?>" required><br>

                    <label for="sexo">Sexo:</label>
                    <input type="text" id="sexo" name="sexo" value="<?php echo $sexo; ?>" required><br>

                    <label for="nacionalidad">Nacionalidad:</label>
                    <input type="text" id="nacionalidad" name="nacionalidad" value="<?php echo $nacionalidad; ?>" required><br>

                    <label for="provincia">Provincia:</label>
                    <input type="text" id="provincia" name="provincia" value="<?php echo $provincia; ?>" required><br>

                    <label for="dni">DNI:</label>
                    <input type="text" id="dni" name="dni" value="<?php echo $dni; ?>" required><br>

                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" value="<?php echo $usuario; ?>" required><br>

                    <label for="correoContacto">Correo de Contacto:</label>
                    <input type="email" id="correoContacto" name="correoContacto" value="<?php echo $correoContacto; ?>" required><br>

                    <label for="telefonoContacto">Teléfono de Contacto:</label>
                    <input type="text" id="telefonoContacto" name="telefonoContacto" value="<?php echo $telefonoContacto; ?>" required><br>

                    <div class="envioCorreo">
                        <div class="pin-olvido">
                            <label for="pinOlvido">PIN de Olvido:</label>
                            <input type="password" id="pinOlvido" name="pinOlvido" value="<?php echo $pinOlvido; ?>" disabled><br>
                        </div>

                        <div>
                            <button class="enviar-correo" href=""><img class="imagen-correo" src="../Style/Images/enviarCorreo.png" alt="">Enviar al correo electronico </button>
                        </div>
                    </div>

                    <input type="submit" value="Enviar">
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<div class='footer'>
    <?php $template_path = './footer.php';
    include $template_path; ?>
</div>
</body>

</html>