<?php

  include_once("header.php");

  $arrayName = array();

  $sql = 'SELECT estudiantes.nombre , estudiantes.documento FROM estudiantes JOIN grupos ON estudiantes.id = 1 and grupos.`id_co-tallerista` = 1 ';

  foreach ($dbh->query($sql) as $row) {

      array_push($arrayName, $row["nombre"]);
  }



  // set the resulting array to associative
  
?>
  <select class="" name="">
    <?php
      $limit = 10;
      for ($i=0; $i < sizeof($arrayName); $i++) {
        ?>
        <option value=<?php echo '"'.$arrayName[$i].'"'; ?> > <?php echo $arrayName[$i]; ?></option>
      <?php
      }

    ?>
  </select>

<?php
?>
