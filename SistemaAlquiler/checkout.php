<?php
session_start();
if (!isset($_SESSION['carrito'])) {
    header('Location: ./index.php');
}
$arreglo = $_SESSION['carrito'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Tienda &mdash;</title>
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
    <body style="background: #F2F3F4;">

        <div class="site-wrap">
            <?php include("./layouts/header.php"); ?> 
            <form action="./php/insertarpedido.php" method="post">
                <div class="site-section">
                    <div class="container">
                        <div class="row">

                            <div class="col-md-6 mb-5 mb-md-0">
                                <h2 class="h3 mb-3 text-black">Detalles de facturación</h2>
                                <div class="p-3 p-lg-5 border">
                                    <div class="form-group">
                                        <label for="c_country" class="text-black">Departamento <span class="text-danger">*</span></label>
                                        <select id="c_country" class="form-control" name="country">
                                            <option value="1">Seleccione departamento</option>    
                                            <option value="2">Amazonas</option>    
                                            <option value="3">Áncash</option>    
                                            <option value="4">Apurímac</option>    
                                            <option value="5">Arequipa</option>    
                                            <option value="6">Ayacucho</option>    
                                            <option value="7">Cajamarca</option>    
                                            <option value="8">Cuzco</option> 
                                            <option value="9">Huancavelica</option>    
                                            <option value="10">Huánuco</option>    
                                            <option value="11">Ica</option>    
                                            <option value="12">Junín</option>    
                                            <option value="13">La Libertad</option>    
                                            <option value="14">Lambayeque</option>    
                                            <option value="15">Lima Metropolitana</option>  
                                            <option value="16">Loreto</option>    
                                            <option value="17">Madre de Dios</option>    
                                            <option value="18">Moquegua</option>    
                                            <option value="19">Pasco</option>    
                                            <option value="20">Piura</option>    
                                            <option value="21">Puno</option>    
                                            <option value="22">San Martín</option>
                                            <option value="23">Tacna</option>    
                                            <option value="24">Tumbes</option>    
                                            <option value="25">Ucayali</option>    
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="c_fname" class="text-black">Nombres <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="c_fname" name="c_fname">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="c_lname" class="text-black">Apellidos <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="c_lname" name="c_lname">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="c_companyname" class="text-black">Nombre de Empresa </label>
                                            <input type="text" class="form-control" id="c_companyname" name="c_companyname">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="c_address" class="text-black">Dirección <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="c_address" name="c_address" placeholder="Dirección">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="c_state_country" class="text-black">Provincia / Distrito <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="c_state_country" name="c_state_country">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="c_postal_zip" class="text-black">Código postal <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-5">
                                        <div class="col-md-6">
                                            <label for="c_email_address" class="text-black">Dirección correo electrónico <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="c_email_address" name="c_email_address">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="c_phone" class="text-black">Teléfono <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Número teléfono">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="c_create_account" class="text-black" data-toggle="collapse" href="#create_an_account" role="button" aria-expanded="false" aria-controls="create_an_account"><input type="checkbox" value="1" id="c_create_account">¿Crea una cuenta?</label>
                                        <div class="collapse" id="create_an_account">
                                            <div class="py-2">
                                                <p class="mb-3">Cree una cuenta ingresando la información a continuación. Si es un cliente recurrente, inicie sesión en la parte superior de la página.</p>
                                                <div class="form-group">
                                                    <label for="c_account_password" class="text-black">Contraseña de la cuenta</label>
                                                    <input type="password" class="form-control" id="c_account_password" name="c_account_password" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-5">
                                    <div class="col-md-12">
                                        <h2 class="h3 mb-3 text-black">Código promocional</h2>
                                        <div class="p-3 p-lg-5 border">
                                            <label for="c_code" class="text-black mb-3">Ingrese su código de cupón si tiene uno.</label>
                                            <div class="input-group w-75" id="formCupon">
                                                <input type="text" class="form-control" id="c_code" placeholder="Código promocional" aria-label="Coupon Code" aria-describedby="button-addon2">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary btn-sm" type="button" id="button-addon2">Aplicar</button>
                                                    <br> <br>
                                                </div>
                                            </div>
                                            <h2 id="error" style="display: none" class="text-danger">Cupon no valido</h2>
                                            <div class="input-group w-75" id="datosCupon" style="display: none">
                                                <h2 id="textoCupon" class="text-success h5"></h2>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id_cupon" id="id_cupon">

                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-12">
                                        <h2 class="h3 mb-3 text-black">Su pedido</h2>
                                        <div class="p-3 p-lg-5 border">
                                            <table class="table site-block-order-table mb-5">
                                                <thead>
                                                <th>Producto</th>
                                                <th>Total</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $total = 0;
                                                    for ($i = 0; $i < count($arreglo); $i++) {
                                                        $total = $total + ($arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad']);
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $arreglo[$i]['Nombre']; ?> </td>
                                                            <td>S/.<?php echo number_format($arreglo[$i]['Precio'], 2, '.', ''); ?></td>
                                                        </tr>

                                                        <?php
                                                            }
                                                        ?>
                                                    <tr>
                                                        <td>Total del pedido</td>
                                                        <td>S/. <?php echo number_format($total, 2, '.', ''); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-success">
                                                            Descuento
                                                        </td>
                                                        <td id="tdTotal">0</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Total Final</b></td>
                                                        <td id="tdTotalFinal" 
                                                            data-total="<?php echo $total;?>">S/. <?php echo number_format($total, 2, '.', ''); ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div class="form-group">
                                                <button class="btn btn-primary btn-lg py-3 btn-block" type="submit">Realizar pedido</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>
            </form>           
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
            $(document).ready(function () {
                $("#button-addon2").click(function () {
                    var codigo = $("#c_code").val();
                    $.ajax({
                        url: "./php/validarcodigo.php",
                        data: {
                            codigo: codigo
                        },
                        method: 'POST'
                    }).done(function (respuesta) {
                        if (respuesta == "error" || respuesta == "codigo no valido") {
                            $("#error").show();
                            $("#id_cupon").val("");
                        } else {
                            var arreglo = JSON.parse(respuesta);
                            if (arreglo.tipo == "moneda") {
                                $("#textoCupon").text("Usted tiene un descuento de "+arreglo.valor+" soles");
                                $("#tdTotal").text(arreglo.valor+"PEN");
                                var total = parseFloat($("#tdTotalFinal").data('total')) - arreglo.valor;
                                $("#tdTotalFinal").text("S/."+total.toFixed(2));
                            } else {
                                $("#textoCupon").text("Usted tiene un descuento de "+arreglo.valor+"% en su compra");
                                 $("#tdTotal").text(arreglo.valor+"%");
                                 var total = parseFloat($("#tdTotalFinal").data('total')) - ((arreglo.valor/100) * parseFloat($("#tdTotalFinal").data('total'))) ;
                                $("#tdTotalFinal").text("S/."+total.toFixed(2));
                            }
                            $("#formCupon").hide();
                            $("#datosCupon").show();
                            $("#id_cupon").val(arreglo.id);
                        }
                    })
                });
                $("#c_code").keyup(function () {
                    $("#error").hide();
                });
            });
        </script>
    </body>
</html>