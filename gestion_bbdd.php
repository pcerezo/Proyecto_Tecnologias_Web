<?php
require_once "controlador/control_backup_restore.php";
require_once "controlador/controlador.php";

$ctrl =  new controlador;
$ctrlbd = new controlador_bk_rest;

$ctrl->titulo(5);
$ctrlbd->opciones_gestion_bbdd();
if (isset($_GET["opcion"])) {
    if ($_GET["opcion"] == "Copia de seguridad") {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $database = 'Proyecto';
        $user = 'cerezotrabajo71819';
        $pass = 'Data_base1';
        $host = 'localhost';
        $dir = dirname(__FILE__) . '/dump.sql';
        echo "<h3>Backing up database to `<code>{$dir}</code>`</h3>";
        exec("mysqldump --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dir} 2>&1", $output);
        var_dump($output);
    }
    else {
        include 'function.php';
 
        $server = 'localhost';
        $username = 'cerezotrabajo71819';
        $password = 'Data_base1';
        $dbname = 'Proyecto';

        //moving the uploaded sql file
        $filename = $_FILES['sql']['name'];
        move_uploaded_file($_FILES['sql']['tmp_name'],'upload/' . $filename);
        $file_location = 'upload/' . $filename;

        //restore database using our function
        $restore = restore($server, $username, $password, $dbname, $file_location);

        if($restore['error']){
            $_SESSION['error'] = $restore['message'];
        }
        else{
            $_SESSION['success'] = $restore['message'];
        }

        header('location:index.php');
    }
}

c_div_HTML();
?>
