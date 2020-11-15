<?php
require_once "controlador/controlador.php";
$ctrl = new controlador;
session_start();

$ctrl->titulo(0);
//Mostrar incidencias
$consulta = $ctrl->obtenerIncidencias();
$num_filas = $ctrl->obtener_num_filas($consulta);

if (isset($_GET["comentar"])) {
    $_SESSION["ult_incidencia"] = $_GET["id_inc"]; //Guardamos el ID de la última incidencia con la que hemos interactuado
    $tupla = $ctrl->obtenerInfo($_GET["id_inc"]);
    $ctrl->formularioComentar($tupla);
}
else if (isset($_GET["tratar_inc"])) {
    if ($_GET["tratar_inc"] == "Editar Incidencia") {
        $ctrl->formEditarIncidencia($_GET["id_inc"], 0);
    }
    else if ($_GET["tratar_inc"] == "Borrar Incidencia") {
        $ctrl->formBorrarIncidencia($_GET["id_inc"]);
    }
}
else if ($_GET["conf_edit_inc"] == "Confirmar") {
    $datos[0] = $_GET["titulo"];
    $datos[1] = $_GET["descripcion"];
    $datos[2] = $_GET["lugar"];
    $datos[3] = $_GET["etiqueta"];
    $datos[4] = $_GET["estado"];
    $datos[5] = $_GET["autor"];
    $datos[6] = $_GET["fecha"];
    $datos[7] = $_GET["id_inc"];

    echo "Id_inc: $datos[7]";

    $ctrl->editarIncidencia($datos, 0);
}
else if (isset($_GET["apoyo"])) {
    if ($_GET["apoyo"] == "Me gusta") {
        $ctrl->aniadirLike($_GET["id_inc"]);
    }
    else {
        $ctrl->aniadirDislike($_GET["id_inc"]);
    }
}
else {
    for ($i = 0; $i < $num_filas; $i++){
        //Obtengo la info. de cada incidencia
        $tupla_inc = $ctrl->obtenerTuplas($consulta, $i);
        $fotos = $ctrl->obtenerFotos($tupla_inc["id"]);

        $ctrl->mostrarIncidencia($tupla_inc, $fotos);

        //Obtengo todos sus comentarios
        $comentarios = $ctrl->obtenerComentarios($tupla_inc["id_inc"]);
        $num_comentarios = $ctrl->obtener_num_filas($comentarios);

        for ($j = 0; $j < $num_comentarios; $j++) {
            $tupla_com = $ctrl->infoComentario($comentarios, $j);

            $ctrl->mostrarComentario($tupla_com);
        }

        //Dependiendo del rol que tengamos, tendremos unas opciones u otras
        $ctrl->mostrarBotones($tupla_inc, $_SESSION["rol"]);
    }
}

c_div_HTML();

?>