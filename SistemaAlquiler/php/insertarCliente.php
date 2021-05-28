<?php

include "conexion.php";
if (isset($_POST['RazonSocial']) && isset($_POST['Celular']) && isset($_POST['Correo'])&& isset($_POST['Direccion'])&& isset($_POST['Distrito'])&& isset($_POST['Ciudad'])) {

    $conexion->query("insert into clientes (RazonSocial, Celular, Correo, Direccion, Distrito,Ciudad)
            values(
                '" . $_POST['RazonSocial'] . "',
                '" . $_POST['Celular'] . "',
                '" . $_POST['Correo'] . "',
                '" . $_POST['Direccion'] . "',
                '" . $_POST['Distrito'] . "',
                '" . $_POST['Ciudad'] . "'
             )
            ")or die($conexion->error);
    header("Location: ../admin/Buzon.php?success");
}else{
    header("Location: ../admin/cupones.php?error=Favor de llenar todos los campos");
}
?>
