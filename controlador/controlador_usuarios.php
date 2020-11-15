<?php
    require_once "vista/view_usuarios.php";
    require_once "controlador/controlador.php";
    require_once "modelo/bd_usuarios.php";

    class controlador_usuarios {
        private $bdu;
        private $vistau;
        private $ctrl;

        public function __construct() {
            $this->bdu = new bd_usuarios;
            $this->vistau = new vista_usuarios;
            $this->ctrl = new controlador;
        }

        public function titular() {
            $this->vistau->titular();
        }

        public function opciones() {
            $this->vistau->opciones();
        }

        public function mostrarUsuario($tupla) {
            $this->vistau->mostrarUsuario($tupla);
        }

        public function obtenerUsuarios() {
            return $this->bdu->obtenerUsuarios();
        }

        public function obtenerDatosUsuario($consulta, $i) {
            return $this->ctrl->obtenerTuplas($consulta, $i);
        }

        public function formularioNuevoUsuario() {
            $this->vistau->formularioNuevoUsuario();
        }

        public function guardarUsuario($datos) {
            $this->bdu->guardarUsuario($datos);
        }

        public function mostrarBotonesUsuario($id) {
            $this->vistau->botonesUsuario($id);
        }

        public function editarUsuario($datos) {
            $this->vistau->formularioEditarUsuario($datos);
        }

        public function borrarUsuario($id) {
            $con = $this->bdu->borrarUsuario($id);

            if ($con) {
                $this->vistau->borradoExitoso();
            }
            else {
                $this->vistau->borradoError();
            }
        }
    }
?>