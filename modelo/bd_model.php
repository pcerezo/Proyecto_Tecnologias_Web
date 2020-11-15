<?php

class bd_model {

    public $db;

    public function __construct() {
        $this->conectar_bd;
    }

    public function conectar_bd() {
        $this->db = mysqli_connect("p:localhost", "cerezotrabajo71819", "Data_base1", "Proyecto");

        if (!$this->db) {
            echo "<p>Error de conexión.</p>";
            die();
        }
        mysqli_set_charset($this->db, "utf8");

        return $this->db;
    }

    public function obtenerTuplas($con, $i) {
        mysqli_data_seek($con, $i);
        $tupla = mysqli_fetch_array($con);

        return $tupla;
    }

    public function nuevoUsuario($nombre, $apellidos, $email, $clave, $direccion, $telefono, $rol){
        $this->conectar_bd();

        $con = mysqli_query(!$this->db, "INSERT INTO Usuario VALUES ('$nombre', '$apellidos', '$email', '$clave', '$direccion', $telefono, '$rol')");

        if ($con) {
            echo "<p>Éxito en la inserción.</p>";
        }
        else {
            echo "<p>Error de inserción.</p>";
        }

        mysqli_close($this->db);
    }

    public function nuevaIncidencia($titulo, $descripcion, $lugar, $etiquetas, $creador, $fecha, $estado){
        $this->conectar_bd();

        $con = mysqli_query($this->db, "INSERT INTO Incidencia VALUES (NULL, '$titulo', '$descripcion', '$lugar', '$etiquetas', '$estado', '$creador', '$fecha')");
        
        if ($con) {
            echo "<p>Éxito en la inserción.</p>";
        }
        else {
            echo "<p>Error de inserción.</p>";
        }
    }

    public function insertarFoto($id_incidencia, $foto) {
        $this->conectar_bd();

        $con = mysqli_query($this->db, "INSERT INTO Imagen VALUES(NULL, $id_incidencia, '$foto')");

        if ($con) {
            echo "<p>Éxito en la inserción.</p>";
        }
        else {
            echo "<p>Error de inserción.</p>";
        }
    }

    public function listadoIncidencias() {
        $this->conectar_bd();
        
        $con = mysqli_query($this->db, "SELECT * FROM Incidencia");
        
        if ($con) {
            if (mysqli_num_rows($con) > 0) {
                return $con;
            }
        }
        else {
            echo "<h3>Error en la consulta.</h3>";
        }
    }

    public function listadoIncidenciasUsuario($usuario){
        $this->conectar_bd();
        
        $con = mysqli_query($this->db, "SELECT * FROM Incidencia WHERE autor='$usuario'");
        
        if ($con) {
            if (mysqli_num_rows($con) > 0) {
                return $con;
            }
        }
        else {
            echo "<h3>Error en la consulta.</h3>";
        }
    }

    public function obtenerIncidencia($id_incidencia) {
        $this->conectar_bd();

        $con = mysqli_query($this->db, "SELECT * FROM Incidencia WHERE id_inc=$id_incidencia");

        if ($con && mysqli_num_rows($con)==1) {
            $tupla = mysqli_fetch_array($con);
        }
        else {
            $tupla = "Error";
        }

        return $tupla;
    }

    public function comprobarUsuario($email, $pass) {
        $this->conectar_bd();

        $con = mysqli_query($this->db, "SELECT * FROM Usuario WHERE email='$email'");

        if ($con) {
            $info = mysqli_fetch_array($con);
            //if (password_verify($pass, "{$info["clave"]}")) {
                //$info = mysqli_fetch_array($con);
                echo "<p>Usuario Correcto</p>";
                return $info;
            //}
        }
        else {
            echo "<p>Error, usuario y/o contraseña no válidos</p>";
            return false;
        }
    }

    public function aniadirComentario($comentario, $id_incidencia, $id_autor){
        $this->conectar_bd();
        $hoy = date("Y-m-d");

        if (!isset($_SESSION["email"]))
            $id_autor = "Anónimo";

        $con = mysqli_query($this->db, "INSERT INTO Comentario VALUES(NULL, '$comentario', $id_incidencia, '$id_autor', '$hoy')");

        if ($con) {
            $res = "Inserción correcta";
        }
        else {
            $res = "Error";
        }

        return $res;
    }

    public function obtenerIdIncidencia($autor) {
        $this->conectar_bd();
        
        $con = mysqli_query($this->db, "SELECT * FROM Incidencia WHERE autor='$autor' ORDER BY id_inc desc");
    
        if ($con) {
            if (mysqli_num_rows($con) >= 1){
                $tupla = mysqli_fetch_array($con);
            }
        }

        return $tupla["id_inc"];
    }

    public function obtenerFotos($id_incidencia) {
        $this->conectar_bd();

        $con = mysqli_query($this->db, "SELECT * FROM Imagen WHERE id_inc=$id_incidencia");

        if ($con) {
            if (mysqli_num_rows($con) >= 1) {
                for ($i = 0; $i < mysqli_num_rows($con); $i++) {
                    mysqli_data_seek($con, $i);
                    $tupla = mysqli_fetch_array($con);

                    $fotos[] = $tupla["imagen"];
                }
            }
        }
        
        return $fotos;
    }

    public function obtenerComentarios($id_incidencia) {
        $this->conectar_bd();

        $con = mysqli_query($this->db, "SELECT * FROM Comentario WHERE id_inc=$id_incidencia");

        if ($con) {
            return $con; //Devuelvo la consulta para poder mostrar todos los datos que ésta contiene
        }
        else {
            return "Error";
        }
    }

    public function editarUsuario() {
        $this->conectar_bd();

        $con = mysqli_query($this->db, "UPDATE Usuario SET email='{$_SESSION["email"]}', nombre='{$_SESSION["usuario"]}', apellidos='{$_SESSION["apellidos"]}', clave='{$_SESSION["clave"]}', direccion='{$_SESSION["direccion"]}', telefono={$_SESSION["telefono"]} WHERE id_usuario={$_SESSION["id"]}");
    
    }

    public function editarIncidencia($datos) {
        $this->conectar_bd();

        $con = mysqli_query($this->db, "UPDATE Incidencia SET titulo='$datos[0]', descripcion='$datos[1]', lugar='$datos[2]', etiqueta='$datos[3]', estado='$datos[4]', autor='$datos[5]', fecha='$datos[6]' WHERE id_inc=$datos[7]");
    
        if ($con) echo "Exito";
        else echo "Algo falla";
    }

    public function borrarIncidencia($id_incidencia) {
        $this->conectar_bd();

        $con = mysqli_query($this->db, "DELETE FROM Incidencia WHERE id_inc=$id_incidencia");
    
        if ($con) echo "Exito";
        else echo "Algo falla";
    }

    public function guardarEvento($fecha, $evento) {
        $this->conectar_bd();
        
        $con = mysqli_query($this->db, "INSERT INTO Log VALUES (NULL, '$fecha', '$evento')");
    
        if ($con) echo "evento guardado";
        else echo "no guardado";
    }

    public function obtenerLogs() {
        $this->conectar_bd();

        $con = mysqli_query($this->db, "SELECT * FROM Log");
        
        return $con;
    }

    public function query($orden) {
        $this->conectar_bd();

        $con = mysqli_query($this->db, "$orden");

        return $con;
    }
}

?>
