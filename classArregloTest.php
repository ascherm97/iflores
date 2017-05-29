<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Testing</title>
   </head>
   <body>
      <?php
      header("Content-Type: text/html;charset=utf-8");
      include 'iflores.inc';
      $arregloFloral = new ArregloFloral('Rosa Bella','Un perfecto detalle para las madres.',
                                 199.99, True, "imgs/rosaBella/1");

      echo json_encode($arregloFloral);
       ?>

   </body>
</html>
