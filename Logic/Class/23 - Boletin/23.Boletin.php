<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// Función para crear un registro en la tabla boletin
function crearBoletin($cantidadFaltas, $libretaId, $trimestreId) {
    $accion = 'crear';
    $Bd = conexionBaseDatos();

    $query = "INSERT INTO boletin (CantidadFaltasxTrimestre, EliminacionLogicaBole, libreta_idLibreta, idTri) 
              VALUES ('$cantidadFaltas', 'A', $libretaId, $trimestreId)";

    if (mysqli_query($Bd, $query)) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    mensajePredeterminado($identificador, $accion, 'boletín');

    mysqli_close($Bd);
}

// Función para leer todos los registros de la tabla boletin
function leerBoletines() {
    $Bd = conexionBaseDatos();
    $query = "SELECT * FROM boletin WHERE EliminacionLogicaBole = 'A'";
    $resultado = mysqli_query($Bd, $query);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Cantidad de Faltas por Trimestre</th><th>ID de Libreta</th><th>ID de Trimestre</th></tr>";
        
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $fila['idboletin'] . "</td>";
            echo "<td>" . $fila['CantidadFaltasxTrimestre'] . "</td>";
            echo "<td>" . $fila['libreta_idLibreta'] . "</td>";
            echo "<td>" . $fila['idTri'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<script>alert('No se encontraron registros de boletín.');</script>";
    }

    mysqli_close($Bd);
}

// Función para actualizar un registro en la tabla boletin
function actualizarBoletin($idBoletin, $cantidadFaltas, $libretaId, $trimestreId) {
    $accion = 'actualizar';
    $Bd = conexionBaseDatos();

    $query = "UPDATE boletin 
              SET CantidadFaltasxTrimestre = '$cantidadFaltas', libreta_idLibreta = $libretaId, idTri = $trimestreId 
              WHERE idboletin = $idBoletin AND EliminacionLogicaBole = 'A'";

    if (mysqli_query($Bd, $query)) {
        if (mysqli_affected_rows($Bd) > 0) {
            $identificador = 0;
        } else {
            $identificador = 1;
        }
    } else {
        $identificador = 1;
    }
    mensajePredeterminado($identificador, $accion, 'boletín');

    mysqli_close($Bd);
}

// Función para eliminar lógicamente un registro en la tabla boletin
function eliminarBoletin($idBoletin) {
    $accion = 'eliminar';
    $Bd = conexionBaseDatos();
    
    $query = "UPDATE boletin SET EliminacionLogicaBole = 'E' WHERE idboletin = $idBoletin";

    if (mysqli_query($Bd, $query)) {
        if (mysqli_affected_rows($Bd) > 0) {
            $identificador = 0;
        } else {
            $identificador = 1;
        }
    } else {
        $identificador = 1;
    }
    mensajePredeterminado($identificador, $accion, 'boletín');

    mysqli_close($Bd);
}
?>