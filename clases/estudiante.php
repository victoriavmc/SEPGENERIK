<?php
require './includes/conexion.php';
$bd = conectarBD();

class Estudiante {
    public $Est_fotocopiadni;
    public $Est_estado;
    public $personas_Pers_id;

    public function __construct($Est_estado,$Est_fotocopiadni,$personas_Pers_id)
    {
        $this-> Est_estado= $Est_estado;
        $this-> Est_fotocopiadni= $Est_fotocopiadni;
        $this-> personas_Pers_id= $personas_Pers_id;
    }
}
