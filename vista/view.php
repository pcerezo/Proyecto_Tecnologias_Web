
<?php
//require_once "controlador/controlador.php";

class vista {
    private $rol;

    public function nav() {
        if (!isset($_SESSION["usuario"]))
            $this->rol = "visitante";
        else {
            $this->rol = $_SESSION["rol"];
        }

        echo "<ul>";
        if ($this->rol == "visitante") {
            echo "<li><a href='index.php?p=0'>Incidencias</a></li>";
        }
        else if ($this->rol == "colaborador") {
            echo "<li><a href='index.php?p=0'>Incidencias</a></li>";
            echo "<li><a href='index.php?p=1'>Nueva Incidencia</a></li>";
            echo "<li><a href='index.php?p=2'>Mis incidencias</a></li>";

        }
        else { //Es admin
            echo "<li><a href='index.php?p=0'>Incidencias</a></li>";
            echo "<li><a href='index.php?p=1'>Nueva Incidencia</a></li>";
            echo "<li><a href='index.php?p=2'>Mis incidencias</a></li>";
            echo "<li><a href='index.php?p=3'>Gestión de usuarios</a></li>";
            echo "<li><a href='index.php?p=4'>Ver log</a></li>";
            echo "<li><a href='index.php?p=5'>Gestión de BBDD</a></li>";
        }

        echo "</ul>";
    }

    public function mostrarIncidencia($tupla, $fotos) {
        echo <<<INC
                <div id="datos">
                    <h3>{$tupla["titulo"]}</h3>
                    <p>Lugar: {$tupla["lugar"]}  Estado: {$tupla["estado"]}</p>
                    <p>Autor:{$tupla["autor"]}</p>
                    <p>Descripción: {$tupla["descripcion"]}</p>
INC;
                    for ($i = 0; $i < count($fotos); $i++) {
                        echo "<img src='img/$fotos[$i]' width='200' height='100' alt='(Logo librería)'>";
                    }
        echo <<<INC
                </div>
INC;
    }

    public function mostrarBotonesColaborador($tupla) {
        echo <<<BOT
            <div class="botones">
                <form action="index.php" method="get">
                    <input type="submit" name="apoyo" value="Me gusta">
                    <input type="submit" name="apoyo" value="No me gusta">
                    <input type="submit" name="comentar" value="Hacer un comentario">
                    <input type="hidden" name="id_inc" value="{$tupla["id_inc"]}">
                    <input type="hidden" name="p" value="0">
                </form>
            </div>
BOT;
    }

    public function mostrarBotonesAdministrador($tupla) {
        echo <<<BOT
        <div class="botones">
            <form action="index.php" method="get">
                <input type="submit" name="apoyo" value="Me gusta">
                <input type="submit" name="apoyo" value="No me gusta">
                <input type="submit" name="comentar" value="Hacer un comentario">
                <input type="submit" name="tratar_inc" value="Editar Incidencia">
                <input type="submit" name="tratar_inc" value="Borrar Incidencia">
                <input type="hidden" name="id_inc" value="{$tupla["id_inc"]}">
                <input type="hidden" name="p" value="0">
            </form>
        </div>
BOT;
    }

    public function mostrarComentario($tupla) {
        echo "<li>{$tupla["contenido"]} (De {$tupla["id_autor"]})</li>";
    }

    public function edicionIncidencia($tupla, $p) { //$p indica desde qué página llama
        echo <<<INC
        <div class="edicion_incidencia">
            <form action="index.php?p=1" method="get">
                <div id="estado_incidencia">
                    <h2>Estado de la incidencia</h2>
                    <ul>
                        <label>Pendiente<input type="radio" name="estado" value="Pendiente"></label>
                        <label>Comprobada<input type="radio" name="estado" value="Comprobada"></label>
                        <label>Tramitada<input type="radio" name="estado" value="Tramitada"></label>
                        <label>Irresoluble<input type="radio" name="estado" value="Irresoluble"></label>
                        <label>Resuelta<input type="radio" name="estado" value="Resuelta"></label>
                    </ul>
                </div>

                <div id="datos_incidencia">
                    <h2>Datos de la incidencia</h2>
                    
                    <label>Título: <input type="text" name="titulo" value="{$tupla["titulo"]}"></label>
                    <label>Descripción: <input type="text" name="descripcion" value="{$tupla["descripcion"]}"></label>
                    <label>Lugar (opcional):<input type="text" name="lugar" value="{$tupla["lugar"]}"></label>
                    <label>Etiquetas (opcional):<input type="text" name="etiqueta" value="{$tupla["etiqueta"]}"></label>
                    <label>Autor:"{$tupla["autor"]}" <input type="hidden" name="autor" value="{$tupla["autor"]}"></label>
                    <label>Fecha: <input type="date" name="fecha" value="{$tupla["fecha"]}"></label>
                    <input type="hidden" name="id_inc" value="{$tupla["id_inc"]}">
                    <input type="submit" name="conf_edit_inc" value="Confirmar">
                    <input type="hidden" name="p" value=$p>
                </div>

                <div id="fotos_incidencia">
                <h2>Fotografías adjuntas</h2>
                    <input type="file" name="imagenes[]" multiple>
                    <input type="submit" name="conf_edit_inc" value="Confirmar">
                    <input type="hidden" name="p" value=$p>
                </div>
            </form>
        </div>
INC;
    }

    public function formularioIncidencia() {
        echo <<<FORM
        <div class="incidencia">
            <form action="index.php?p=1" method="get">
                <label>Estado: Pendiente<input type="hidden" name="estado" value="Pendiente"></label>
                <label>Título: <input type="text" name="titulo"></label>
                <label>Descripción: <input type="text" name="descripcion"></label>
                <label>Lugar (opcional):<input type="text" name="lugar"></label>
                <label>Etiquetas (opcional):<input type="text" name="etiquetas"></label>
                <label>Autor: {$_SESSION["email"]}</label>
                <label>Fecha: <input type="date" name="fecha"></label>
                
                <input type="submit" name="conf_edit_inc" value="Crear incidencia">
                <input type="hidden" name="p" value=1>
            </form>
        </div>
FORM;
    }

    public function formularioUsuario() {
        echo <<<FORM
            <div class="">
                <h2>Edición de usuario</h2>
                <form action="index.php?p=6" method="get">
                    <label>Nombre: <input type="text" name="nombre" value="{$_SESSION["usuario"]}"></label>
                    <label>Apellidos: <input type="text" name="apellidos" value="{$_SESSION["apellidos"]}"></label>
                    <label>Email: <input type="text" name="email" value="{$_SESSION["email"]}"></label>
                    <label>Cambiar clave: <input type="text" name="clave"></label>
                    <label>Dirección: <input type="text" name="direccion" value="{$_SESSION["direccion"]}"></label>
                    <label>Teléfono: <input type="number" name="telefono" value={$_SESSION["telefono"]}></label>
                    <label>Rol: <input type="text" name="rol" value="{$_SESSION["rol"]}" readonly></label>

                    <input type="submit" name="modificar_usuario" value="Modificar usuario">
                    
                </form>
            </div>
FORM;
    }

    public function formularioNoEditableUsuario($datos) {
        echo <<<FORM
            <div class="">
                <h2>Edición de usuario</h2>
                <form action="index.php?p=6" method="get">
                    <label>Nombre: <input type="text" name="nombre" value="{$datos[0]}" readonly></label>
                    <label>Apellidos: <input type="text" name="apellidos" value="{$datos[1]}" readonly></label>
                    <label>Email: <input type="text" name="email" value="{$datos[2]}" readonly></label>
                    <label>Dirección: <input type="text" name="direccion" value="{$datos[4]}" readonly></label>
                    <label>Teléfono: <input type="number" name="telefono" value={$datos[5]} readonly></label>
                    <label>Rol: <input type="text" name="rol" value="{$_SESSION["rol"]}" readonly></label>

                    <input type="submit" name="modificar_usuario" value="Confirmar modificación">
                    <input type="hidden" name="p" value=6>
                </form>
            </div>
FORM;
    }

    public function bienvenido($nombre) {
        echo <<<LOG
        <div class="log">
            <h5>Bienvenido, $nombre ({$_SESSION["rol"]})</h5>
            <form action="index.php" method="get">
                <input type="submit" name="editar" value="Editar">
                <input type="submit" name="logout" value="Logout">
                <input type="hidden" name="email" value="{$_SESSION["email"]}">
            </form>
        </div>
LOG;
    }

    public function login() {
        echo <<<LOG
        <div class="log">
            <h5>Introduzca sus datos de usuario</h5>
            <form action="index.php" method="get">
                <label>Email:<input type="text" name="email"></label>
                <label>Contraseña:<input type="password" name="clave"></label>
                <input type="submit" name="login" value="Login">
            </form>
        </div>
LOG;
    }

    public function comentarioIncidencia($tupla) {
        echo <<<INC
        <h3>{$tupla["titulo"]}</h3>
        <p>Lugar: {$tupla["lugar"]}  Estado: {$tupla["estado"]}</p>
        <p>Autor:{$tupla["autor"]}</p>
        <p>{$tupla["descripcion"]}</p>
        
        <form action="index.php" method="get">
            <input type="text" name="comentario">
            <input type="submit" name="conf_comentario" value="Enviar Comentario">
        </form>
INC;
    }

    public function mostrarLog($tupla) {
        echo <<<LOG
        <p>{$tupla["fecha"]}: {$tupla["evento"]}</p>
LOG;
    }

    public function tituloLog() {
        echo <<<T
        <div id="logs">
            <h2>Eventos del sistema</h2>
T;
    }

    public function tituloInicio() {
        echo <<<T
        <div id='incidencias'>
            <h2>Incidencias de la comunidad</h2>
T;
    }

    public function tituloNuevaIncidencia() {
        echo <<<T
        <div id="nuevaIncidencia">
            <h2>Describa la nueva incidencia</h2>
T;
    }

    public function tituloMisIncidencias() {
        echo <<<T
        <div id="misIncidencias">
            <h2>Incidencias escritas por ti</h2>
T;
    }

    public function tituloGestionUsuarios() {
        echo <<<T
        <div id="gestionUsuarios">
            <h2>Gestione los usuarios del sistema</h2>
T;
    }

    public function tituloGestionBBDD() {
        echo <<<T
        <div id="gestionBBDD">
            <h2>Haga copias de seguridad o restaure los datos del sistema</h2>
T;
    }

    public function opcionesBBDD() {
        echo <<<BD
        <form action="index.php" method="get">
            <input type="submit" name="opcion" value="Copia de seguridad">
            <input type="submit" name="opcion" value="Restaurar">
            <input type="hidden" name="p" value=5> 
        </form>
BD;
    }
}
?>