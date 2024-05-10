<?php
require './includes/conexion.php';
$bd = conectarBD();

class Admin {
    protected $correoAdm;
    protected $usuario_UsuId;

    public function __construct($correoAdm, $usuario_UsuId )
    { 
        $this->correoAdm = $correoAdm;
        $this->usuario_UsuId = $usuario_UsuId;
    }

}