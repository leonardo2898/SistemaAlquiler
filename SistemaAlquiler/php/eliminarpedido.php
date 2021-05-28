<?php

include "./conexion.php";

/*$pedido = $conexion->query("select ventas.*, usuario.nombre, usuario.telefono, usuario.email from ventas
    inner join usuario on ventas.id_usuario = usuario.id WHERE ventas.id=" . $_GET['id'])or die($conexion->error);

while ($ped = mysqli_fetch_array($pedido)) {*/



$conexion->query("delete from cupones where id=".$_POST['id']);
echo 'listo';

?>
    ?>





