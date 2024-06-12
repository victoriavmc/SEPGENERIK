<?php
// Conexion
include '../Connection/conexion.php';

// Mensaje Predeterminado
include '../PHP/msjPredeterminado.php';
$mensaje = mensajePredeterminado($identificador = 0, $accion = '', 'persona');

function crearCalificacionExamen($valornotaCalf, $fecharindeCalf) {
    $accion = 'crear';
    $Bd = conexionBaseDatos();
    
    $query = "INSERT INTO calificacionexamen (valornotaCalf, fecharindeCalf, EliminacionLogCalf) 
              VALUES ('$valornotaCalf', '$fecharindeCalf', 'A')";

    if (mysqli_query($Bd, $query)) {
        $identificador = 0;
    } else {
        $identificador = 1;
    }
    mensajePredeterminado($identificador, $accion, 'calificación');

    mysqli_close($Bd);
}


function leerCalificacionExamen() {
    $Bd = conexionBaseDatos();
    $query = "SELECT * FROM calificacionexamen WHERE EliminacionLogCalf = 'A'";
    $resultado = mysqli_query($Bd, $query);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nota</th><th>Fecha</th></tr>";
        
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $fila['idCalf'] . "</td>";
            echo "<td>" . $fila['valornotaCalf'] . "</td>";
            echo "<td>" . $fila['fecharindeCalf'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        mensajeBusqueda('calificaciones');
    }

    mysqli_close($Bd);
}

function actualizarCalificacionExamen($idCalf, $valornotaCalf, $fecharindeCalf) {
    $accion = 'actualizar';
    $Bd = conexionBaseDatos();
    
    $query = "UPDATE calificacionexamen 
              SET valornotaCalf = '$valornotaCalf', fecharindeCalf = '$fecharindeCalf' 
              WHERE idCalf = $idCalf AND EliminacionLogCalf = 'A'";

    if (mysqli_query($Bd, $query)) {
        if (mysqli_affected_rows($Bd) > 0) {
            $identificador = 0;
        } else {
            $identificador = 1;
        }
    } else {
        $identificador = 1;
    }
    mensajePredeterminado($identificador, $accion, 'calificación');

    mysqli_close($Bd);
}

function eliminarCalificacionExamen($idCalf) {
    $accion = 'eliminar';
    $Bd = conexionBaseDatos();
    
    $query = "UPDATE calificacionexamen SET EliminacionLogCalf = 'E' WHERE idCalf = $idCalf";

    if (mysqli_query($Bd, $query)) {
        if (mysqli_affected_rows($Bd) > 0) {
            $identificador = 0;
        } else {
            $identificador = 1;
        }
    } else {
        $identificador = 1;
    }
    mensajePredeterminado($identificador, $accion, 'calificación');

    mysqli_close($Bd);
}

