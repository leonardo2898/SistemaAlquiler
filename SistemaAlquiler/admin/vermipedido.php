<?php
session_start();
include "../php/conexion.php";
if (!isset($_SESSION['datos_login'])) {
    header("Location: ../index.php");
}
$arregloUsuario = $_SESSION['datos_login'];
if ($arregloUsuario['nivel'] != 'cliente') {
    header("Location: ../index.php");
}
$id_usuario = $_SESSION['datos_login'];
$fila = (array_values($id_usuario));

//echo $fila[1];

$datos = $conexion->query("select 
        ventas.*,  
        usuario.nombre,usuario.telefono,usuario.email
        from ventas 
        inner join usuario on ventas.id_usuario = usuario.id
        where usuario.id=" . $fila[1])or die($conexion->error);
$datosUsuario = mysqli_fetch_row($datos);
//var_dump($datosUsuario); die();
$datos2 = $conexion->query("SELECT v.id, v.id_usuario, u.nombre, v.total, v.fecha, v.status, e.id_envio, e.estado, e.company, e.direccion, e.estado, e.cp, e.id_venta
FROM envios as e
INNER JOIN ventas as v
ON v.id=e.id_venta
INNER JOIN usuario as u
ON u.id=v.id_usuario
WHERE v.id_usuario=" . $fila[1])or die($conexion->error);
$datosEnvio = mysqli_fetch_row($datos2);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mi Pedido</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./dashboard/plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="./dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <link rel="stylesheet" href="./dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <link rel="stylesheet" href="./dashboard/plugins/jqvmap/jqvmap.min.css">
        <link rel="stylesheet" href="./dashboard/dist/css/adminlte.min.css">
        <link rel="stylesheet" href="./dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <link rel="stylesheet" href="./dashboard/plugins/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" href="./dashboard/plugins/summernote/summernote-bs4.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <!-- CSS personalizado --> 
        <link rel="stylesheet" href="../main.css">  

        <!--datables CSS básico-->
        <link rel="stylesheet" type="text/css" href="../datatables/datatables.min.css"/>
        <!--datables estilo bootstrap 4 CSS-->  
        <link rel="stylesheet"  type="text/css" href="../datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

        <!--font awesome con CDN-->  
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">  

    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <?php include "./layouts/header.php"; ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Pedidos</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6 text-right">
                                <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                 <i class="fa fa-plus"></i> Insertar Producto
                               </button>-->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">

                        <?php
                        if (isset($_GET['error'])) {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_GET['error']; ?>
                            </div>

                        <?php } ?>
                        <?php
                        if (isset($_GET['success'])) {
                            ?>
                            <div class="alert alert-success" role="alert">
                                Se ha insertado correctamente.
                            </div>

                        <?php } ?>
                        <div class="card-body">
                            <p>Id Usuario #<?php echo $fila[1]; ?> </p>
                            <p>Número de pedido: #<?php echo $datosUsuario[0]; ?> </p>
                            <p>Nombre Cliente: <?php echo $fila[0]; ?> </p>
                            <p>Email Cliente: <?php echo $datosUsuario[9]; ?> </p>
                            <p>Teléfono: <?php echo $datosUsuario[8]; ?> </p>
                            <p>Estado: <b><?php echo $datosUsuario[4]; ?> </b></p>
                            <p class="h6"><b><i>Datos de envío</i></b></p>
                            <p>Empresa: <?php echo $datosEnvio[8]; ?></p>
                            <p>Dirección: <?php echo $datosEnvio[9]; ?></p>
                            <p>Ubicación: <?php echo $datosEnvio[7]; ?></p>
                            <p>Código Postal: <?php echo $datosEnvio[11]; ?></p>

                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="pedidos">
                                                <thead>
                                                    <tr>
                                                        <th >Id</th>
                                                        <th>Nombre</th>
                                                        <th>Precio</th>
                                                        <th>Cantidad</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    $re = $conexion->query("SELECT pv.*, p.nombre
                                                                                            FROM envios as e
                                                                                            INNER JOIN ventas as v ON v.id=e.id_venta
                                                                                            INNER JOIN usuario as u ON u.id=v.id_usuario
                                                                                            INNER JOIN productos_venta as pv ON pv.id_venta=v.id
                                                                                            INNER JOIN productos as p ON pv.id_producto=p.id
                                                                                            WHERE v.id_usuario=" . $fila[1])or die($conexion->error);
                                                    while ($f2 = mysqli_fetch_array($re)) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $f2['id']; ?></td>
                                                            <td><?php echo $f2['nombre'] ?></td>
                                                            <td>S/.<?php echo number_format($f2['precio'], 2, '.', ''); ?></td>
                                                            <td><?php echo $f2['cantidad']; ?></td>
                                                            <td>S/.<?php echo number_format($f2['subtotal'], 2, '.', ''); ?></td>

                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <?php include "./layouts/footer.php"; ?>
        </div>
        <script src="./dashboard/plugins/jquery/jquery.min.js"></script>
        <script src="./dashboard/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <script src="./dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="./dashboard/plugins/chart.js/Chart.min.js"></script>
        <script src="./dashboard/plugins/sparklines/sparkline.js"></script>
        <script src="./dashboard/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="./dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <script src="./dashboard/plugins/jquery-knob/jquery.knob.min.js"></script>
        <script src="./dashboard/plugins/moment/moment.min.js"></script>
        <script src="./dashboard/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="./dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="./dashboard/plugins/summernote/summernote-bs4.min.js"></script>
        <script src="./dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="./dashboard/dist/js/adminlte.js"></script>
        <script src="./dashboard/dist/js/pages/dashboard.js"></script>
        <script src="./dashboard/dist/js/demo.js"></script>

        <!-- jQuery, Popper.js, Bootstrap JS -->
        <!--<script src="../jquery/jquery-3.3.1.min.js"></script>-->
        <script src="../popper/popper.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>

        <!-- datatables JS -->
        <script type="text/javascript" src="../datatables/datatables.min.js"></script>    

        <!-- para usar botones en datatables JS -->  
        <script src="../datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
        <script src="../datatables/JSZip-2.5.0/jszip.min.js"></script>    
        <script src="../datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
        <script src="../datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
        <script src="../datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>

        <!-- código JS propìo-->    
        <script type="text/javascript" src="../main.js"></script>
    </body>
</html>
