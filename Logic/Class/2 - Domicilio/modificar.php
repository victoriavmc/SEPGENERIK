<?php
include '../../Connection/conexion.php';
include './buscar.php';

function modificarDomicilio($Bd, $Barrio, $Calle, $Altura, $personas_Pers_id, $idenDom)
{
    $query = "UPDATE domicilio SET BarrioDom = '$Barrio', CalleDom = '$Calle', AlturaDom = '$Altura', personas_Pers_id = '$personas_Pers_id' WHERE idDom = $idenDom";
    mysqli_query($Bd, $query);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Domicilio</title>
</head>

<body>

    <h2>Modificar Domicilio</h2>

    <form method="post">
        <label for="tipoBusqueda">Buscar Domicilio por:</label>
        <select id="tipoBusqueda" name="tipoBusqueda" required>
            <option value="1">ID</option>
            <option value="2">persona</option>
        </select>
        <br>
        <input type="text" name="identDom" required>
        <input type="submit" name="buscar" value="Buscar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar'])) {
        $Bd = conexionBaseDatos();

        $tipoBusqueda = $_POST['tipoBusqueda'];
        $identDom = $_POST['identDom'];

        $resultado = buscarDomicilio($Bd, $tipoBusqueda, $identDom);

        if ($resultado[1]) {
            $domicilio = mysqli_fetch_assoc($resultado[0]);
            $id = $domicilio['idDom'];
            $barrio = $domicilio['BarrioDom'];
            $calle = $domicilio['CalleDom'];
            $altura = $domicilio['AlturaDom'];
            $personas_Pers_id = $domicilio['personas_Pers_id'];
    ?>
            <form method="post">
                <input type="hidden" name="idenDom" value="<?php echo $id; ?>">

                <label for="barrio">Barrio:</label>
                <input type="text" id="barrio" name="barrio" value="<?php echo $barrio; ?>" required><br>

                <label for="calle">Calle:</label>
                <input type="text" id="calle" name="calle" value="<?php echo $calle; ?>" required><br>

                <label for="altura">Altura:</label>
                <input type="date" id="altura" name="altura" value="<?php echo $altura; ?>" required><br>

                <label for="persona">Persona:</label>
                <input type="text" id="persona" name="persona" value="<?php echo $persona; ?>" required><br>

                <input type="submit" name="modificar" value="Modificar">
            </form>
    <?php
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modificar'])) {
        $Bd = conexionBaseDatos(); // Reabrir la conexión
        $accion = 'modificar';

        $id = mysqli_real_escape_string($Bd, $_POST['idenDom']);
        $barrio = mysqli_real_escape_string($Bd, $_POST['barrio']);
        $calle = mysqli_real_escape_string($Bd, $_POST['calle']);
        $altura = mysqli_real_escape_string($Bd, $_POST['altura']);
        $persona = mysqli_real_escape_string($Bd, $_POST['persona']);

        modificarDomicilio($Bd, $barrio, $calle, $altura, $persona, $id);
        if (mysqli_affected_rows($Bd) > 0) {
            $identificador = 0;
        } else {
            $identificador = 1;
        }
        $mensaje = mensajePredeterminado($identificador, $accion, 'domicilio');
        echo $mensaje;
        mysqli_close($Bd);
    }
    ?>
</body>

</html>