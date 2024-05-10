<?php
require './includes/conexion.php';

$bd= conectarBD();

class Domicilio {
    public $Doc_Barrio;
    public $Doc_Calle;
    public $Doc_Altura; 
    public $personas_Pers_id;  

    public function __construct($Doc_Barrio, $Doc_Calle, $Doc_Altura, $personas_Pers_id) {
        $this-> Doc_Altura = $Doc_Barrio;
        $this-> Doc_Calle = $Doc_Calle;
        $this-> Doc_Altura = $Doc_Altura;
        $this-> personas_Pers_id = $personas_Pers_id;
    }
}