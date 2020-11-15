<?php
    class bd_usuarios {
        public $db;

        public function __construct() {
            $this->conectar_bd();
        }

        public function conectar_bd() {
            $this->db = mysqli_connect("p:localhost", "cerezotrabajo71819", "Data_base1", "Proyecto");

            if (!$this->db) {
                echo "<p>Error de conexión.</p>";
                die();
            }
            mysqli_set_charset($this->db, "utf8");
        }

        public function obtenerUsuarios() {
            $this->conectar_bd();

            $con = mysqli_query($this->db, "SELECT * FROM Usuario");

            return $con;
        }

        public function guardarUsuario($datos) {
            $this->conectar_bd();

            $con = mysqli_query($this->db, "INSERT INTO Usuario VALUES (NULL, '$datos[2]', '$datos[0]', '$datos[1]', '$datos[3]', '$datos[4]', $datos[5], '$datos[6]')");

            mysqli_close($this->db);
        }

        public function borrarUsuario($id) {
            $this->conectar_bd();

            $con = mysqli_query($this->db, "DELETE FROM Usuario WHERE id_usuario=$id");
            
            return $con;
        }
    }
?>