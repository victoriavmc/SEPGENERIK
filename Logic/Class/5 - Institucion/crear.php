<?php
// Conexion
include '../../Connection/conexion.php';

// Mensaje Predeterminado
include '../../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'institución');

// CREAR institución
function crearInstitucion($Bd, $nombrecolegioInst, $numerocolegioInst, $linkInst, $correoInst, $telefonoInst, $admin_Adm_id, $domicilio_Doc_id)
{
    $accion = 'crear';

    $query = "INSERT INTO instituciones (nombrecolegioInst, numerocolegioInst, linkInst, correoInst, telefonoInst, admin_Adm_id, domicilio_Doc_id) VALUES ('$nombrecolegioInst', '$numerocolegioInst', '$linkInst', '$correoInst', '$telefonoInst', '$admin_Adm_id', '$domicilio_Doc_id')";

    mysqli_query($Bd, $query);
    if (mysqli_affected_rows($Bd) > 0) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }

    $mensaje = mensajePredeterminado($identificador, $accion, 'institución');
    echo $mensaje;

    // Cerrar base de datos
    mysqli_close($Bd);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Bd = conexionBaseDatos();
    $nombrecolegioInst = mysqli_real_escape_string($Bd, $_POST['nombrecolegioInst']);
    $numerocolegioInst = mysqli_real_escape_string($Bd, $_POST['numerocolegioInst']);
    $linkInst = mysqli_real_escape_string($Bd, $_POST['linkInst']);
    $correoInst = mysqli_real_escape_string($Bd, $_POST['correoInst']);
    $telefonoInst = mysqli_real_escape_string($Bd, $_POST['telefonoInst']);
    $admin_Adm_id = mysqli_real_escape_string($Bd, $_POST['admin_Adm_id']);
    $domicilio_Doc_id = mysqli_real_escape_string($Bd, $_POST['domicilio_Doc_id']);

    crearInstitucion($Bd, $nombrecolegioInst, $numerocolegioInst, $linkInst, $correoInst, $telefonoInst, $admin_Adm_id, $domicilio_Doc_id);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Institución</title>
</head>

<body>
    <h2>Crear Institución</h2>
    <form method="post">
        <label for="nombrecolegioInst">Nombre del Colegio:</label>
        <input type="text" id="nombrecolegioInst" name="nombrecolegioInst" required><br>

        <label for="numerocolegioInst">Número del Colegio:</label>
        <input type="text" id="numerocolegioInst" name="numerocolegioInst" required><br>

        <label for="linkInst">Link:</label>
        <input type="text" id="linkInst" name="linkInst" required><br>

        <label for="correoInst">Correo:</label>
        <input type="email" id="correoInst" name="correoInst" required><br>

        <label for="telefonoInst">Teléfono:</label>
        <input type="text" id="telefonoInst" name="telefonoInst" required><br>

        <label for="admin_Adm_id">ID del Administrador:</label>
        <input type="text" id="admin_Adm_id" name="admin_Adm_id" required><br>

        <label for="domicilio_Doc_id">ID del Domicilio:</label>
        <input type="text" id="domicilio_Doc_id" name="domicilio_Doc_id" required><br>

        <input type="submit" value="Crear">
    </form>
</body>

</html>
