<?php
session_start();
include "./conexion.php";
$fila=$_SESSION['id'];
$_SESSION['idcliente']=$_POST['c_email'];



$datos2 = $conexion->query("select id from clientes where RazonSocial ='" . $_POST['c_email']."'")or die($conexion->error);
$datosEnvio= mysqli_fetch_array($datos2);
$_SESSION['idcli']=$datosEnvio['id'];



$datos3 = $conexion->query("select id from obras where NombreObra ='" . $_POST['c_subject']."'")or die($conexion->error);
$datosEnvio1= mysqli_fetch_array($datos3);
$idobra= $datosEnvio1['id'];


if (isset($_POST['F_Inicio']) && isset($_POST['F_Final']) && isset($_POST['c_email']) 
        && isset($_POST['c_subject']) && isset($_POST['c_message'])) {
    $conexion->query("INSERT INTO contacto (nombre, apellido, email, id_obras, mensaje,estado) 
                values
                (
                    '" . $_POST['F_Inicio'] . "',
                    '" . $_POST['F_Final'] . "',
                    '" . $_SESSION['idcli'] . "',
                     $idobra,
                    '" . $_POST['c_message'] . "',
                    '1'
                )   ")or die($conexion->error);
              
              
   header("Location: ../cart.php?id=$fila");

} else {
    echo 'no se insertó';
    //header("Location: ../contact.php?error=Favor de llenar todos los campos");
}
?>


