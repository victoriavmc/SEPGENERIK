<?php
include './pagInicialArriba.php';
?>

<div class='ladoDere70'>
    <div class='usarDisenio'>
        <div class="fondoDerechoCrud">
            <div class="crudDerecho">
                <div class='TituloCrud'>
                    <h1>Datos de Tutores e Hijos</h1>
                </div>
                <?php

                $Bd = conexionBaseDatos();

                // Consulta para obtener datos de tutores y sus personas
                $query_tutores = "SELECT 
    t.idTutores,
    p1.nombrePers AS NombreTutor,
    p1.apellidoPers AS ApellidoTutor,
    e.idEst,
    p2.nombrePers AS NombreEstudiante,
    p2.apellidoPers AS ApellidoEstudiante,
    e.estadoEst
FROM 
    tutores t
JOIN 
    estudiantes e ON e.idEst = t.estudiantes_Est_id
JOIN 
    personas p2 ON p2.idPers = e.personas_Pers_id
JOIN 
    tutor ON tutor.idTutor = t.tutor_Tutor_id
JOIN 
    personas p1 ON p1.idPers = tutor.personas_Pers_id
WHERE 
    t.EliminacionLogTutores = 'A' 
    AND e.EliminacionLogEst = 'A';";
                $resultado_tutores = mysqli_query($Bd, $query_tutores);

                if ($resultado_tutores) {
                ?>
                    <div class="tabla-datos">
                        <table border="1">
                            <tr>
                                <th>ID Tutor</th>
                                <th>Nombre Tutor</th>
                                <th>Apellido Tutor</th>
                                <th>ID Estudiante</th>
                                <th>Nombre Estudiante</th>
                                <th>Apellido Estudiante</th>
                                <th>Estado Estudiante</th>
                            </tr>
                            <?php
                            // Recorre los resultados de tutores y estudiantes y muestra los datos en la tabla
                            while ($fila = mysqli_fetch_assoc($resultado_tutores)) {
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($fila['idTutores']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['NombreTutor']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['ApellidoTutor']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['idEst']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['NombreEstudiante']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['ApellidoEstudiante']); ?></td>
                                    <td><?php echo htmlspecialchars($fila['estadoEst']); ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                <?php
                } else {
                    echo "Error al ejecutar la consulta: " . mysqli_error($Bd);
                }

                // Cierra la conexión
                mysqli_close($Bd);
                ?>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class='footer'>
    <?php $template_path = './footer.php';
    include $template_path; ?>
</div>
</body>

</html>