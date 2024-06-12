<?php
include '../../Connection/conexion.php';
include './buscar.php';

function modificarPersona($Bd, $nombre, $apellido, $fechaNacimiento, $cuil, $sexo, $nacionalidad, $provincia, $dni, $idenPer)
{
    $query = "UPDATE personas SET nombrePers = '$nombre', apellidoPers = '$apellido', fechanacimientoPers = '$fechaNacimiento', cuilPers = '$cuil', sexoPers = '$sexo', nacionalidadPers = '$nacionalidad', provinciaPers = '$provincia', dniPers = '$dni' WHERE idPers = $idenPer";
    mysqli_query($Bd, $query);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Persona</title>
</head>

<body>

    <h2>Modificar Persona</h2>

    <form method="post">
        <label for="tipoBusqueda">Buscar Persona por:</label>
        <select id="tipoBusqueda" name="tipoBusqueda" required>
            <option value="1">ID</option>
            <option value="2">CUIL</option>
        </select>
        <br>
        <input type="text" name="identPer" required>
        <input type="submit" name="buscar" value="Buscar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar'])) {
        $Bd = conexionBaseDatos();

        $tipoBusqueda = $_POST['tipoBusqueda'];
        $identPer = $_POST['identPer'];

        $resultado = buscarPersona($Bd, $tipoBusqueda, $identPer);

        if ($resultado[1]) {
            $persona = mysqli_fetch_assoc($resultado[0]);
            $id = $persona['idPers'];
            $nombre = $persona['nombrePers'];
            $apellido = $persona['apellidoPers'];
            $fechaNacimiento = $persona['fechanacimientoPers'];
            $cuil = $persona['cuilPers'];
            $sexo = $persona['sexoPers'];
            $nacionalidad = $persona['nacionalidadPers'];
            $provincia = $persona['provinciaPers'];
            $dni = $persona['dniPers'];
    ?>
            <form method="post">
                <input type="hidden" name="idenPer" value="<?php echo $id; ?>">

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required><br>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>" required><br>

                <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $fechaNacimiento; ?>" required><br>

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

                <input type="submit" name="modificar" value="Modificar">
            </form>
    <?php
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modificar'])) {
        $Bd = conexionBaseDatos(); // Reabrir la conexión
        $accion = 'modificar';

        $id = mysqli_real_escape_string($Bd, $_POST['idenPer']);
        $nombre = mysqli_real_escape_string($Bd, $_POST['nombre']);
        $apellido = mysqli_real_escape_string($Bd, $_POST['apellido']);
        $fechaNacimiento = mysqli_real_escape_string($Bd, $_POST['fechaNacimiento']);
        $cuil = mysqli_real_escape_string($Bd, $_POST['cuil']);
        $sexo = mysqli_real_escape_string($Bd, $_POST['sexo']);
        $nacionalidad = mysqli_real_escape_string($Bd, $_POST['nacionalidad']);
        $provincia = mysqli_real_escape_string($Bd, $_POST['provincia']);
        $dni = mysqli_real_escape_string($Bd, $_POST['dni']);

        modificarPersona($Bd, $nombre, $apellido, $fechaNacimiento, $cuil, $sexo, $nacionalidad, $provincia, $dni, $id);
        if (mysqli_affected_rows($Bd) > 0) {
            $identificador = 0;
        } else {
            $identificador = 1;
        }
        $mensaje = mensajePredeterminado($identificador, $accion, 'persona');
        echo $mensaje;
        mysqli_close($Bd);
    }
    ?>
</body>

</html>