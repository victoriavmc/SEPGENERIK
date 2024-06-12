<?php
include './pagInicialArriba.php';
?>

<div class='ladoDere70'>
    <div class='usarDisenio'>
        <div class="fondoDerechoCrud">
            <div class="crudDerecho">
                <div class='TituloCrud'>
                    <h1>Grados</h1>
                </div>
                <?php

                $Bd = conexionBaseDatos();
                $query = "SELECT grados.idGrad, 
       grados.numerogradoGrad, 
       GROUP_CONCAT(DISTINCT materias.nombreMateriaMat SEPARATOR ', ') AS materias,
       turno.horaTurno, 
       division.nombreDivisionDivi, 
       personas.nombrePers, 
       personas.apellidoPers, 
       registrodeplanillasdocente.fechaInicioRegPlaDoc, 
       registrodeplanillasdocente.fechaAltaRegPlaDoc
FROM grados
JOIN materias ON grados.materias_Mat_id = materias.MatidMat
JOIN resgistroturnodivision ON grados.resgistroturnodivision_Reg_TurnoDivi_id = resgistroturnodivision.idRegTurnoDivi
JOIN turno ON resgistroturnodivision.turno_Turno_id = turno.idTurno
JOIN division ON resgistroturnodivision.Division_Divi_id = division.idDivi
JOIN registrodeplanillasdocente ON registrodeplanillasdocente.grados_Grad_id = grados.idGrad
JOIN docentes ON registrodeplanillasdocente.docentes_Doc_id = docentes.id
JOIN personas ON docentes.personas_Pers_id = personas.idPers
WHERE grados.EliminacionLogGrad = 'A' 
AND registrodeplanillasdocente.EliminacionLogiRegPlaDoc = 'A' 
AND docentes.EliminacionLogDoc = 'A'
GROUP BY docentes.id;";
                $resultado = mysqli_query($Bd, $query);

                // Comprobar si hay resultados
                if ($resultado && mysqli_num_rows($resultado) > 0) {
                ?>
                    <div class="tabla-datos">
                        <table>
                            <tr>
                                <th>ID de Grado</th>
                                <th>Número de Grado</th>
                                <th>Materias</th>
                                <th>Hora de Turno</th>
                                <th>División</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Alta</th>
                            </tr>
                            <?php
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                            ?>
                                <tr>
                                    <td><?php echo $fila['idGrad']; ?></td>
                                    <td><?php echo $fila['numerogradoGrad']; ?></td>
                                    <td><?php echo $fila['materias']; ?></td>
                                    <td><?php echo $fila['horaTurno']; ?></td>
                                    <td><?php echo $fila['nombreDivisionDivi']; ?></td>
                                    <td><?php echo $fila['nombrePers']; ?></td>
                                    <td><?php echo $fila['apellidoPers']; ?></td>
                                    <td><?php echo $fila['fechaInicioRegPlaDoc']; ?></td>
                                    <td><?php echo $fila['fechaAltaRegPlaDoc']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                <?php
                } else {
                    echo "No se encontraron datos.";
                }
                ?>
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