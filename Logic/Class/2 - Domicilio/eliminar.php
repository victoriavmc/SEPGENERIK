<?php
// Conexion
include '../../Connection/conexion.php';
include './buscar.php';

function eliminarDomicilioLog($Bd, $identDom)
{
    $query = "UPDATE domicilio SET EliminacionLogDom = 'E' WHERE idDom = $identDom";
    mysqli_query($Bd, $query);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Domicilio</title>
</head>

<body>
    <h2>Eliminar Domicilio</h2>

    <form method="post">
        <label for="tipoBusqueda">Eliminar Domicilio por:</label>
        <select id="tipoBusqueda" name="tipoBusqueda" required>
            <option value="1">ID</option>
            <option value="2">ID Persona</option>
        </select>
        <br>
        <input type="text" name="identDom" required>
        <input type="submit" name="buscar" value="Buscar">
    </form>
    <br>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar'])) {
        $Bd = conexionBaseDatos();

        $tipoBusqueda = $_POST['tipoBusqueda'];
        $id = $_POST['identDom'];

        mostrarDomicilioEspecifico($Bd, $tipoBusqueda, $id);

        if ($resultado[1]) {
            $domicilio = mysqli_fetch_assoc($resultado[0]);
            $id = $domicilio['idDom'];
    ?>
            <br>
            <form method="post">
                <input type="hidden" name="idenDom" value="<?php echo $id; ?>">
                <input type="submit" name="eliminar" value="Eliminar">

            </form>
    <?php
        }
    }

    // Procesar el formulario de eliminación
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
        $Bd = conexionBaseDatos();
        $id = mysqli_real_escape_string($Bd, $_POST['idenDom']);
        eliminarDomicilioLog($Bd, $id);
        echo "<p>Domicilio eliminada exitosamente.</p>";
        mysqli_close($Bd);
    }
    ?>
</body>

</html>