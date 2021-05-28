<?php
include "./conexion.php";


$conexion->query("delete from contacto where id=".$_POST['id']);
echo 'listo';

?>

