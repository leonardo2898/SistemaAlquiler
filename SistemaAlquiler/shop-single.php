<?php

session_start();
$_SESSION['id']=$_GET['id'];

  include("./php/conexion.php");
  if( isset($_GET['id'])){
    $resultado = $conexion ->query("select * from productos where id=".$_GET['id'])or die($conexion->error);
    if(mysqli_num_rows($resultado) > 0 ){
      $fila = mysqli_fetch_row($resultado);
    }else{
      header("Location: ./index.php");
    }
  }else{
    //redireccionar
    header("Location: ./index.php");
  }

  $resultado = $conexion->query("
  select * from clientes
  order by id DESC")or die($conexion->error);
$array = array();
  if($resultado)
  {
      while($row= mysqli_fetch_array($resultado))
      {
        $email = utf8_encode($row['RazonSocial']);
        array_push($array,$email);
      }
  }
  $resultado1 = $conexion->query("
  select * from Obras
  order by id DESC")or die($conexion->error);
$array1 = array();
  if($resultado1)
  {
      while($row1= mysqli_fetch_array($resultado1))
      {
        $email1 = utf8_encode($row1['NombreObra']);
     
        array_push($array1,$email1);
      }
  }
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tienda</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="jquery-ui.js"></script>  
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/aos.css">
    
  </head>

  <body style="background: #F4F6F6;">
  
  <div class="site-wrap">
    <?php include("./layouts/header.php"); ?> 
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <img src="images/<?php echo $fila[4]; ?>" alt="<?php echo $fila[1]; ?>" class="img-fluid">
          </div>
          <div class="col-md-5">
            <h2 class="text-black"><?php echo $fila[1]; ?></h2>
            <?php echo $fila[2]; ?> <strong class="text-primary h4">S/. <?php echo $fila[3]; ?></strong>
            <form action="./php/contactoemail.php" method="POST">
              <div class="p-3 p-lg-5 border">
              <div class="form-group row">
                  <div class="col-md-12">
                  <label for="c_email" class="text-black">Cliente <span class="text-danger">*</span></label>
                  <input type="text"  class="form-control" id="c_email" name="c_email" required="">
                      <script type="text/javascript">
                    $(document).ready(function(){
                    var items = <?= json_encode($array) ?>;
                    $("#c_email").autocomplete({
                    source: items,
                    value: items.value
                    });

                    });

                    </script>
                    
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="c_fname" class="text-black">Fecha Inicio <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="F_Inicio" name="F_Inicio" required="">
                  </div>
                  
                  <div class="col-md-6">
                    <label for="c_lname" class="text-black">Fecha Final <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="F_Final" name="F_Final" required="">
                  </div>
                </div>
             
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_subject" class="text-black">Obra</label>
                    <input type="text" class="form-control" id="c_subject" name="c_subject" required="">
                    <script type="text/javascript">
                    $(document).ready(function(){
                    var items = <?= json_encode($array1) ?>;
                    $("#c_subject").autocomplete({
                    source: items,
                    
                    });

                    });

                    </script>
                    
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_message" class="text-black">Mensaje </label>
                    <textarea name="c_message" id="c_message" cols="30" rows="7" class="form-control" required=""></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-lg-12">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Añadir Datos de Alquiler">
                  </div>
                </div>
              </div>
            </form>



            <br>
          

          </div>
        </div>
      </div>
    </div>

    
    
    <?php include("./layouts/footer.php"); ?> 
  </div>

  
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>