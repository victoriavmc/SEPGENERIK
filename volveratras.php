<?php
$currentFile = basename($_SERVER['PHP_SELF']);

if ($currentFile != 'pagInicial.php') {
    echo '<div class="atras">
            <a href="./pagInicial.php"><img src="../../Style/Images/atras.png" width="60" alt="volver"></a>
          </div>';
}
?>