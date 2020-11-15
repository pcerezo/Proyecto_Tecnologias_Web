<?php
function HTML_incidencia_form() {
echo <<<FORM
<h2>Describa la incidencia</h2>
<form action="index.php?p=1" method="get">
    <label>Título: <input type="text" name="titulo"></label>
    <label>Descripción: <input type="text" name="descripcion"></label>
    <label>Lugar (opcional):<input type="text" name="lugar"></label>
    <label>Etiquetas (opcional):<input type="text" name="etiquetas"></label>
    <label>Autor: {$_SESSION["email"]}</label>
    <label>Fecha: <input type="date" name="fecha"></label>
    
    <input type="submit" name="boton" value="Crear incidencia">
    <input type="hidden" name="p" value=1>
</form>
FORM;
}

function HTMLeditform($datos) {
    echo <<<FORM
    <h2>Describa la incidencia</h2>
    <form action="index.php?p=1" method="get">
        <label>Título: <input type="text" name="titulo" value="$datos[0]"></label>
        <label>Descripción: <input type="text" name="descripcion" value="$datos[1]"></label>
        <label>Lugar (opcional):<input type="text" name="lugar" value="$datos[2]"></label>
        <label>Etiquetas (opcional):<input type="text" name="etiquetas" value="$datos[3]"></label>
        <label>Autor: $datos[4]</label>
        <label>Fecha: <input type="date" name="fecha" value="$datos[5]"></label>
        <input type="file" name="imagenes[]" multiple>
    
        <input type="submit" name="boton" value="Confirmar">
        <input type="hidden" name="p" value=1>
    </form>
FORM;
}

function HTMLIncidencia($tupla) {
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

?>