<?php
include './pagInicialArriba.php';
?>

<div class='ladoDere70'>
    <div class='usarDisenio'>
        <div class="fondoDerechoCrud">
            <div class="crudDerecho">
                <div class='TituloCrud'>
                    <h1>Boletines</h1>
                </div>
                <?php

                $Bd = conexionBaseDatos();
                $mostrarBoletin = "SELECT bolentin.idboletin,
                    bolentin.CantidadFaltasxTrimestre,
                    CONCAT(
                        grados.numerogradoGrad,
                        ' - ',
                        d.nombreDivisionDivi,
                        ' - ',
                        t.horaTurno
                    ) AS Grado,
                    materias.nombreMateriaMat,
                    libreta.NOTAFINAL,
                    CONCAT(personas.nombrePers,' ', personas.apellidoPers) AS Estudiante
                FROM
                    bolentin
                JOIN libreta ON bolentin.libreta_idLibreta = libreta.idLibreta
                JOIN matricularestudiante ON libreta.matricularestudiante_idMatricEst = matricularestudiante.idMatricEst
                JOIN estudiantes ON matricularestudiante.estudiantes_Est_id = estudiantes.idEst
                JOIN personas ON estudiantes.personas_Pers_id = personas.idPers
                JOIN grados ON libreta.grados_idGrad = grados.idGrad
                JOIN materias ON grados.materias_Mat_id = materias.MatidMat
                JOIN resgistroturnodivision AS rTD ON rTD.idRegTurnoDivi = grados.resgistroturnodivision_Reg_TurnoDivi_id
                JOIN division AS d ON rTD.Division_Divi_id = d.idDivi
                JOIN turno AS t ON rTD.turno_Turno_id = t.idTurno 
                WHERE bolentin.EliminacionLogicaBole='A'
                GROUP BY materias.nombreMateriaMat, personas.nombrePers, personas.apellidoPers  
                ORDER BY `Estudiante` ASC";
                $resultado = mysqli_query($Bd, $mostrarBoletin);
                if ($resultado && mysqli_num_rows($resultado) > 0) {
                ?>
                    <div class="tabla-datos">
                        <table>
                            <tr>
                                <th>Estudiante</th>
                                <th>Grado</th>
                                <th>Cantidad Faltas Por Trimestre</th>
                                <th>Nombre Materia</th>
                                <th>Nota Final</th>
                            </tr>
                            <?php

                            while ($fila = mysqli_fetch_assoc($resultado)) {
                            ?>
                                <tr>
                                    <td><?php echo $fila['Estudiante']; ?></td>
                                    <td><?php echo $fila['Grado']; ?></td>
                                    <td><?php echo $fila['CantidadFaltasxTrimestre']; ?></td>
                                    <td><?php echo $fila['nombreMateriaMat']; ?></td>
                                    <td><?php echo $fila['NOTAFINAL']; ?></td>
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
                <br>
                <form class="busqueda" action="./pag404.php" method="GET">
                    <input type="text" name='cuilinput' placeholder="CUIL">
                    <button>
                        <img src="./Style/Images/buscarUser.png" width="50PX" alt="BUSQUEDA">
                    </button>
                </form>
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