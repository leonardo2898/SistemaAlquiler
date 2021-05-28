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
    select productos.*, categorias.nombre as catego  from 
    productos 
    inner join categorias on productos.id_categoria = categorias.id
    order by id ASC")or die($conexion->error);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Productos</title
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
        <!--<header>
            <h1 class="text-center text-light">DATATABLES</h1>
            <h2 class="text-center text-light">Cómo <span class="badge badge-warning">Personalizar</span></h2> 
        </header>   --
        <div style="height:50px"></div>-->
        <div class="wrapper">

                <?php include "./layouts/header.php"; ?>
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0 text-dark">Productos</h1>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fa fa-plus"></i> Insertar Producto
                                    </button>
                                </div>
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
                                                    <th>Id</th>
                                                    <th>Nombre</th>
                                                    <th>Descripción</th>
                                                    <th>Precio</th>
                                                    <th>Inventario</th>
                                                    <th>Categoría</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($f = mysqli_fetch_array($resultado)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $f['id']; ?></td>
                                                        <td>
                                                            <img src="../images/<?php echo $f['imagen']; ?>" width="20px" height="20px" alt="">  
                                                            <?php echo $f['nombre']; ?>
                                                        </td>
                                                        <td><?php echo $f['descripcion']; ?></td>
                                                        <td>S/. <?php echo number_format($f['precio'], 2, '.', ''); ?></td>
                                                        <td><?php echo $f['inventario']; ?></td>
                                                        <td><?php echo $f['catego']; ?></td>
                                                        <td>
                                                            <button class="btn btn-primary btn-small btnEditar"  
                                                                    data-id="<?php echo $f['id']; ?>"
                                                                    data-nombre="<?php echo $f['nombre']; ?>"
                                                                    data-descripcion="<?php echo $f['descripcion']; ?>"
                                                                    data-inventario="<?php echo $f['inventario']; ?>"
                                                                    data-categoria="<?php echo $f['id_categoria']; ?>"
                                                                    data-precio="<?php echo $f['precio']; ?>"
                                                                    data-toggle="modal" data-target="#modalEditar">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
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
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="../php/insertarproducto.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" style="text-align: center">Insertar Producto</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" name="nombre" placeholder="nombre" id="nombre" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripcion</label>
                                    <input type="text" name="descripcion" placeholder="descripcion" id="descripcion" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="imagen">Imagen</label>
                                    <input type="file" name="imagen"  id="imagen" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="precio">Precio</label>
                                    <input type="number" step="any" min="0" name="precio" placeholder="precio" id="precio" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="precio">Inventario</label>
                                    <input type="number" min="0" name="inventario" placeholder="inventario" id="inventario" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="categoria">Caetegoria</label>
                                    <select name="categoria" id="categoria" class="form-control" required>
                                        <?php
                                        $res = $conexion->query("select * from categorias");
                                        while ($f = mysqli_fetch_array($res)) {
                                            echo '<option value="' . $f['id'] . '" >' . $f['nombre'] . '</option>';
                                        }
                                        ?>
                                    </select> 
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
            <!-- Modal Eliminar -->
            <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEliminarLabel">Eliminar Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Desea eliminar el producto?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-danger eliminar" data-dismiss="modal">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>   
            <!-- Modal Editar -->
            <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="../php/editarproducto.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditar">Editar Producto</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <input type="hidden" id="idEdit" name="id">
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="nombreEdit" name="nombre" placeholder="nombre" id="nombreEdit" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="descripcionEdit">Descripcion</label>
                                    <input type="text" name="descripcion" placeholder="descripcion" id="descripcionEdit" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="imagen">Imagen</label>
                                    <input type="file" name="imagen"  id="imagen" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="precioEdit">Precio</label>
                                    <input type="number" step="any" min="0" name="precio" placeholder="precio" id="precioEdit" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="inventarioEdit">Inventario</label>
                                    <input type="number" min="0" name="inventario" placeholder="inventarioEdit" id="inventarioEdit" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="categoriaEdit">Caetegoria</label>
                                    <select name="categoria" id="categoriaEdit" class="form-control" required>
                                        <?php
                                        $res = $conexion->query("select * from categorias");
                                        while ($f = mysqli_fetch_array($res)) {
                                            echo '<option value="' . $f['id'] . '" >' . $f['nombre'] . '</option>';
                                        }
                                        ?>
                                    </select> 
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary editar">Guardar</button>
                            </div>
                        </form>
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
        <script src="../jquery/jquery-3.3.1.min.js"></script>
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
                                            url: '../php/eliminarproducto.php',
                                            method: 'POST',
                                            data: {
                                                id: idEliminar
                                            }
                                        }).done(function (res) {

                                            $(fila).fadeOut(1000);
                                        });
                                    });
                                    $(".btnEditar").click(function () {
                                        idEditar = $(this).data('id');
                                        var nombre = $(this).data('nombre');
                                        var descripcion = $(this).data('descripcion');
                                        var inventario = $(this).data('inventario');
                                        var categoria = $(this).data('categoria');
                                        var precio = $(this).data('precio');
                                        $("#nombreEdit").val(nombre);
                                        $("#descripcionEdit").val(descripcion);
                                        $("#inventarioEdit").val(inventario);
                                        $("#categoriaEdit").val(categoria);
                                        $("#precioEdit").val(precio);
                                        $("#idEdit").val(idEditar);
                                    });
                                });
        </script>
    </body>
</html>
