<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

// Función para crear un registro en la tabla libreta
function crearLibreta($notaFinal, $gradosId, $matriculaEstudianteId) {
    $accion = 'crear';
    $Bd = conexionBaseDatos();

    $query = "INSERT INTO libreta (NOTAFINAL, LIBRETAELIMINACIONLOGICA, grados_idGrad, matricularestudiante_idMatricEst) 
              VALUES ('$notaFinal', 'A', $gradosId, $matriculaEstudianteId)";

    if (mysqli_query($Bd, $query)) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    mensajePredeterminado($identificador, $accion, 'libreta');

    mysqli_close($Bd);
}

// Función para leer todos los registros de la tabla libreta
function leerLibretas() {
    $Bd = conexionBaseDatos();
    $query = "SELECT * FROM libreta WHERE LIBRETAELIMINACIONLOGICA = 'A'";
    $resultado = mysqli_query($Bd, $query);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nota Final</th><th>ID de Grado</th><th>ID de Matrícula Estudiante</th></tr>";
        
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $fila['idLibreta'] . "</td>";
            echo "<td>" . $fila['NOTAFINAL'] . "</td>";
            echo "<td>" . $fila['grados_idGrad'] . "</td>";
            echo "<td>" . $fila['matricularestudiante_idMatricEst'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<script>alert('No se encontraron registros de libreta.');</script>";
    }

    mysqli_close($Bd);
}

// Función para actualizar un registro en la tabla libreta
function actualizarLibreta($idLibreta, $notaFinal, $gradosId, $matriculaEstudianteId) {
    $accion = 'actualizar';
    $Bd = conexionBaseDatos();

    $query = "UPDATE libreta 
              SET NOTAFINAL = '$notaFinal', grados_idGrad = $gradosId, matricularestudiante_idMatricEst = $matriculaEstudianteId 
              WHERE idLibreta = $idLibreta AND LIBRETAELIMINACIONLOGICA = 'A'";

    if (mysqli_query($Bd, $query)) {
        if (mysqli_affected_rows($Bd) > 0) {
            $identificador = 0;
        } else {
            $identificador = 1;
        }
    } else {
        $identificador = 1;
    }
    mensajePredeterminado($identificador, $accion, 'libreta');

    mysqli_close($Bd);
}

// Función para eliminar lógicamente un registro en la tabla libreta
function eliminarLibreta($idLibreta) {
    $accion = 'eliminar';
    $Bd = conexionBaseDatos();
    
    $query = "UPDATE libreta SET LIBRETAELIMINACIONLOGICA = 'E' WHERE idLibreta = $idLibreta";

    if (mysqli_query($Bd, $query)) {
        if (mysqli_affected_rows($Bd) > 0) {
            $identificador = 0;
        } else {
            $identificador = 1;
        }
    } else {
        $identificador = 1;
    }
    mensajePredeterminado($identificador, $accion, 'libreta');

    mysqli_close($Bd);
}
?>
