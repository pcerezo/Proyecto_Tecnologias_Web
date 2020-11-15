<?php
require_once "vista/view.php";
require_once "modelo/bd_model.php";

class controlador_bk_rest {
    private $vista;
    private $bd;

    public function __construct() {
        $this->vista = new vista;
        $this->bd = new bd_model;
    }

    public function opciones_gestion_bbdd() {
        $this->vista->opcionesBBDD();
    }

}
?>
