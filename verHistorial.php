<?php
include './pagInicialArriba.php';

?>
<div class='ladoDere70'>
    <div class='usarDisenio'>
        <div class="fondoDerechoCrud">
            <div class="crudDerecho">
                <div class='TituloCrud'>
                    <h1>Historial</h1>
                </div>
                <?php
                $Bd = conexionBaseDatos();
                $sql = "SELECT * FROM Historial";
                $resultado = mysqli_query($Bd, $sql);


                if (mysqli_num_rows($resultado) > 0) {
                ?>
                    <div class="tabla-datos">
                        <table>
                            <tr>
                                <th>ID Historial</th>
                                <th>Accion</th>
                                <th>Historia de los Modificados</th>
                                <th>Campo Modificado</th>
                                <th>Autor del Cambio</th>
                                <th>Fecha</th>
                                <?php
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                ?>
                            <tr>
                                <td><?php echo $fila['IDHistorial']; ?></td>
                                <td><?php echo $fila['Hist_Accion']; ?></td>
                                <td><?php echo $fila['Hist_De_los_Modificados']; ?></td>
                                <td><?php echo $fila['Hist_CampoModificado']; ?></td>
                                <td><?php echo $fila['Hist_Quien_Realizo_Cambio']; ?></td>
                                <td><?php echo $fila['Hist_Fecha']; ?></td>
                            </tr>
                    <?php
                                }
                            }
                    ?>
                        </table>
                    </div>
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