<?php
include '../../Connection/conexion.php';
include './buscar.php';

function modificarInstitucion($Bd, $nombrecolgionlst, $numerocolgionlst, $Correoinst, $telefonoInst, $idInst)
{
    $query = "UPDATE institucion SET nombrecolgionlst = '$nombrecolgionlst', numerocolgionlst = '$numerocolgionlst', Correoinst = '$Correoinst', telefonoInst = '$telefonoInst' WHERE idInst = $idInst";
    mysqli_query($Bd, $query);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Institución</title>
</head>

<body>

    <h2>Modificar Institución</h2>

    <form method="post">
        <label for="tipoBusqueda">Buscar Institución por:</label>
        <select id="tipoBusqueda" name="tipoBusqueda" required>
            <option value="1">ID</option>
            <option value="2">Nombre</option>
        </select>
        <br>
        <input type="text" name="identInst" required>
        <input type="submit" name="buscar" value="Buscar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar'])) {
        $Bd = conexionBaseDatos();

        $tipoBusqueda = $_POST['tipoBusqueda'];
        $identInst = $_POST['identInst'];

        $resultado = buscarInstitucion($Bd, $tipoBusqueda, $identInst);

        if ($resultado[1]) {
            $institucion = mysqli_fetch_assoc($resultado[0]);
            $idInst = $institucion['idInst'];
            $nombrecolgionlst = $institucion['nombrecolgionlst'];
            $numerocolgionlst = $institucion['numerocolgionlst'];
            $Correoinst = $institucion['Correoinst'];
            $telefonoInst = $institucion['telefonoInst'];
    ?>
            <form method="post">
                <input type="hidden" name="idInst" value="<?php echo $idInst; ?>">

                <label for="nombrecolgionlst">Nombre:</label>
                <input type="text" id="nombrecolgionlst" name="nombrecolgionlst" value="<?php echo $nombrecolgionlst; ?>" required><br>

                <label for="numerocolgionlst">Número:</label>
                <input type="text" id="numerocolgionlst" name="numerocolgionlst" value="<?php echo $numerocolgionlst; ?>" required><br>

                <label for="Correoinst">Correo:</label>
                <input type="email" id="Correoinst" name="Correoinst" value="<?php echo $Correoinst; ?>" required><br>

                <label for="telefonoInst">Teléfono:</label>
                <input type="text" id="telefonoInst" name="telefonoInst" value="<?php echo $telefonoInst; ?>" required><br>

                <input type="submit" name="modificar" value="Modificar">
            </form>
    <?php
        }
    }

    // Procesar el formulario de modificación
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modificar'])) {
        $Bd = conexionBaseDatos();
        $idInst = mysqli_real_escape_string($Bd, $_POST['idInst']);
        $nombrecolgionlst = mysqli_real_escape_string($Bd, $_POST['nombrecolgionlst']);
        $numerocolgionlst = mysqli_real_escape_string($Bd, $_POST['numerocolgionlst']);
        $Correoinst = mysqli_real_escape_string($Bd, $_POST['Correoinst']);
        $telefonoInst = mysqli_real_escape_string($Bd, $_POST['telefonoInst']);

        modificarInstitucion($Bd, $nombrecolgionlst, $numerocolgionlst, $Correoinst, $telefonoInst, $idInst);
        if (mysqli_affected_rows($Bd) > 0) {
            echo "<p>Institución modificada exitosamente.</p>";
        } else {
            echo "<p>Error al modificar la institución.</p>";
        }
        mysqli_close($Bd);
    }
    ?>
</body>

</html>