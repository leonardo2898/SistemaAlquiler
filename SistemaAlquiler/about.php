<?php
 include("./php/conexion.php");
$resultado = $conexion->query("
select * from obras
order by id DESC")or die($conexion->error);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Usuarios</title
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="#" />
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
        
        <link rel="stylesheet" href="fonts/icomoon/style.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/magnific-popup.css">
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <link rel="stylesheet" href="css/owl.theme.default.min.css">
        <link rel="stylesheet" href="css/aos.css">
        <link rel="stylesheet" href="css/style.css">
    <?php include("./layouts/header.php"); ?> 
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
        <!-- CSS personalizado --> 
        <link rel="stylesheet" href="./main.css">  

        <!--datables CSS básico-->
        <link rel="stylesheet" type="text/css" href="./datatables/datatables.min.css"/>
        <!--datables estilo bootstrap 4 CSS-->  
        <link rel="stylesheet"  type="text/css" href="./datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

        <!--font awesome con CDN-->  
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">  

    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
 
        <!--<header>
            <h1 class="text-center text-light">DATATABLES</h1>
            <h2 class="text-center text-light">Cómo <span class="badge badge-warning">Personalizar</span></h2> 
        </header>   --
        <div style="height:50px"></div>-->
        <div class="wrapper">

           
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">OBRAS</h1>
                            </div>
                            <!---<div class="col-sm-6 text-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-plus"></i> Insertar Producto
                                </button>
                            </div>-->
                        </div>
                    </div>
                </div>
                <!-- /.contentenido -header -->
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
                            <!--<div class="alert alert-success" role="alert">
                                Se ha insertado correctamente.
                            </div>-->
                            <script>
                                $('success').alert('close');
                            </script>
                        <?php } ?>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Codigo</th>
                                                    <th>Nombre de obra</th>
                                                    <th>Distrito</th>
                                                    <th>Direccion DE la obra</th>
                                                    <th>ciudad de la obra</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($f = mysqli_fetch_array($resultado)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $f['id']; ?></td>
                                                        <td><?php echo $f['NombreObra']; ?></td>
                                                        <td><?php echo $f['Distrito']; ?></td>                                                        
                                                        <td><?php echo $f['DireccionObra']; ?></td>
                                                        <td><?php echo $f['CiudadObra']; ?></td>
                                                        <td>
                                                            
                                                            <button class="btn btn-danger btn-small btnEliminar"  
                                                                    data-id="<?php echo $f['id']; ?>"
                                                                    data-toggle="modal" data-target="#modalEliminar">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
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
                </section>
                <!-- /.content -->
            </div>
            <!-- Modal -->
            <!-- Modal Eliminar -->
            <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEliminarLabel">Eliminar Usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Desea eliminar el usuario?
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
        <script src="./jquery/jquery-3.3.1.min.js"></script>
        <script src="./popper/popper.min.js"></script>
        <script src="./bootstrap/js/bootstrap.min.js"></script>

        <!-- datatables JS -->
        <script type="text/javascript" src="./datatables/datatables.min.js"></script>    

        <!-- para usar botones en datatables JS -->  
        <script src="./datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
        <script src="./datatables/JSZip-2.5.0/jszip.min.js"></script>    
        <script src="./datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
        <script src="./datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
        <script src="./datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>

        <!-- código JS propìo-->    
        <script type="text/javascript" src="./main.js"></script>

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
                                            url: './php/eliminarusuario.php',
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
