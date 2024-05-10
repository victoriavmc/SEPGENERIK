<?php
require './includes/conexion.php';
$bd= conectarBD();

class Docente {
    public $usuario_Usu_Id;
    public $personas_Pers_id;

    public function __construct($usuario_Usu_Id, $personas_Pers_id)
    {
        $this->usuario_Usu_Id = $usuario_Usu_Id;
        $this->personas_Pers_id = $personas_Pers_id;
    }
}