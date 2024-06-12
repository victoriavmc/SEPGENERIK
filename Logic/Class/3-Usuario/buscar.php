<?php
// Mensaje Predeterminado
include '../../Connection/conexion.php';
include '../../PHP/msjPredeterminado.php';

// BUSCAR USUARIO EXISTE
function buscarUsuario($Bd, $tipoBusqueda, $identUsu)
{
    $accion = 'buscar';
    $tabla = 'usuario';
    switch ($tipoBusqueda) {
        case '1':
            $query = "SELECT * FROM usuario WHERE idUsu = '$identUsu' AND eliminacionLogUsu= 'A'";
            $resultado = mysqli_query($Bd, $query);
            if (mysqli_num_rows($resultado) > 0) {
                echo mensajePredeterminado(2, $accion, $tabla);
                return array($resultado, true);
                break;
            } else {
                echo mensajeBusqueda($tabla);
                return array(null, false);
                break;
            }

        case '2':
            $query = "SELECT * FROM usuario JOIN preestablecerrol on usuario.PreestablecerRol_PreestablecerRol_id= preestablecerrol.idPreRol WHERE preestablecerrol.nombreRol= UCASE('$identUsu') AND eliminacionLogUsu= 'A';";

            $resultado = mysqli_query($Bd, $query);
            if (mysqli_num_rows($resultado) > 0) {
                echo mensajePredeterminado(2, $accion, $tabla);
                return array($resultado, true);
                break;
            } else {
                echo mensajeBusqueda($tabla);
                return array(null, false);
                break;
            }

        default:
            return mensajePredeterminado(2, $accion, $tabla);
            break;
    }
}

// Función para mostrar la tabla
function mostrarTabla($Bd)
{
    $queryListar = "SELECT u.IdUsu, u.userUsu, u.estadorolUsu, p.nombreRol 
                    FROM usuario u 
                    JOIN preestablecerrol p ON u.PreestablecerRol_PreestablecerRol_id = p.idPreRol 
                    WHERE u.eliminacionLogUsu = 'A'";
    $resultadoListar = $Bd->query($queryListar);

    echo '<table border="1">
            <tr>
                <th>ID Usuario</th>
                <th>Usuario</th>
                <th>Estado Usuario</th>
                <th>Nombre Rol</th>
            </tr>';

    while ($fila = $resultadoListar->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($fila['IdUsu']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['userUsu']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['estadorolUsu']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['nombreRol']) . "</td>";
        echo "</tr>";
    }
    echo '</table>';
}
