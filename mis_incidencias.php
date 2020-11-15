<?php
require_once "controlador/controlador.php";
$ctrl = new controlador;
session_start();

$ctrl->titulo(2);
//Mostrar mis incidencias
$consulta = $ctrl->obtenerIncidenciasUsuario($_SESSION["email"]);
$num_filas = $ctrl->obtener_num_filas($consulta);

for($i = 0; $i < $num_filas; $i++){
    $tupla_inc = $ctrl->obtenerTuplas($consulta, $i);
    $fotos = $ctrl->obtenerFotos($tupla_inc["id"]);

    $ctrl->mostrarIncidencia($tupla_inc, $fotos);

    $comentarios = $ctrl->obtenerComentarios($tupla_inc["id_inc"]);
    $num_comentarios = $ctrl->obtener_num_filas($comentarios);

    for ($j = 0; $j < $num_comentarios; $j++) {
        $tupla_com = $ctrl->infoComentario($comentarios, $j);

        $ctrl->mostrarComentario($tupla_com);
    }

    $ctrl->mostrarBotones($tupla_inc);
}

c_div_HTML();
?>