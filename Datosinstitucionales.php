<?php
include './pagInicialArriba.php';
?>

<div class='ladoDere70'>
    <div class='usarDisenio'>
        <div class="fondoDerechoCrud">
            <div class="crudDerecho">
                <div class='TituloCrud'>
                    <h1>Datos Institucionales</h1>
                </div>
                <?php

                $Bd = conexionBaseDatos();
                $query = "SELECT i.idInst, i.nombrecolegioInst, i.numerocolegioInst, i.linkInst, i.CorreoInst, i.telefonoInst, d.BarrioDom, d.CalleDom, d.AlturaDom
                        FROM institucion as i
                        JOIN domicilio as d ON i.domicilio_Doc_id = d.idDom
                        WHERE i.EliminacionLogInst = 'A'";
                $resultado = mysqli_query($Bd, $query);

                // Comprobar si hay resultados
                if (mysqli_num_rows($resultado) > 0) {
                ?>
                    <div class="tabla-datos">
                        <table>
                            <tr>
                                <th>idInst</th>
                                <th>Nombre Colegio</th>
                                <th>Número Colegio</th>
                                <th>Link</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Barrio</th>
                                <th>Calle</th>
                                <th>Altura</th>
                            </tr>
                            <?php
                            // Iterar sobre los resultados y mostrarlos en la tabla
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                            ?>
                                <tr>
                                    <td><?php echo $fila['idInst']; ?></td>
                                    <td><?php echo $fila['nombrecolegioInst']; ?></td>
                                    <td><?php echo $fila['numerocolegioInst']; ?></td>
                                    <td><?php echo $fila['linkInst']; ?></td>
                                    <td><?php echo $fila['CorreoInst']; ?></td>
                                    <td><?php echo $fila['telefonoInst']; ?></td>
                                    <td><?php echo $fila['BarrioDom']; ?></td>
                                    <td><?php echo $fila['CalleDom']; ?></td>
                                    <td><?php echo $fila['AlturaDom']; ?></td>
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