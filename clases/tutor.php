<?php
require './includes/conexion.php';
$bd = conectarBD();

class Tutor
{
    public $personas_Pers_id;

    public function __construct($personas_Pers_id)
    {
        $this->personas_Pers_id = $personas_Pers_id;
    }
}
