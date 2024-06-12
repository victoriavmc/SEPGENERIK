<?php
// Conexion
include '../../Connection/conexion.php';
include './buscar.php';

function eliminarPersonaLog($Bd, $identPer)
{
    $query = "UPDATE personas SET EliminacionLogPers = 'E' WHERE idPers = $identPer";
    mysqli_query($Bd, $query);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Persona</title>
</head>

<body>
    <h2>Eliminar Persona</h2>

    <form method="post">
        <label for="tipoBusqueda">Eliminar Persona por:</label>
        <select id="tipoBusqueda" name="tipoBusqueda" required>
            <option value="1">ID</option>
            <option value="2">CUIL</option>
        </select>
        <br>
        <input type="text" name="identPer" required>
        <input type="submit" name="buscar" value="Buscar">
    </form>
    <br>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar'])) {
        $Bd = conexionBaseDatos();

        $tipoBusqueda = $_POST['tipoBusqueda'];
        $id = $_POST['identPer'];

        mostrarPersonaEspecifica($Bd, $tipoBusqueda, $id);

        if ($resultado[1]) {
            $persona = mysqli_fetch_assoc($resultado[0]);
            $id = $persona['idPers'];
    ?>
            <br>
            <form method="post">
                <input type="hidden" name="idenPer" value="<?php echo $id; ?>">
                <input type="submit" name="eliminar" value="Eliminar">

            </form>
    <?php
        }
    }

    // Procesar el formulario de eliminación
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
        $Bd = conexionBaseDatos();
        $id = mysqli_real_escape_string($Bd, $_POST['idenPer']);
        eliminarPersonaLog($Bd, $id);
        echo "<p>Persona eliminada exitosamente.</p>";
        mysqli_close($Bd);
    }
    ?>
</body>

</html>