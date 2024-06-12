<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// CREAR OBSERVACIÓN TRIMESTRAL
function crearObservacionTrimestral($observacionId, $trimestreId, $matriculaEstId) {
    $accion = 'crear';
    $Bd = conexionBaseDatos();
    $query = "INSERT INTO observaciontrimestral (observaciones_Obs_id, trimestre_Tri_id, matricularestudiante_Matric_Est_id, EliminacionLogObsTri) 
              VALUES ($observacionId, $trimestreId, $matriculaEstId, 'A')";

    if (mysqli_query($Bd, $query)) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    mensajePredeterminado($identificador, $accion, 'Observación Trimestral');
    mysqli_close($Bd);
}

// LEER OBSERVACIÓN TRIMESTRAL
function buscarObservacionTrimestral($idObsTri) {
    $accion = 'buscar';
    $Bd = conexionBaseDatos();
    $query = "SELECT * FROM observaciontrimestral WHERE idObsTri = $idObsTri AND EliminacionLogObsTri = 'A'";
    $resultado = mysqli_query($Bd, $query);
    if (mysqli_num_rows($resultado) > 0) {
        $observacionTrimestral = mysqli_fetch_assoc($resultado);
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Observación ID</th><th>Trimestre ID</th><th>Matricula Estudiante ID</th></tr>";
        echo "<tr>";
        echo "<td>" . $observacionTrimestral['idObsTri'] . "</td>";
        echo "<td>" . $observacionTrimestral['observaciones_Obs_id'] . "</td>";
        echo "<td>" . $observacionTrimestral['trimestre_Tri_id'] . "</td>";
        echo "<td>" . $observacionTrimestral['matricularestudiante_Matric_Est_id'] . "</td>";
        echo "</tr>";
        echo "</table>";
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    mensajePredeterminado($identificador, $accion, 'Observación Trimestral');
    mysqli_close($Bd);
}

// ACTUALIZAR OBSERVACIÓN TRIMESTRAL
function actualizarObservacionTrimestral($idObsTri, $observacionId, $trimestreId, $matriculaEstId) {
    $accion = 'actualizar';
    $Bd = conexionBaseDatos();
    $query = "UPDATE observaciontrimestral 
              SET observaciones_Obs_id = $observacionId, trimestre_Tri_id = $trimestreId, matricularestudiante_Matric_Est_id = $matriculaEstId 
              WHERE idObsTri = $idObsTri AND EliminacionLogObsTri = 'A'";

    if (mysqli_query($Bd, $query)) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    mensajePredeterminado($identificador, $accion, 'Observación Trimestral');
    mysqli_close($Bd);
}

// ELIMINAR (LÓGICAMENTE) OBSERVACIÓN TRIMESTRAL
function eliminarObservacionTrimestral($idObsTri) {
    $accion = 'eliminar';
    $Bd = conexionBaseDatos();
    $query = "UPDATE observaciontrimestral SET EliminacionLogObsTri = 'E' WHERE idObsTri = $idObsTri";

    if (mysqli_query($Bd, $query)) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    mensajePredeterminado($identificador, $accion, 'Observación Trimestral');
    mysqli_close($Bd);
}

// FUNCIÓN PARA LISTAR TODAS LAS OBSERVACIONES TRIMESTRALES
function listarObservacionesTrimestrales() {
    $Bd = conexionBaseDatos();
    $query = "SELECT * FROM observaciontrimestral WHERE EliminacionLogObsTri = 'A'";
    $resultado = mysqli_query($Bd, $query);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Observación ID</th><th>Trimestre ID</th><th>Matricula Estudiante ID</th></tr>";
        while ($observacionTrimestral = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $observacionTrimestral['idObsTri'] . "</td>";
            echo "<td>" . $observacionTrimestral['observaciones_Obs_id'] . "</td>";
            echo "<td>" . $observacionTrimestral['trimestre_Tri_id'] . "</td>";
            echo "<td>" . $observacionTrimestral['matricularestudiante_Matric_Est_id'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<script>alert('No se encontraron observaciones trimestrales.');</script>";
    }
    mysqli_close($Bd);
}
?>
