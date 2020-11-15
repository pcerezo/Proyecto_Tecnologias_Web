<?php
require_once "controlador/controlador.php";
$ctrl = new controlador;

session_start();

if (!isset($_GET["modificar_usuario"])) {
    $ctrl->formEdicionUsuario();
}
else if ($_GET["modificar_usuario"] == "Modificar usuario") {
    $datos[0] = $_GET["nombre"];
    $datos[1] = $_GET["apellidos"];
    $datos[2] = $_GET["email"];

    if (isset($_GET["clave"]))
        $datos[3] = $_GET["clave"];

    $datos[4] = $_GET["direccion"];
    $datos[5] = $_GET["telefono"];

    $ctrl->formNoEditableUsuario($datos);
}
else if ($_GET["modificar_usuario"] == "Confirmar modificación") {
    $_SESSION["usuario"] = $_GET["nombre"];
    $_SESSION["apellidos"] = $_GET["apellidos"];
    $_SESSION["email"] = $_GET["email"];
    
    if (isset($_GET["clave"]))
        $_SESSION["clave"] = $_GET["clave"];

    $_SESSION["direccion"] = $_GET["direccion"];
    $_SESSION["telefono"] = $_GET["telefono"];

    $ctrl->editarUsuario();
}

?>