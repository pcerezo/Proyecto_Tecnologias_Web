<?php
    require_once "controlador/controlador_usuarios.php";
    require_once "controlador/controlador.php";
    $ctrl = new controlador;
    $ctrlu = new controlador_usuarios;

    $ctrl->titulo(3);

    $ctrlu->opciones();

    if (isset($_GET["datos"])) {
        //Almaceno todos los datos en un array
        $datos[0] = $_GET["nombre"];
        $datos[1] = $_GET["apellidos"];
        $datos[2] = $_GET["email"];
        $datos[3] = $_GET["pass"];
        $datos[4] = $_GET["direccion"];
        $datos[5] = $_GET["telefono"];
        $datos[6] = $_GET["rol"]; 

        $ctrlu->guardarUsuario($datos);

        header("Location: index.php?p=3");
    }
    else if (isset($_GET["boton_usuario"])) {
        //Obtengo todos los datos del usuario
        $datos[0] = $_GET["nombre"];
        $datos[1] = $_GET["apellidos"];
        $datos[2] = $_GET["email"];
        $datos[3] = $_GET["pass"];
        $datos[4] = $_GET["direccion"];
        $datos[5] = $_GET["telefono"];
        $datos[6] = $_GET["rol"];
        $datos[7] = $_GET["id_usuario"];

        if ($_GET["boton_usuario"] == "Modificar") {
            $ctrlu->editarUsuario($datos);
        }
        else { //Borrar
            $ctrlu->borrarUsuario($datos[7]);
        }
    }
    else {
        switch($_GET["opcion"]) {
            case "Listado":
                $consulta = $ctrlu->obtenerUsuarios();
                $n = $ctrl->obtener_num_filas($consulta);
            
                for ($i = 0; $i < $n; $i++) {
                    $tupla = $ctrlu->obtenerDatosUsuario($consulta, $i); // Obtenemos una tupla de la tabla de Usuarios de la BBDD
                    //Mostrar info
                    $ctrlu->mostrarUsuario($tupla);
                    //echo "id={$tupla["id_usuario"]}";
                    //$ctrlu->mostrarBotonesUsuario($tupla["id_usuario"]);
                }
            break;
            case "Nuevo usuario":
                $ctrlu->formularioNuevoUsuario();
            break;
        }
    }

    c_div_HTML();
?>