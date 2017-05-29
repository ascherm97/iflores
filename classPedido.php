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

         $direccion = new Direccion('Circunvalación Norte','Satelite','32','6',
                                    'Napoles','66723','Zaguan negro, con jardinera al frente.');
         $cliente = new Cliente('Jose Montes Hernández','5512345678','someone@example.com', $direccion);
         $paquete = new Paquete('Bienvenido Cielo','Un perfecto detalle para desestresarte.',
                              149.99, False, "imgs/BienvenidoCielo01.jpg","Este paquete te incluye una caja de chocolates ferrero.");
         $arregloFloral = new ArregloFloral('Rosa Bella','Un perfecto detalle para las madres.',
                              199.99, True, "imgs/rosaBella01.pgn");
         $pedido = new Pedido("2017-05-22T16:13:03+0000","2017-05-29T00:00:00+0000",220.00,$cliente,$arregloFloral);
         echo "Arreglo Floral <br>";
         echo json_encode($pedido);
         $pedido = new Pedido("2017-05-22T16:13:03+0000","2017-05-29T00:00:00+0000",220.00,$cliente,$paquete);
         echo "<br> Caso de un paquete <br>";
         echo json_encode($pedido);

       ?>

   </body>
</html>
