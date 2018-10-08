<?php 
include_once("config.php");
if (!isset($_SESSION)) {
    session_start();
}

include_once("functions.php");
if (!func::checkLoginState($dbh)) {
    echo '<script language="javascript">window.location="login.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#000000">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Proyecto Psicologia</title>
<style>
<?php include('styles/Index.css'); ?>
</style>
</head>
  <body>
  <section class="parent">
    <div class="child">
        <?php
<<<<<<< HEAD
            if(!func::checkLoginState($dbh)){
                header("location: login.php");
            }
            echo "<h1>Bienvenido ".$_SESSION['usuario_nombre'] ." !!!!</h1></br>";
            include("estudiantes.php");
=======
        echo "<h1>Bienvenido " . $_SESSION['usuario_nombre'] . " !!!!</h1></br>";
        include("estudiantes.php");
>>>>>>> a592fe31df4aecae2dd28b26f4ecd47e19ae3b8d
        ?>
    </div>
</section>
  </body>
  <?php
<<<<<<< HEAD
  include_once("footer.php");
  ?>
=======
    include_once("footer.php");
    ?>
>>>>>>> a592fe31df4aecae2dd28b26f4ecd47e19ae3b8d
