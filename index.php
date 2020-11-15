<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Pablo Cerezo">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Quejas</title>

        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="css/bootstrap.css">
    </head>
    <body>
<?php
require_once "controlador/controlador.php";

require_once "etiquetas_html.php";
session_start();
$ctrl = new controlador;

container_HTML();

require "cabecera.html"; //Muestro un pequeño encabezado

$ctrl->navegacion();

if (!isset($_SESSION["usuario"])) {
    $rol = "visitante";
    $pagina = 0;
    $ctrl->login();
}
else {
    $rol = $_SESSION["rol"];
    $ctrl->logeado();
}

main_aside_HTML(); //tag para el contenedor de <main> y <aside>
main_HTML();
if (!isset($_GET['p'])) {
    $pagina = 0;
}
else {
    $pagina = $_GET['p'];
}

if (isset($_GET['login'])) {
    $res = $ctrl->comprobar($_GET["email"], $_GET["clave"]);
    //Apunto el evento de iniciar sesión

    echo "res: $res";
    if ($res) {
        $evento = "El usuario {$_GET["email"]} ha iniciado sesión.";
        $ctrl->aniadirEvento($evento);
    }

    header("Location:index.php");
}
else if (isset($_GET['logout'])) {
    $ctrl->logout();
    //Apunto que el usuario se sale de la sesión
    $evento = "El usuario {$_GET["email"]} sale de la sesión.";
    $ctrl->aniadirEvento($evento);
    header("Location:index.php");
}

if (isset($_GET["conf_comentario"])) {
    if (isset($_SESSION["email"])){
            $usuario = $_SESSION["email"];
    }
    else {
        $usuario = "Anónimo";
    }

    $ctrl->comentarIncidencia($_GET["comentario"], $_SESSION["ult_incidencia"], $usuario);

    $evento = "El usuario $usuario ha hecho un comentario de la incidencia {$_SESSION["ult_incidencia"]}.";
    $ctrl->aniadirEvento($evento);
}

/*if (isset($_GET["comentar"])) {
    //include "incidencia.php";
    //Obtengo la tupla de la incidencia a partir de su id
    //echo "ID:{$_GET["id_incidencia"]}";
    $_SESSION["ult_incidencia"] = $_GET["id_incidencia"]; //Guardamos el ID de la última incidencia con la que hemos interactuado
    $tupla = $ctrl->obtenerInfo($_GET["id_incidencia"]);
    $ctrl->formularioComentar($tupla);
    //HTMLIncidencia($tupla);
}
else */if (isset($_GET["editar"]) || isset($_GET["modificar_usuario"])) {
    require "edit.php";
}
else {
    if ($pagina == 0) { //Por defecto: obtener listado de incidencias en index
        require "inicio.php";
    }
    else if ($pagina == 1) {
        require "nueva_incidencia.php";
    }
    else if ($pagina == 2) {
        require "mis_incidencias.php";
    }
    else if ($pagina == 3) {
        require "gestion_usuarios.php";
    }
    else if ($pagina == 4) {
        require "log.php";
    }
    else if ($pagina == 5) {
        require "gestion_bbdd.php";
    }
}

c_main_HTML();

aside_HTML();
//Contenido de aside
c_aside_HTML();
c_div_HTML();
c_div_HTML();

?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>