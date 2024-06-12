<?php
// Mensaje Predeterminado
include '../../PHP/msjPredeterminado.php';

// BUSCAR Domicilio EXISTE
function buscarDomicilio($Bd, $tipoBusqueda, $identDom)
{
    $accion = 'buscar';
    $tabla = 'domicilio';
    switch ($tipoBusqueda) {
        case '1':
            $query = "SELECT * FROM domicilio WHERE idDom = '$identDom' and EliminacionLogDom= 'A' ";
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
            buscarPersona($Bd, $tipoBusqueda, $identDom);
            break;

        default:
            return mensajePredeterminado(2, $accion, $tabla);
            break;
    }
}

function mostrarDomicilioEspecifico($Bd, $tipoBusqueda, $numDomicilio)
{
    // Llamamos a la función buscarDomicilio y obtenemos el resultado en un arreglo
    $resultado = buscarDomicilio($Bd, $tipoBusqueda, $numDomicilio);

    if ($resultado[1]) {
        $domicilio = mysqli_fetch_assoc($resultado[0]);
        $id = $domicilio['idDom'];
        $barrio = $domicilio['BarrioDom'];
        $calle = $domicilio['CalleDom'];
        $altura = $domicilio['AlturaDom'];
        $persona = $domicilio['personas_Pers_id'];

        // Verificamos si se obtuvieron resultados
        if ($resultado[1]) {
            // Tabla
            echo "<table border='1'>";
            echo "<tr><th>ID</th>
            <th>Barrio</th>
            <th>Calle</th>
            <th>Altura</th>
            <th>Persona</th>";
            echo "<tr>";
            echo "<td>" . $id . "</td>";
            echo "<td>" . $barrio . "</td>";
            echo "<td>" . $calle . "</td>";
            echo "<td>" . $altura . "</td>";
            echo "<td>" . $persona . "</td>";
            echo "</tr>";
            echo "</table>";
        }
    }
}
