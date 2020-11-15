<?php
require_once "controlador/controlador.php";
require_once "controlador/controlador_usuarios.php";

$ctrl = new controlador;
$ctrlu = new controlador_usuarios;

$logs = $ctrl->obtenerLogs();
$n = $ctrl->obtener_num_filas($logs);

$ctrl->titulo(4);
for ($i = 0; $i < $n; $i++) {
    $tupla = $ctrl->obtenerTuplas($logs, $i);
    $ctrl->mostrarLog($tupla);
}

c_div_HTML();
?>