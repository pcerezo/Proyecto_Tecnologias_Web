<?php
require_once "controlador/controlador.php";
$ctrl = new controlador;
session_start();

$ctrl->titulo(1);

if (!isset($_GET["conf_edit_inc"])) {
    $ctrl->formularioIncidencia();
}
else if ($_GET["conf_edit_inc"] == "Crear incidencia") {

    $datos[0] = $_GET["titulo"];
    $datos[1] = $_GET["descripcion"];
    $datos[2] = $_GET["lugar"];
    $datos[3] = $_GET["etiquetas"];
    $datos[4] = $_SESSION["email"];
    $datos[5] = $_GET["fecha"];
    $datos[6] = $_GET["estado"];

    //echo "Estado: $datos[6]";
    $ctrl->nuevaIncidencia($datos);

    $evento = "El usuario {$_SESSION["email"]} ha añadido una incidencia.";
    $ctrl->aniadirEvento($evento);

    $id_incidencia = $ctrl->obtenerIdIncidencia($_SESSION["email"]);

    echo "id_incidencia = $id_incidencia";
    //$tupla = $ctrl->obtenerInfo($id_incidencia);
    $ctrl->formEditarIncidencia($id_incidencia, 1);
    //$ctrl->edicionIncidencia($tupla, 1);
    //echo "ID incidencia= $id_incidencia";
}
else if ($_GET["conf_edit_inc"] == "Confirmar") {
    $datos[0] = $_GET["titulo"];
    $datos[1] = $_GET["descripcion"];
    $datos[2] = $_GET["lugar"];
    $datos[3] = $_GET["etiqueta"];
    $datos[4] = $_GET["estado"];
    $datos[5] = $_GET["autor"];
    $datos[6] = $_GET["fecha"];

    $id_incidencia = $ctrl->obtenerIdIncidencia($_GET["autor"]);
    echo "ID_incidencia: $id_incidencia";
    $datos[7] = $id_incidencia;

    $ctrl->editarIncidencia($datos);

    if (is_array($_GET["imagenes"])) {
        $fotos=$_GET["imagenes"];
        $size = count($fotos);

        for ($i = 0; $i < $size; $i++) {
            $ctrl->insertarFoto($id_incidencia, $fotos[$i]);
        }
        echo "Fotos: ";
        print_r($fotos);
    }
}

?>