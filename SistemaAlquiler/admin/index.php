<?php
session_start();
include "../php/conexion.php";

if (!isset($_SESSION['datos_login'])) {
    header("Location: ../index.php");
}
$arregloUsuario = $_SESSION['datos_login'];
if ($arregloUsuario['nivel'] != 'admin' && $arregloUsuario['nivel']!='cliente') {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Inicio</title
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
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <?php include "./layouts/header.php"; ?>
            <div class="content-wrapper">
                <section class="content">
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <div class="site-section border-bottom" data-aos="fade">
                                            <div class="container">
                                                <div class="row mb-5">
                                                    <div class="col-md-6">
                                                        <div class="block-16">
                                                            <figure>
                                                                <img src="../images/gloria.jpg" alt="Image placeholder" class="img-fluid rounded">
                                                                <a href="https://vimeo.com/channels/staffpicks/93951774" class="play-button popup-vimeo"><span class="ion-md-play"></span></a>

                                                            </figure>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-5">


                                                        <div class="site-section-heading pt-3 mb-4">
                                                            <h2 class="text-black">Como empezamos</h2>
                                                        </div>
                                                        <p>Con una politica integrada de calidad, inocuidad, seguridad y salud ocupacional, gestión en control, seguridad y ambiente.</p>
                                                        <p>En Gloria buscamos asegurar la satisfacción plena de las necesidades de nuestros consumidores y clientes. Para lograrlo, les entregamos productos nutritivos elaborados bajo estrictos estándares de calidad e inocuidad.</p>
                                                        <p>Conoce más de nuestra Política Integrada De Calidad, Inocuidad, Seguridad y Salud Ocupacional, Gestión en Control y Seguridad y Ambiente.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="site-section border-bottom" data-aos="fade">
                                            <div class="container">
                                                <div class="row justify-content-center mb-5">
                                                    <div class="col-md-7 site-section-heading text-center pt-4">
                                                        <h2>El equipo</h2>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-lg-3">
                                                        <div class="block-38 text-center">
                                                            <div class="block-38-img">
                                                                <div class="block-38-header">
                                                                    <img src="../images/equipo/ebert.jpg" alt="Image placeholder" height="150" class="mb-4">
                                                                    <h3 class="block-38-heading h4">Ebert Molina</h3>
                                                                    <p class="block-38-subheading">FUNDADOR</p>
                                                                </div>
                                                                <div class="block-38-body">
                                                                    <p>La empresa se fundó gracias a los socios que confiaron en mi visión de empresario, y juntos tenemos una segunda familia</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-3">
                                                        <div class="block-38 text-center">
                                                            <div class="block-38-img">
                                                                <div class="block-38-header">
                                                                    <img src="../images/equipo/david.jpg" alt="Image placeholder" height="150" class="mb-4">
                                                                    <h3 class="block-38-heading h4">David Flores</h3>
                                                                    <p class="block-38-subheading">CO FUNDADOR</p>
                                                                </div>
                                                                <div class="block-38-body">
                                                                    <p>Con el apoyo de mi socio y la buena inversión que le dió al dinero, pudimos formar una empresa, gracias familia.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-3">
                                                        <div class="block-38 text-center">
                                                            <div class="block-38-img">
                                                                <div class="block-38-header">
                                                                    <img src="../images/equipo/anibal.jpg" alt="Image placeholder" height="150" class="mb-4">
                                                                    <h3 class="block-38-heading h4">Anibal Fernandez Ruiz</h3>
                                                                    <p class="block-38-subheading">PROGRAMADOR</p>
                                                                </div>
                                                                <div class="block-38-body">
                                                                    <p>Encargado de desarrollar, maquetar y administradar la tienda online.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-3">
                                                        <div class="block-38 text-center">
                                                            <div class="block-38-img">
                                                                <div class="block-38-header">
                                                                    <img src="../images/equipo/danilo.jpg" alt="Image placeholder" height="150" class="mb-4">
                                                                    <h3 class="block-38-heading h4">Danilo Porras Poma</h3>
                                                                    <p class="block-38-subheading">PROGRAMADOR</p>
                                                                </div>
                                                                <div class="block-38-body">
                                                                    <p>Encargado de desarrollar, maquetar y administradar la tienda online.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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
    </body>
</html>
