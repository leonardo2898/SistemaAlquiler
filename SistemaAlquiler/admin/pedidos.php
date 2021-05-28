<?php
session_start();
include "../php/conexion.php";
if (!isset($_SESSION['datos_login'])) {
    header("Location: ../index.php");
}
$arregloUsuario = $_SESSION['datos_login'];
if ($arregloUsuario['nivel'] != 'admin') {
    header("Location: ../index.php");
}
$resultado = $conexion->query("
select ventas.*, clientes.RazonSocial, clientes.celular, clientes.correo from ventas
inner join clientes on ventas.id_usuario = clientes.id  order by id desc
    ")or die($conexion->error);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Alquileres</title>
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
                                <h1 class="m-0 text-dark">Alquileres</h1>
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
                        <div class="accordion" id="accordionExample">
                            <?php
                            while ($f = mysqli_fetch_array($resultado)) {
                                ?>
                                <div class="card">
                                    <div class="card-header" id="heading<?php echo $f['id']; ?>">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" 
                                                    data-target="#collapse<?php echo $f['id']; ?>" aria-expanded="true" aria-controls="collapseOne">
                                                        <?php echo $f['fecha'] . '-' . $f['RazonSocial']; ?>

                                            </button>
                                            <!--<button class="btn btn-danger btn-small btnEliminar"  
                                                    data-id="<php echo $f['id']; ?>"
                                                    data-toggle="modal" data-target="#modalEliminar">
                                                <i class="fa fa-trash"></i>
                                            </button>-->
                                        </h5>
                                    </div>

                                    <div id="collapse<?php echo $f['id']; ?>" class="collapse" 
                                         aria-labelledby="heading<?php echo $f['id']; ?>" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <!--<p>Número de pedido: #<php echo $f['id']; ?> </p>-->
                                            <p>Nombre Cliente: <?php echo $f['RazonSocial']; ?> </p>
                                            <p>Email Cliente: <?php echo $f['correo']; ?> </p>
                                            <p>Teléfono: <?php echo $f['celular']; ?> </p>
                                            <p>Estado: <b><?php echo $f['status']; ?> </b></p>
                                            <p class="h6"><b><i>Datos de envío</i></b></p>
                                            <?php
                                            $re = $conexion->query("select * from envios where id_venta=" . $f['id'])or die($conexion->error);
                                            $fila = mysqli_fetch_row($re);
                                            ?>
                                            <p>Dirección: <?php echo $fila[3]; ?></p>
                                            <p>Distrito: <?php echo $fila[4]; ?></p>
                                            <p>Código Postal: <?php echo $fila[5]; ?></p>


                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#Ped</th>
                                                                        <th>Nombre</th>
                                                                        <th>Tel</th>
                                                                        <th>Direccion</th>
                                                                        <th>Distrito</th>
                                                                        <th>Id</th>
                                                                        <th>Producto</th>
                                                                        <th>Precio</th>
                                                                        <th>Cant</th>
                                                                        <th>Subtotal</th>
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <?php
                                                                    $re = $conexion->query("select productos_venta.*, productos.nombre
                                      from productos_venta inner join productos on productos_venta.id_producto = productos.id
                                      where id_venta=" . $f['id'])or die($conexion->error);
                                                                    while ($f2 = mysqli_fetch_array($re)) {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $f['id']; ?></td>
                                                                            <td><?php echo $f['RazonSocial']; ?></td>
                                                                            <td><?php echo $f['celular']; ?></td>
                                                                            <td><?php echo $fila[3]; ?></td>
                                                                            <td><?php echo $fila[4]; ?></td>
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
                                    </div>
                                </div>
<?php } ?>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>

            <!-- Modal Eliminar -->
            <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEliminarLabel">Eliminar pedido</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Desea eliminar el pedido?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-danger eliminar" data-dismiss="modal">Eliminar</button>
                        </div>

                    </div>
                </div>
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
        <script>
            $(document).ready(function () {
                var idEliminar = -1;
                var idEditar = -1;
                var fila;
                $(".btnEliminar").click(function () {
                    idEliminar = $(this).data('id');
                    fila = $(this).parent('td').parent('tr');
                });
                $(".eliminar").click(function () {
                    $.ajax({
                        url: '../php/eliminarpedido.php',
                        method: 'POST',
                        data: {
                            id: idEliminar
                        }
                    }).done(function (res) {

                        $(fila).fadeOut(1000);
                    });

                });
            });
        </script>
    </body>
</html>
