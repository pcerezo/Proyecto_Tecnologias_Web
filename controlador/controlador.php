<?php
require_once "vista/view.php";
require_once "modelo/bd_model.php";

class controlador {
    private $bd;
    private $vista;

    public function __construct(){
        $this->bd = new bd_model;
        $this->vista = new vista;
    }

    public function obtenerTuplas($con, $i) {
        return $this->bd->obtenerTuplas($con, $i);
    }

    public function obtenerInfo($id_incidencia) { //Obtengo toda la información relativa al identificador de incidencia
        $tupla = $this->bd->obtenerIncidencia($id_incidencia);

        return $tupla;
    }

    public function navegacion(){
        $this->vista->nav();
    }

    public function obtenerIncidencias() {
        $list = $this->bd->listadoIncidencias();

        return $list;
    }

    public function obtenerIncidenciasUsuario($usuario) {
        $list = $this->bd->listadoIncidenciasUsuario($usuario);

        return $list;
    }

    public function obtener_num_filas($consulta) {
        return mysqli_num_rows($consulta);
    }

    public function mostrarIncidencia($tupla, $fotos) {
        $this->vista->mostrarIncidencia($tupla, $fotos);
    }

    public function comprobar($email, $clave) {
        $tupla = $this->bd->comprobarUsuario($email, $clave);
        if ($tupla != false) {
            session_start();
            $_SESSION["id"] = $tupla["id_usuario"];
            $_SESSION["usuario"] = $tupla["nombre"];
            $_SESSION["apellidos"] = $tupla["apellidos"];
            $_SESSION["clave"] = $tupla["clave"];
            $_SESSION["rol"] = $tupla["rol"];
            $_SESSION["email"] = $tupla["email"];
            $_SESSION["direccion"] = $tupla["direccion"];

            return true;
        }
        else {
            $this->vista->login();
        }
    }

    public function login() {
        $this->vista->login();
    }

    public function logeado() {
        $this->vista->bienvenido($_SESSION["usuario"]);
    }

    public function logout() {
        session_destroy();
        session_unset();

        $this->vista->login();
    }

    public function nuevaIncidencia($datos) {
        $this->bd->nuevaIncidencia($datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[6]);
    }

    public function insertarFoto($id_incidencia, $foto) {
        $this->bd->insertarFoto($id_incidencia, $foto);
    }

    public function comentarIncidencia($comentario, $id_incidencia, $id_autor) {
        $res=$this->bd->aniadirComentario($comentario, $id_incidencia, $id_autor);
        return $res;
    }

    public function formularioIncidencia() {
        $this->vista->formularioIncidencia();
    }

    public function obtenerIdIncidencia($datos) {
        return $this->bd->obtenerIdIncidencia($datos);
    }

    public function edicionIncidencia($datos, $p) {
        $this->vista->edicionIncidencia($datos, $p);
    }

    public function obtenerFotos($id_incidencia) {
        return $this->bd->obtenerFotos($id_incidencia);
    }

    public function obtenerComentarios($id_incidencia) { //Obtengo la consulta
        $consulta = $this->bd->obtenerComentarios($id_incidencia);

        if ($consulta) {
            $num = mysqli_num_rows($consulta);
        }

        return $consulta;
    }

    public function infoComentario($consulta, $i) { //Obtenemos toda la info. de una fila de la tabla Comentario
        return $this->obtenerTuplas($consulta, $i);
    } 

    public function formularioComentar($tupla) {
        $this->vista->comentarioIncidencia($tupla);
    }

    public function mostrarBotones($tupla_inc, $rol) {
        if ($rol != "Administrador")
            $this->vista->mostrarBotonesColaborador($tupla_inc);
        else
            $this->vista->mostrarBotonesAdministrador($tupla_inc);
    }

    public function mostrarComentario($tupla_inc) {
        $this->vista->mostrarComentario($tupla_inc);
    }

    public function formEdicionUsuario() {
        $this->vista->formularioUsuario();
    }

    public function formNoEditableUsuario($datos) {
        $this->vista->formularioNoEditableUsuario($datos);
    }

    public function editarUsuario() {
        $this->bd->editarUsuario();
    }

    public function editarIncidencia($datos) {
        $this->bd->editarIncidencia($datos);
    }

    public function formEditarIncidencia($id_incidencia, $p) {
        $tupla = $this->bd->obtenerIncidencia($id_incidencia);
        $this->vista->edicionIncidencia($tupla, $p);
    }

    public function formBorrarIncidencia($id_incidencia) {
        $this->bd->borrarIncidencia($id_incidencia);
    }

    public function aniadirEvento($evento) {
        echo "Añadiendo evento";
        $hoy = date("Y-m-d H:i:s");
        $this->bd->guardarEvento($hoy, $evento);
    }

    public function mostrarLog($tupla) {
        $this->vista->mostrarLog($tupla);
    }

    public function obtenerLogs() {
        return $this->bd->obtenerLogs();
    }

    public function titulo($p) {
        switch ($p) {
            case 0:
                $this->vista->tituloInicio();
            break;
            case 1:
                $this->vista->tituloNuevaIncidencia();
            break;
            case 2:
                $this->vista->tituloMisIncidencias();
            break;
            case 3:
                $this->vista->tituloGestionUsuarios();
            break;
            case 4:
                $this->vista->tituloLog();
            break;
            case 5:
                $this->vista->tituloGestionBBDD();
            break;
        }
    }
}
?>