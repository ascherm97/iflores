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
      $paquete = new Paquete('Bienvenido Cielo','Un perfecto detalle para desestresarte.',
                                 149.99, False, "imgs/BienvenidoCielo01.jpg","Este paquete te incluye una caja de chocolates ferrero.");

      echo json_encode($paquete);
       ?>

   </body>
</html>
