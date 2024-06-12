<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
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

// BUSCAR PERSONA EXISTE
function buscarPersona($identificadorBusqueda, $identPers)
{
    // CONSULTA EN BASE DE DATOS CON LOS DOS EN SIMULTANEO
    // $query = "SELECT * FROM personas WHERE idPers = $idPers or cuilPers = $cuilPers AND EliminacionLogPers = 'A'";

    $accion = 'buscar';
    $Bd = conexionBaseDatos();

    $tipo = 0;
    $existePers = true;
    $identPersResultado = null;

    switch ($identificadorBusqueda) {
        case 1:
            $query = "SELECT * FROM personas WHERE idPers = $identPers AND EliminacionLogPers = 'A'";
            $resultado = mysqli_query($Bd, $query);
            if (mysqli_num_rows($resultado) > 0) {
                $identPersResultado = $identPers;
            } else {
                $tipo = 1;
                $existePers = false;
            }
            mysqli_close($Bd);
            break;

        case 2:
            $query = "SELECT idPers FROM personas WHERE cuilPers = '$identPers' AND EliminacionLogPers = 'A'";
            $resultado = mysqli_query($Bd, $query);
            if (mysqli_num_rows($resultado) > 0) {
                $indentificadorBDPers = mysqli_fetch_assoc($resultado);
                $identPersResultado = $indentificadorBDPers['idPers'];
            } else {
                $tipo = 1;
                $existePers = false;
            }
            mysqli_close($Bd);
            break;

        default:
            $tipo = 1;
            $mensaje = mensajePredeterminado($tipo, $accion, 'persona especifica');
            echo $mensaje;
            return array($identPersResultado, false); // Valor de retorno por defecto
            break;
    }
    $mensaje = mensajePredeterminado($tipo, $accion, 'persona');
    echo $mensaje;

    return array($identPersResultado, $existePers);
}

// MOSTRAR PERSONA ESPECIFICA SI EXISTE
function mostrarPersonaEspecifica($tipoBusqueda, $numPersona)
{
    $Bd = conexionBaseDatos();

    // Llamamos a la función buscarPersona y obtenemos el resultado en un arreglo
    $resultadoBusquedaEspe = buscarPersona($tipoBusqueda, $numPersona);

    // Extraemos los valores del arreglo
    $idenPer = $resultadoBusquedaEspe[0];
    $exisPer = $resultadoBusquedaEspe[1];

    if ($exisPer) {
        // Consulta SQL para seleccionar los detalles de la persona usando el ID obtenido
        $query = "SELECT * FROM persona WHERE idPers = $idenPer";
        $resultadoConsulta = mysqli_query($Bd, $query);

        // Verificamos si se obtuvieron resultados
        if (mysqli_num_rows($resultadoConsulta) > 0) {
            // Tabla
            echo "<table border='1'>";
            echo "<tr><th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Fecha de Nacimiento</th>
            <th>CUIL</th>
            <th>Sexo</th>
            <th>Nacionalidad</th>
            <th>Provincia</th>
            <th>DNI</th>";

            // Mostramos los detalles de la persona en una tabla
            while ($fila = mysqli_fetch_assoc($resultadoConsulta)) {
                echo "<tr>";
                echo "<td>" . $fila['idPers'] . "</td>";
                echo "<td>" . $fila['nombrePers'] . "</td>";
                echo "<td>" . $fila['apellidoPers'] . "</td>";
                echo "<td>" . $fila['fechanacimientoPers'] . "</td>";
                echo "<td>" . $fila['cuilPers'] . "</td>";
                echo "<td>" . $fila['sexoPers'] . "</td>";
                echo "<td>" . $fila['nacionalidadPers'] . "</td>";
                echo "<td>" . $fila['provinciaPers'] . "</td>";
                echo "<td>" . $fila['dniPers'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No se encontraron detalles de la persona.";
        }
    } else {
        echo "<script>alert('No se encontró ninguna persona con el ID proporcionado o la persona fue eliminada (lógicamente).');</script>";
    }

    // Cerramos la conexión a la base de datos
    mysqli_close($Bd);
}

// TABLAS PERSONAS
function mostrarPersonas()
{

    $Bd = conexionBaseDatos();

    $query = "SELECT * FROM persona WHERE EliminacionLogPers = 'A'";
    $resultado = mysqli_query($Bd, $query);

    if (mysqli_num_rows($resultado) > 0) {
        // Tabla
        echo "<table border='1'>";
        echo "<tr><th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Fecha de Nacimiento</th>
        <th>CUIL</th>
        <th>Sexo</th>
        <th>Nacionalidad</th>
        <th>Provincia</th>
        <th>DNI</th>";


        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $fila['idPers'] . "</td>";
            echo "<td>" . $fila['nombrePers'] . "</td>";
            echo "<td>" . $fila['apellidoPers'] . "</td>";
            echo "<td>" . $fila['fechanacimientoPers'] . "</td>";
            echo "<td>" . $fila['cuilPers'] . "</td>";
            echo "<td>" . $fila['sexoPers'] . "</td>";
            echo "<td>" . $fila['nacionalidadPers'] . "</td>";
            echo "<td>" . $fila['provinciaPers'] . "</td>";
            echo "<td>" . $fila['dniPers'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<script>alert('No se encontró ninguna persona o las personas fueron eliminada (lógicamente).');</script>";
    }

    mysqli_close($Bd);
}


// MODIFICAR PERSONA
function modificarPersona($tipoBusqueda, $numPersona)
{
    $accion = 'modificar';

    $Bd = conexionBaseDatos();
    // Llamamos a la función buscarPersona y obtenemos el resultado en un arreglo
    $resultadoBusqueda = buscarPersona($tipoBusqueda, $numPersona);
    // Extraemos los valores del arreglo
    $idenPer = $resultadoBusqueda[0];
    $exisPer = $resultadoBusqueda[1];

    if ($exisPer) {
        $query = "SELECT * FROM persona WHERE idPers = $idenPer";
        $resultado = mysqli_query($Bd, $query);
        $persona = mysqli_fetch_assoc($resultado);
        $nombre = $persona['nombrePers'];
        $apellido = $persona['apellidoPers'];
        $fechaNacimiento = $persona['fechnacimientoPers'];
        $cuil = $persona['cuilPers'];
        $sexo = $persona['sexoPers'];
        $nacionalidad = $persona['nacionalidadPers'];
        $provincia = $persona['provinciaPers'];
        $dni = $persona['dniPers'];

        ?>
        <form method="post">
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

            <input type="submit" value="Crear">
        </form>
        <?php

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = mysqli_real_escape_string($Bd, $_POST['nombre']);
            $apellido = mysqli_real_escape_string($Bd, $_POST['apellido']);
            $fechaNacimiento = mysqli_real_escape_string($Bd, $_POST['fechaNacimiento']);
            $cuil = mysqli_real_escape_string($Bd, $_POST['cuil']);
            $sexo = mysqli_real_escape_string($Bd, $_POST['sexo']);
            $nacionalidad = mysqli_real_escape_string($Bd, $_POST['nacionalidad']);
            $provincia = mysqli_real_escape_string($Bd, $_POST['provincia']);
            $dni = mysqli_real_escape_string($Bd, $_POST['dni']);

            $query = "UPDATE personas SET nombrePers = '$nombre', apellidoPers = '$apellido', fechanacimientoPers = '$fechaNacimiento', cuilPers = '$cuil', sexoPers = '$sexo', nacionalidadPers = '$nacionalidad', provinciaPers = '$provincia', dniPers = '$dni' WHERE idPers = $idenPer";

            mysqli_query($Bd, $query);
            if (mysqli_affected_rows($Bd) > 0 ) {
                $identificador = 0;
            } else {
                $identificador = 1;
            }
            $mensaje = mensajePredeterminado($identificador, $accion, 'persona');
            echo $mensaje;
        }

    } else {
        $identificador = 1;
        $mensaje = mensajePredeterminado($identificador, $accion, 'persona especifica');
        echo $mensaje;
    }

    mysqli_close($Bd);
}

function eliminarPersonaLog($tipoBusqueda, $numPersona)
{
    $accion = 'eliminar';
    $Bd = conexionBaseDatos();

    $resultadoBusqueda = buscarPersona($tipoBusqueda, $numPersona);

    $idenPer = $resultadoBusqueda[0];
    $exisPer = $resultadoBusqueda[1];

    // Si la persona existe, realizamos la eliminación lógica
    if ($exisPer) {
        $query = "UPDATE personas SET EliminacionLogPers = 'E' WHERE idPers = $idenPer";
        mysqli_query($Bd, $query);

        if (mysqli_affected_rows($Bd) > 0) {
            echo "La persona con ID $idenPer ha sido eliminada lógicamente.";
        } else {
            $identificador = 1;
            $mensaje = mensajePredeterminado($identificador, $accion, 'persona especifica');
            echo $mensaje;
        }
    } else {
        echo "La persona con ID $numPersona no existe o ya ha sido eliminada.";
    }

    mysqli_close($Bd);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Persona</title>
</head>
<body>
    
</body>
</html>