<?php
// Conexion
include '../../Connection/conexion.php';

// Mensaje Predeterminado
include '../../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'domicilio');

// CREAR domicilio
function crearDomicilio($Bd, $barrio, $calle, $altura, $personas_pers_id)
{
    $accion = 'crear';

    $query = "INSERT INTO domicilio (BarrioDom, CalleDom, AlturaDom, EliminacionLogDom, personas_Pers_id) VALUES ('$barrio', '$calle', '$altura', '$personas_pers_id')";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    $mensaje = mensajePredeterminado($identificador, $accion, 'domicilio');
    echo $mensaje;

    // Cerrar base de datos
    mysqli_close($Bd);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Bd = conexionBaseDatos();
    $barrio = mysqli_real_escape_string($Bd, $_POST['barrio']);
    $calle = mysqli_real_escape_string($Bd, $_POST['calle']);
    $altura = mysqli_real_escape_string($Bd, $_POST['altura']);
    $personas_pers_id = mysqli_real_escape_string($Bd, $_POST['personas_pers_id']);
    $sexo = mysqli_real_escape_string($Bd, $_POST['sexo']);
    $nacionalidad = mysqli_real_escape_string($Bd, $_POST['nacionalidad']);
    $provincia = mysqli_real_escape_string($Bd, $_POST['provincia']);
    $dni = mysqli_real_escape_string($Bd, $_POST['dni']);

    crearDomicilio($Bd, $barrio, $calle, $altura, $personas_pers_id);
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
        <label for="barrio">Barrio:</label>
        <input type="text" id="barrio" name="barrio" required><br>

        <label for="calle">Calle:</label>
        <input type="text" id="calle" name="calle" required><br>

        <label for="altura">Altura:</label>
        <input type="date" id="altura" name="altura" required><br>

        <label for="persona">Persona:</label>
        <input type="text" id="persona" name="persona" required><br>

        <input type="submit" value="Crear">
    </form>
</body>

</html>