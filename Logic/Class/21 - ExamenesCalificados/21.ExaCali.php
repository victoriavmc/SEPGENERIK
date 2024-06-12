<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

function crearExamenCalificado($trimestreId, $nombreExamenId, $calificacionExamenId, $matriculaEstudianteId, $registroDocenteId) {
    $accion = 'crear';
    $Bd = conexionBaseDatos();

    $query = "INSERT INTO examenescalificados (EliminacionLogExaCalfi, trimestre_Tri_id, nombreexamen_Exa_id, calificacionexamen_Calf_id, matricularestudiante_Matric_Est_id, registrodeplanillasdocente_Reg_Pla_Doc_Id) 
              VALUES ('A', $trimestreId, $nombreExamenId, $calificacionExamenId, $matriculaEstudianteId, $registroDocenteId)";

    if (mysqli_query($Bd, $query)) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    mensajePredeterminado($identificador, $accion, 'examen calificado');

    mysqli_close($Bd);
}

function leerExamenesCalificados() {
    $Bd = conexionBaseDatos();
    $query = "SELECT * FROM examenescalificados WHERE EliminacionLogExaCalfi = 'A'";
    $resultado = mysqli_query($Bd, $query);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Trimestre</th><th>Nombre del Examen</th><th>Calificación</th><th>Matrícula de Estudiante</th><th>Registro de Docente</th></tr>";
        
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $fila['idExaCalfi'] . "</td>";
            echo "<td>" . $fila['trimestre_Tri_id'] . "</td>";
            echo "<td>" . $fila['nombreexamen_Exa_id'] . "</td>";
            echo "<td>" . $fila['calificacionexamen_Calf_id'] . "</td>";
            echo "<td>" . $fila['matricularestudiante_Matric_Est_id'] . "</td>";
            echo "<td>" . $fila['registrodeplanillasdocente_Reg_Pla_Doc_Id'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        mensajeBusqueda('examenes calificados');
    }

    mysqli_close($Bd);
}

function actualizarExamenCalificado($idExaCalfi, $trimestreId, $nombreExamenId, $calificacionExamenId, $matriculaEstudianteId, $registroDocenteId) {
    $accion = 'actualizar';
    $Bd = conexionBaseDatos();

    $query = "UPDATE examenescalificados 
              SET trimestre_Tri_id = $trimestreId, nombreexamen_Exa_id = $nombreExamenId, calificacionexamen_Calf_id = $calificacionExamenId, 
                  matricularestudiante_Matric_Est_id = $matriculaEstudianteId, registrodeplanillasdocente_Reg_Pla_Doc_Id = $registroDocenteId 
              WHERE idExaCalfi = $idExaCalfi AND EliminacionLogExaCalfi = 'A'";

    if (mysqli_query($Bd, $query)) {
        if (mysqli_affected_rows($Bd) > 0) {
            $identificador = 0;
        } else {
            $identificador = 1;
        }
    } else {
        $identificador = 1;
    }
    mensajePredeterminado($identificador, $accion, 'examen calificado');

    mysqli_close($Bd);
}

function eliminarExamenCalificado($idExaCalfi) {
    $accion = 'eliminar';
    $Bd = conexionBaseDatos();
    
    $query = "UPDATE examenescalificados SET EliminacionLogExaCalfi = 'E' WHERE idExaCalfi = $idExaCalfi";

    if (mysqli_query($Bd, $query)) {
        if (mysqli_affected_rows($Bd) > 0) {
            $identificador = 0;
        } else {
            $identificador = 1;
        }
    } else {
        $identificador = 1;
    }
    mensajePredeterminado($identificador, $accion, 'examen calificado');

    mysqli_close($Bd);
}
