<header class="site-navbar" role="banner">
    <div class="site-navbar-top">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-6 col-md-2 ">
                    
                         <img  src="images/gloria.jpg" alt="" class="img-fluid rounded mb-4">
                
                </div>

                <div class="col-6 col-md-6 order-3 order-md-3 text-right">
                    <div class="site-logo" style="position:relative; margin: 10px;">
                        <a href="index.php" class="js-logo-clone">SISTEMA DE ALQUILER</a>
                    </div>
                </div>

                <div class="col-2 col-md-4  order-3 order-md-3 text-right">
                    <div class="site-top-icons">
                        <?php
                        if (isset($_SESSION['datos_login'])) {
                            ?>
                            <ul>
                                <li><a target="_blank" href="http://localhost/CarritoDeComprasML/admin"><span class="icon icon-person"></span>
                                           <?php
                                           $nombre = $_SESSION['datos_login'];
                                           $nombre2 = (array_values($nombre));
                                           echo $nombre2[0];
                                           ?></a></li>
                                    <li><a href="#"><span class="icon icon-heart-o"></span></a></li>
                                    <li>
                                        <a href="cart.php" class="site-cart">
                                            <span class="icon icon-shopping_cart"></span>
                                            <span class="count">
                                                <?php
                                                if (isset($_SESSION['carrito'])) {
                                                    echo count($_SESSION['carrito']);
                                                } else {
                                                    echo 0;
                                                }
                                                ?>
                                            </span>
                                        </a>
                                    </li> 
                                    <!--<?php var_dump($_SESSION['datos_login']); ?>-->
                                    <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle">
                                            <span class="icon-menu"></span></a></li>
                                </ul>

                                <?php
                            } else {
                                ?> 
                                <ul>
                                    <li><a href="./login.php"><span class="icon icon-person"></span>Inicia Sesión</a></li>
                                    <li><a href="#"><span class="icon icon-heart-o"></span></a></li>
                                    <li>
                                        <a href="cart.php" class="site-cart">
                                            <span class="icon icon-shopping_cart"></span>
                                            <span class="count">
                                                <?php
                                                if (isset($_SESSION['carrito'])) {
                                                    echo count($_SESSION['carrito']);
                                                } else {
                                                    echo 0;
                                                }
                                                ?>
                                            </span>
                                        </a>
                                    </li> 
                                    <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle">
                                            <span class="icon-menu"></span></a></li>
                                </ul>
                            <?php } ?>
                    </div> 
                </div>

            </div>
        </div>
    </div> 
    <nav class="site-navigation text-right text-md-center" role="navigation">
        <div class="container">
            <ul class="site-menu js-clone-nav d-none d-md-block">
                <li>
                    <a href="index.php">Inicio</a>

                </li>
                <li>
                    <a href="about.php">obras</a>

                </li>

                <li><a href="clientes.php">Alquileres</a></li>
                <li><a href="#">stock</a></li>
                <li><a href="contact.php">Clientes</a></li>
            </ul>
        </div>
    </nav>
</header>

<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="index.php">Inicio</a> <span class="mx-2 mb-0">/</span>
                <strong class="text-black">SISTEMA DE ALQUILER CMR</strong></div>
        </div>
    </div>
</div>