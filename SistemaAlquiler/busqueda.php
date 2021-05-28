<?php
session_start();
include('./php/conexion.php');
if (!isset($_GET['texto'])) {
    header("Location: ./index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Tienda</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
        <link rel="stylesheet" href="fonts/icomoon/style.css">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/magnific-popup.css">
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <link rel="stylesheet" href="css/owl.theme.default.min.css">


        <link rel="stylesheet" href="css/aos.css">

        <link rel="stylesheet" href="css/style.css">

    </head>
    <body>

        <div class="site-wrap">
            <?php include("./layouts/header.php"); ?> 

            <div class="site-section">
                <div class="container">

                    <div class="row mb-5">
                        <div class="col-md-9 order-2">
                        <div class="col-9 col-md-6 float-md-right">
                    <form action="./busqueda.php" class="site-block-top-search" method="GET">
                        <span class="icon icon-search2"></span>
                        <input type="text" class="form-control border-0" placeholder="Buscar" name="texto">
                    </form>
                </div>
                            <div class="row">
                                <div class="col-md-12 mb-5">
                                    <div class="float-md-left mb-4"><h2 class="text-black h5">Buscando resultados para <?php echo $_GET['texto']; ?> </h2></div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <?php
                                $resultado = $conexion->query("select productos.*, categorias.nombre as categoria from productos 
                    inner join categorias on productos.id_categoria = categorias.id
                    where 
                    productos.nombre like '%" . $_GET['texto'] . "%' or 
                    productos.descripcion like '%" . $_GET['texto'] . "%' or
                    categorias.nombre like '%" . $_GET['texto'] . "%' or
                    productos.id like '%" . $_GET['texto'] . "%'  
                    
                    
                    order by id DESC limit 100")or die($conexion->error);
                                if (mysqli_num_rows($resultado) > 0) {


                                    while ($fila = mysqli_fetch_array($resultado)) {
                                        ?>
                                        <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                                            <div class="block-4 text-center border">
                                                <figure class="block-4-image">
                                                    <a href="shop-single.php?id=<?php echo $fila['id']; ?>">
                                                        <img src="images/<?php echo $fila['imagen']; ?>" alt="<?php echo $fila['nombre']; ?>" class="img-fluid"></a>
                                                </figure>
                                                <div style="height: 200px" class="block-4-text p-4">
                                                    <h3><a href="shop-single.php?id=<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></a></h3>
                                                    <p class="mb-0"><?php echo $fila['descripcion']; ?></p>
                                                    <p class="text-primary font-weight-bold">S/. <?php echo $fila['precio']; ?></p>
                                                </div>

                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    echo '<h2>Sin resultados</h2>';
                                }
                                ?>
                            </div>
                            <div class="row" data-aos="fade-up">
                                <div class="col-md-12 text-center">
                                    <div class="site-block-27">
                                        <ul>
                                            <li><a href="#">&lt;</a></li>
                                            <li class="active"><span>1</span></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#">5</a></li>
                                            <li><a href="#">&gt;</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 order-1 mb-5 mb-md-0">
                            <div class="border p-4 rounded mb-4">
                                <h3 class="mb-3 h6 text-uppercase text-black d-block">Categorias</h3>
                                <ul class="list-unstyled mb-0">
                                    <?php
                                    $re = $conexion->query("select * from categorias")or die($conexion->error);
                                    while ($f = mysqli_fetch_array($re)) {
                                        ?>
                                        <li class="mb-1">
                                            <a href="./busqueda.php?texto=<?php echo $f['nombre'] ?>" class="d-flex">
                                                <span><?php echo $f['nombre']; ?></span> 
                                                <span class="text-black ml-auto">
                                                    <?php
                                                    $re2 = $conexion->query("select count(*) from productos where id_categoria =" . $f['id'])or die($conexion->error);
                                                    $fila = mysqli_fetch_row($re2);
                                                    echo $fila [0];
                                                    ?>
                                                </span>
                                            </a></li>

                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="border p-4 rounded mb-4">
                                <div class="mb-4">
                                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Productos</h3>
                                    <label for="s_sm" class="d-flex">
                                        <a href="./busqueda.php?texto=leche%sin%lactosa">
                                            <input type="checkbox" id="s_sm" class="mr-2 mt-1"> <span class="text-black">Leche sin Láctosa</span>
                                        </a>
                                    </label>
                                    <label for="s_md" class="d-flex">
                                        <a href="./busqueda.php?texto=yogurt">
                                            <input type="checkbox" id="s_sm" class="mr-2 mt-1"> <span class="text-black">Yogurt</span>
                                        </a>
                                    </label>
                                    <label for="s_lg" class="d-flex">
                                        <a href="./busqueda.php?texto=costeño">
                                            <input type="checkbox" id="s_sm" class="mr-2 mt-1"> <span class="text-black">Costeño</span>
                                        </a>
                                    </label>
                                    <label for="s_lg" class="d-flex">
                                        <a href="./busqueda.php?texto=chocolatada">
                                            <input type="checkbox" id="s_sm" class="mr-2 mt-1"> <span class="text-black">Chocolatada</span>
                                        </a>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="site-section site-blocks-2">
                                <div class="row justify-content-center text-center mb-5">
                                    <div class="col-md-7 site-section-heading pt-4">
                                        <h2>Categorías</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                                        <a class="block-2-item" href="./busqueda.php?texto=lacteos">
                                            <figure class="image">
                                                <img src="./images/categorias/lacteos.jpg" alt="" class="img-fluid">
                                            </figure>
                                            <div class="text">
                                                <span class="text-uppercase">Gloria</span>
                                                <h3>Lácteos</h3>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="100">
                                        <a class="block-2-item" href="./busqueda.php?texto=derivados lacteos">
                                            <figure class="image">
                                                <img src="./images/categorias/derivadoslacteos.jpg" alt="" class="img-fluid">
                                            </figure>
                                            <div class="text">
                                                <span class="text-uppercase">Gloria</span>
                                                <h3>Derivados Lácteos</h3>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
                                        <a class="block-2-item" href="./busqueda.php?texto=bebidas">
                                            <figure class="image">
                                                <img src="./images/categorias/bebidas.jpg" alt="" class="img-fluid">
                                            </figure>
                                            <div class="text">
                                                <span class="text-uppercase">Gloria</span>
                                                <h3>Bebidas</h3>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
                                        <a class="block-2-item" href="./busqueda.php?texto=alimentos">
                                            <figure class="image">
                                                <img src="./images/categorias/alimentos.jpg" alt="" class="img-fluid">
                                            </figure>
                                            <div class="text">
                                                <span class="text-uppercase">Gloria</span>
                                                <h3>Alimientos</h3>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <?php include("./layouts/footer.php"); ?> 


        </div>

        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/aos.js"></script>

        <script src="js/main.js"></script>

    </body>
</html>