
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
            <a target="_blank" class="nav-link"  href="../index.php" role="button"><i class="fas fa-shopping-cart"></i>Página Web RED SAC</a>
        </li>
    </ul>
</nav>

<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="./index.php" class="brand-link">
        <img src="./dashboard/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">RED SAC</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../images/users/<?php echo $arregloUsuario['imagen']; ?>" class="img-circle elevation-2" 
                     alt="<?php echo $arregloUsuario['nombre']; ?>">
            </div>
            <div class="info">
                <a href="./index.php" class="d-block"><?php echo $arregloUsuario['nombre']; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php
                if ($arregloUsuario['nivel'] == 'admin') {
                    ?>
                    <li class="nav-item">
                        <a href="./index.php" class="nav-link">
                            <i class="nav-icon fa fa-home"></i>
                            <p>
                                Inicio
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./pedidos.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Alquileres
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./buzon.php" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Clientes
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./productos.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Productos
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./cupones.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Cupones
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./usuarios.php" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Usuarios
                            </p>
                        </a>
                    </li>
                  
                   



                    <li class="nav-item">
                        <a href="../php/cerrar_sesion.php" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Salir
                            </p>
                        </a>
                    </li>

                    <?php
                } else if ($arregloUsuario['nivel'] == 'cliente') {
                    ?>
                    <li class="nav-item">
                        <a href="./index.php" class="nav-link">
                            <i class="nav-icon fa fa-home"></i>
                            <p>
                                Inicio
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./vermipedido.php" class="nav-link">
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Ver mi pedido
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./c.php" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Mi descuento
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../php/cerrar_sesion.php" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Salir
                            </p>
                        </a>
                    </li>
                <?php } ?>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>