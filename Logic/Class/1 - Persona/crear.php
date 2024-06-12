<?php
// Conexion
include '../../Connection/conexion.php';

// Mensaje Predeterminado
include '../../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// CREAR PERSONA
function crearPersona($nombre, $apellido, $fechaNacimiento, $cuil, $sexo, $nacionalidad, $provincia, $dni)
{
    // CREAR PERSONA
    $accion = 'crear';

    $Bd = conexionBaseDatos();
    $query = "INSERT INTO persona (nombrePers, apellidoPers, fechanacimientoPers, cuilPers, sexoPers, nacionalidadPers, provinciaPers, dniPers, EliminacionLogPers) VALUES ('$nombre', '$apellido', '$fechaNacimiento', '$cuil', '$sexo', '$nacionalidad', '$provincia', '$dni', 'A')";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'persona');
    echo $mensaje;

    // Cerrar base de datos
    mysqli_close($Bd);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Bd = conexionBaseDatos();
    $nombre = mysqli_real_escape_string($Bd, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($Bd, $_POST['apellido']);
    $fechaNacimiento = mysqli_real_escape_string($Bd, $_POST['fechaNacimiento']);
    $cuil = mysqli_real_escape_string($Bd, $_POST['cuil']);
    $sexo = mysqli_real_escape_string($Bd, $_POST['sexo']);
    $nacionalidad = mysqli_real_escape_string($Bd, $_POST['nacionalidad']);
    $provincia = mysqli_real_escape_string($Bd, $_POST['provincia']);
    $dni = mysqli_real_escape_string($Bd, $_POST['dni']);

    crearPersona($Bd, $nombre, $apellido, $fechaNacimiento, $cuil, $sexo, $nacionalidad, $provincia, $dni);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Persona</title>
</head>

<body>
    <h2>Crear Persona</h2>
    <form method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br>

        <label for="fechaNacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fechaNacimiento" name="fechaNacimiento" required><br>

        <label for="cuil">CUIL:</label>
        <input type="text" id="cuil" name="cuil" required><br>

        <label>Sexo:</label><br>
        <input type="radio" id="masculino" name="sexo" value="Masculino" required>
        <label for="masculino">Masculino</label><br>
        <input type="radio" id="femenino" name="sexo" value="Femenino" required>
        <label for="femenino">Femenino</label><br>

        <label for="nacionalidad">Nacionalidad:</label>
        <input type="text" id="nacionalidad" name="nacionalidad" required><br>

        <label for="provincia">Provincia:</label>
        <input type="text" id="provincia" name="provincia" required><br>

        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required><br>

        <input type="submit" value="Crear">
    </form>
</body>

</html>