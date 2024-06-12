<?php
include './pagInicialArriba.php';
?>

<div class='ladoDere70'>
    <div class='usarDisenio'>
        <div class="fondoDerechoCrud">
            <div class="crudDerecho">
                <div class='TituloCrud'>
                    <h1>Observaciones</h1>
                </div>
                <?php

                $Bd = conexionBaseDatos();
                $query = "SELECT 
                MAX(oT.idObsTri) AS idObsTri, p.nombrePers, p.apellidoPers, e.estadoEst, 
                MAX(o.fechadeobservacionObs) AS fechadeobservacionObs, pEO.PreestableciendoObservacioncol, t.nombretrimestreTri, g.numerogradoGrad 
                FROM observaciontrimestral AS oT 
                JOIN matricularestudiante AS mE ON mE.idMatricEst = oT.matricularestudiante_Matric_Est_id 
                JOIN estudiantes AS e ON mE.estudiantes_Est_id = e.idEst 
                JOIN personas AS p ON e.personas_Pers_id = p.idPers 
                JOIN observaciones AS o ON oT.observaciones_Obs_id = o.idObs 
                JOIN preestableciendoobservacion AS pEO ON o.PreestableciendoObservacion_PreestObs_ID = pEO.IDPreObs 
                JOIN trimestre AS t ON oT.trimestre_Tri_id = t.idTri 
                JOIN registrodeplanillaestudiante rpe ON rpe.matricularestudiante_Matric_Est_id = mE.idMatricEst 
                JOIN grados g ON rpe.grados_Grad_id = g.idGrad 
                WHERE oT.EliminacionLogObsTri = 'A' 
                GROUP BY p.nombrePers, p.apellidoPers, e.estadoEst, pEO.PreestableciendoObservacioncol, t.nombretrimestreTri, g.numerogradoGrad";
                $resultado = mysqli_query($Bd, $query);

                // Comprobar si hay resultados
                if ($resultado && mysqli_num_rows($resultado) > 0) {
                ?>
                    <div class="tabla-datos">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Estado</th>
                                    <th>Fecha Observación</th>
                                    <th>Preestableciendo Observación</th>
                                    <th>Trimestre</th>
                                    <th>Grado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                ?>
                                    <tr>
                                        <td><?php echo $fila['idObsTri']; ?></td>
                                        <td><?php echo $fila['nombrePers']; ?></td>
                                        <td><?php echo $fila['apellidoPers']; ?></td>
                                        <td><?php echo $fila['estadoEst']; ?></td>
                                        <td><?php echo $fila['fechadeobservacionObs']; ?></td>
                                        <td><?php echo $fila['PreestableciendoObservacioncol']; ?></td>
                                        <td><?php echo $fila['nombretrimestreTri']; ?></td>
                                        <td><?php echo $fila['numerogradoGrad']; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php
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