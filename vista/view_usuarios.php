<?php
    class vista_usuarios {
        public function titular() {
            echo "<h2>Gestión de usuarios</h2>";
        }

        public function opciones() {
            echo <<<FORM
            <form action="index.php" method="get">
                <input type="submit" name="opcion" value="Nuevo usuario">
                <input type="submit" name="opcion" value="Listado">
                <input type="hidden" name="p" value="3">
            </form>
FORM;
        }

        public function mostrarUsuario($tupla) {
            echo <<<USER
            <div id="datos">
                <p>Nombre: {$tupla["nombre"]}</p>
                <p>Apellidos: {$tupla["apellidos"]}</p>
                <p>Email:{$tupla["email"]}</p>
                <p>Rol: {$tupla["rol"]}</p>

                <form action="index.php" method="get">
                <input type="submit" name="boton_usuario" value="Modificar">
                <input type="submit" name="boton_usuario" value="Borrar">
                <input type="hidden" name="id_usuario" value="{$tupla["id_usuario"]}">
                <input type="hidden" name="pass" value="{$tupla["clave"]}">
                <input type="hidden" name="direccion" value="{$tupla["direccion"]}">
                <input type="hidden" name="telefono" value="{$tupla["telefono"]}">
                <input type="hidden" name="p" value="3">
            </form>
            </div>
USER;
        }

        public function formularioNuevoUsuario() {
            echo <<<USER
            <form action="index.php" method="get">
                <label>Nombre: <input type="text" name="nombre"></label>
                <label>Apellidos: <input type="text" name="apellidos"></label>
                <label>Email: <input type="text" name="email"></label>
                <label>Contraseña: <input type="password" name="pass"></label>
                <label>Dirección: <input type="text" name="direccion"></label>
                <label>Teléfono: <input type="number" name="telefono"></label>
                <label>Rol: </label>
                <select name="rol">
                    <option selected>Colaborador</option>
                    <option>Administrador</option>
                </select>

                <input type="submit" name="datos" value="Enviar datos">
                <input type="hidden" name="p" value="3">
            </form>
USER;
        }

        public function formularioEditarUsuario($datos) {
            echo <<<FORM
                <div class="datos">
                    <h2>Edición de usuario</h2>
                    <form action="index.php" method="get">
                        <label>Nombre: <input type="text" name="nombre" value="$datos[0]" ></label>
                        <label>Apellidos: <input type="text" name="apellidos" value="$datos[1]" ></label>
                        <label>Email: <input type="text" name="email" value="$datos[2]"></label>
                        <label>Dirección: <input type="text" name="direccion" value="$datos[4]"></label>
                        <label>Teléfono: <input type="number" name="telefono" value="$datos[5]"></label>
                        <label>Rol: </label>
                        <select name="rol">
                            <option selected>Colaborador</option>
                            <option>Administrador</option>
                        </select>
    
                        <input type="submit" name="modificar_usuario" value="Confirmar modificación">
                        <input type="hidden" name="p" value=6>
                        <input type="hidden" name="id_usuario" value=$datos[7]>
                    </form>
                </div>
FORM;
        }

        public function botonesUsuario($id) {
            echo <<<BOT
            <form action="index.php" method="get">
                <input type="submit" name="boton_usuario" value="Modificar">
                <input type="submit" name="boton_usuario" value="Borrar">
                <input type="hidden" name="id_usuario" value="$id">
                <input type="hidden" name="p" value="3">
            </form>
BOT;
        }

        public function borradoExitoso() {
            echo <<<BIEN
            <div class="notificacion">
               <h2>Éxito al borrar</h2>
            </div>
BIEN;
        }

        public function borradoError() {
            echo <<<MAL
            <div class="notificacion">
               <h2>Error al borrar</h2>
            </div>
MAL;
        }
    }
?>
