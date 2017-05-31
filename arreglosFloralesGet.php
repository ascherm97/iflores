<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Testing</title>
   </head>
   <body>
      <?php
         header("Content-Type: text/html;charset=utf-8");
         //Class definitions
         include 'iflores.inc';
         //DB connection setup
         include 'dbConn.inc';

         $sql = "SELECT * FROM arreglofloral JOIN paquete ON idArreglo=fkArreglo";
         $res = mysqli_query($conexion, $sql);
         echo json_encode(mysqli_fetch_array($res, MYSQLI_BOTH));
         // $direccion = new Direccion('Circunvalación Norte','Satelite','32','6',
         //                            'Napoles','66723','Zaguan negro, con jardinera al frente.');
         // $cliente = new Cliente('Jose Montes Hernández','5512345678','someone@example.com', $direccion);
         //
         // echo json_encode($cliente);

       ?>

   </body>
</html>
