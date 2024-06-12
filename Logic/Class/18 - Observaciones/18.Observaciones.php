<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');


// CREAR OBSERVACIÓN
function crearObservacion($fechaObservacion, $preestObsId) {
    $accion = 'crear';
    $Bd = conexionBaseDatos();
    $query = "INSERT INTO observaciones (fechadeobservacionObs, PreestableciendoObservacion_PreestObs_ID, EliminacionLogObs) 
              VALUES ('$fechaObservacion', $preestObsId, 'A')";

    if (mysqli_query($Bd, $query)) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    mensajePredeterminado($identificador, $accion, 'Observación');
    mysqli_close($Bd);
}

// LEER OBSERVACIÓN
function buscarObservacion($idObs) {
    $accion = 'buscar';
    $Bd = conexionBaseDatos();
    $query = "SELECT * FROM observaciones WHERE idObs = $idObs AND EliminacionLogObs = 'A'";
    $resultado = mysqli_query($Bd, $query);
    if (mysqli_num_rows($resultado) > 0) {
        $observacion = mysqli_fetch_assoc($resultado);
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Fecha de Observación</th><th>ID Preestablecida</th></tr>";
        echo "<tr>";
        echo "<td>" . $observacion['idObs'] . "</td>";
        echo "<td>" . $observacion['fechadeobservacionObs'] . "</td>";
        echo "<td>" . $observacion['PreestableciendoObservacion_PreestObs_ID'] . "</td>";
        echo "</tr>";
        echo "</table>";
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    mensajePredeterminado($identificador, $accion, 'Observación');
    mysqli_close($Bd);
}

// ACTUALIZAR OBSERVACIÓN
function actualizarObservacion($idObs, $fechaObservacion, $preestObsId) {
    $accion = 'actualizar';
    $Bd = conexionBaseDatos();
    $query = "UPDATE observaciones 
              SET fechadeobservacionObs = '$fechaObservacion', PreestableciendoObservacion_PreestObs_ID = $preestObsId 
              WHERE idObs = $idObs AND EliminacionLogObs = 'A'";

    if (mysqli_query($Bd, $query)) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    mensajePredeterminado($identificador, $accion, 'Observación');
    mysqli_close($Bd);
}

// ELIMINAR (LÓGICAMENTE) OBSERVACIÓN
function eliminarObservacion($idObs) {
    $accion = 'eliminar';
    $Bd = conexionBaseDatos();
    $query = "UPDATE observaciones SET EliminacionLogObs = 'E' WHERE idObs = $idObs";

    if (mysqli_query($Bd, $query)) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    mensajePredeterminado($identificador, $accion, 'Observación');
    mysqli_close($Bd);
}

// FUNCIÓN PARA LISTAR TODAS LAS OBSERVACIONES
function listarObservaciones() {
    $Bd = conexionBaseDatos();
    $query = "SELECT * FROM observaciones WHERE EliminacionLogObs = 'A'";
    $resultado = mysqli_query($Bd, $query);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Fecha de Observación</th><th>ID Preestablecida</th></tr>";
        while ($observacion = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $observacion['idObs'] . "</td>";
            echo "<td>" . $observacion['fechadeobservacionObs'] . "</td>";
            echo "<td>" . $observacion['PreestableciendoObservacion_PreestObs_ID'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<script>alert('No se encontraron observaciones.');</script>";
    }
    mysqli_close($Bd);
}
?>