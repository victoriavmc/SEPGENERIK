<?php
include './pagInicialArriba.php';
?>

<div class='ladoDere70'>
    <div class='usarDisenio'>
        <div class="fondoDerechoCrud">
            <div class="crudDerecho">
                <div class='TituloCrud'>
                    <h1>Datos de Planillas Docentes</h1>
                </div>
                <?php

                $Bd = conexionBaseDatos();
                $query = "SELECT rd.IdRegPlaDoc, rd.fechaInicioRegPlaDoc, rd.estadoRegPlaDoc, rd.fechaAltaRegPlaDoc, p.nombrePers, p.apellidoPers, p.cuilPers, g.numerogradoGrad, t.horaTurno, divs.nombreDivisionDivi, GROUP_CONCAT(DISTINCT mat.nombreMateriaMat SEPARATOR ', ') AS materias

                FROM registrodeplanillasdocente as rd
                JOIN docentes as d ON rd.docentes_Doc_id = d.id
                JOIN personas as p ON d.personas_Pers_id = p.idPers
                JOIN grados as g ON rd.grados_Grad_id = g.idGrad
                JOIN resgistroturnodivision as rDT ON g.resgistroturnodivision_Reg_TurnoDivi_id = rDT.idRegTurnoDivi
                JOIN turno as t ON rDT.turno_Turno_id = t.idTurno
                JOIN division as divs ON rDT.Division_Divi_id = divs.idDivi
                JOIN materias as mat ON g.materias_Mat_id = mat.MatidMat
                WHERE rd.EliminacionLogiRegPlaDoc = 'A' AND g.EliminacionLogGrad = 'A'
                GROUP BY d.id";
                $resultado = mysqli_query($Bd, $query);

                if (mysqli_num_rows($resultado) > 0) {
                ?>
                    <div class="tabla-datos">
                        <table>
                            <tr>
                                <th>ID Registro</th>
                                <th>Fecha de Inicio</th>
                                <th>Estado</th>
                                <th>Fecha de Alta</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>CUIL</th>
                                <th>Grado</th>
                                <th>Hora de Turno</th>
                                <th>División</th>
                                <th>Materias</th>
                                <?php
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                ?>
                            <tr>
                                <td><?php echo $fila['IdRegPlaDoc']; ?></td>
                                <td><?php echo $fila['fechaInicioRegPlaDoc']; ?></td>
                                <td><?php echo $fila['estadoRegPlaDoc']; ?></td>
                                <td><?php echo $fila['fechaAltaRegPlaDoc']; ?></td>
                                <td><?php echo $fila['nombrePers']; ?></td>
                                <td><?php echo $fila['apellidoPers']; ?></td>
                                <td><?php echo $fila['cuilPers']; ?></td>
                                <td><?php echo $fila['numerogradoGrad']; ?></td>
                                <td><?php echo $fila['horaTurno']; ?></td>
                                <td><?php echo $fila['nombreDivisionDivi']; ?></td>
                                <td><?php echo $fila['materias']; ?></td>
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