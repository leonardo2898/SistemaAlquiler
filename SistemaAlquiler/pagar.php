<?php
include "./php/conexion.php";
if (!isset($_GET['id_venta'])) {
    header("Location: ./");
}
$datos = $conexion->query("select 
        ventas.*,  
        clientes.RazonSocial,clientes.Celular,clientes.Correo
        from ventas 
        inner join clientes on ventas.id_usuario = clientes.id
        where ventas.id=" . $_GET['id_venta'])or die($conexion->error);
$datos1 = $conexion->query("select 
        ventas.*,  
        clientes.RazonSocial,clientes.Celular,clientes.Correo
        from ventas 
        inner join clientes on ventas.id_usuario = clientes.id
        where ventas.id=" . $_GET['id_venta'])or die($conexion->error);
$datosUsuario1 = mysqli_fetch_array($datos1);
$datosUsuario = mysqli_fetch_row($datos);
$datos2 = $conexion->query("select * from envios where id_venta=" . $_GET['id_venta'])or die($conexion->error);
$datosEnvio = mysqli_fetch_row($datos2);

$datos3 = $conexion->query("select productos_venta.*,    
                productos.nombre as nombre_producto, productos.imagen 
                from productos_venta inner join productos on productos_venta.id_producto = productos.id 
                where id_venta =" . $_GET['id_venta'])or die($conexion->error);
$total = $datosUsuario[3];
$descuento = "0";
$banderadescuento = false;

if($datosUsuario[6] !=0){
    $banderadescuento = true;
    $cupon = $conexion->query("select * from cupones where id =".$datosUsuario[6]);
    $filaCupon = mysqli_fetch_row($cupon);
    if($filaCupon[3]== "moneda"){
        $total = $total - $filaCupon[4];
        $descuento = $filaCupon[4]."PEN";
    }else{
        $total = $total - ($total * ($filaCupon[4] / 100));
        $descuento = $filaCupon[4]."%";
    }
    
}

// SDK de Mercado Pago
require __DIR__ . '/vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-5801138742886094-121606-fabc499be213bf129e66701a077fe7ef-239822019');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();
$preference->back_urls = array(
    "success" => "https://localhost/CarritoDeComprasML/thankyou.php?id_venta=".$_GET['id_venta']."&metodo=mercado_pago",
    "failure" => "http://localhost/CarritoDeComprasML/errorpago.php?error=failure",
    "pending" => "http://localhost/CarritoDeComprasML/errorpago.php?error=pending"
);
$preference->auto_return = "approved";

// Crea un ítem en la preferencia

$datos = array();
if($banderadescuento){
    $item = new MercadoPago\Item();
    $item->title = "Productos menos el descuento";
    $item->quantity = 1;
    $item->unit_price = $total;
    $datos[] = $item;    
}else{
    while($f = mysqli_fetch_array($datos3)){
    $item = new MercadoPago\Item();
    $item->title =  $f['nombre_producto'];;
    $item->quantity = $f['cantidad'];;
    $item->unit_price = $f['precio'];;
    $datos[] = $item;
    }    
}


$preference->items = $datos;
$preference->save();

//curl -X POST -H "Content-Type: application/json" "https://api.mercadopago.com/users/test_user?access_token=TEST-5801138742886094-121606-fabc499be213bf129e66701a077fe7ef-239822019" -d "{'site_id':'MLM'}"
//{"id":688723392,"nickname":"TETE7070208","password":"qatest7926","site_status":"active","email":"test_user_45872514@testuser.com"} -vendedor
//{"id":688723421,"nickname":"TESTE8NJC5I0","password":"qatest8632","site_status":"active","email":"test_user_69675242@testuser.com"} -comprador
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Elige metodo de pago</title>
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
    <body style="background: #F4F6F6;">
        <script src="https://www.paypal.com/sdk/js?client-id=AacZ9rgXfBooDBhw7jFdLDwHfC6561b-uLA1z5d1iTa5nCIeolWsxUR13_WMeQJX0sn7HGMpba5rMsj0&currency=USD"> // Replace YOUR_SB_CLIENT_ID with your sandbox client ID
        </script>

        <div class="site-wrap">
            <?php include("./layouts/header.php"); ?> 

            <div class="site-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Elige método de pago</h2>
                        </div>
                        
                            <div class="col-md-7" >

                            <form action="#" method="post">

                                <div class="p-3 p-lg-5 border">

                                   <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="c_fname" class="text-black"><strong>Venta: #<?php echo $_GET['id_venta']; ?></strong></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="c_fname" class="text-black "><strong>Nombre y Apellido: <?php echo $datosUsuario1['RazonSocial']; ?></strong></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="c_fname" class="text-black"><strong>Email: <?php echo $datosUsuario1['Correo']; ?></strong></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="c_fname" class="text-black"><strong>Teléfono: <?php echo $datosUsuario1['Celular']; ?></strong></label>
                                        </div>
                                    </div>
                                   <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="c_fname" class="text-black"><strong>Estado: <?php echo $datosUsuario1['status']; ?></strong></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="c_fname" class="text-black"><strong>Empresa: <?php echo $datosEnvio[2]; ?></strong></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="c_fname" class="text-black"><strong>Dirección: <?php echo $datosEnvio[3]; ?></strong></label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="c_fname" class="text-black"><strong>Ubicación: <?php echo $datosEnvio[4]; ?></strong></label>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        
                        <div class="col-md-5 ml-auto">
                            <h4 class="h1">Total: <?php echo $datosUsuario[3]; ?></h4>
                            <h5>Descuento: <?php echo $descuento; ?></h5>
                            <h5>Total Final: S/. <?php echo $total;?></h5>
                            <form action="http://localhost/CarritoDeComprasML/thankyou.php?id_venta= <?php echo $_GET['id_venta']?> &metodo=mercado_pago" method="POST">
                                <h2>Mercado pago</h2>
                                <script
                                    src="https://www.mercadopago.com.pe/integrations/v1/web-payment-checkout.js"
                                    data-preference-id="<?php echo $preference->id; ?>">
                                </script>
                            </form>
                            <div id="paypal-button-container"></div>
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
        <script>
            paypal.Buttons({
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                                amount: {
                                    value: '<?php echo $total; ?>',
                                },
                            }]
                    });
                },
                onApprove: function (data, actions) {
                    return actions.order.capture().then(function (details) {
                        if (details.status == 'COMPLETED') {
                            location.href="./thankyou.php?id_venta=<?php echo $_GET['id_venta'];?>&metodo=paypal"
                            //alert('Transaction completed by ' + details.payer.name.given_name);
                        }

                    });
                }
            }).render('#paypal-button-container'); // Display payment options on your web page
        </script>
    </body>
</html>