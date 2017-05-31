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
         // $conexion = mysqli_connect("mysql.hostinger.mx","u542056880_root", "password.iflores.MVV","u542056880_iflor");
         // mysqli_query($conexion, "SET NAMES 'utf8'");
         if (!$conexion) {
             echo "Error: Unable to connect to MySQL." . PHP_EOL;
             exit;
         }


         $sql = "SELECT * FROM arreglofloral LEFT JOIN paquete ON idArreglo=fkArreglo";
         $res = mysqli_query($conexion, $sql);
         $rows = array();
         while($r = mysqli_fetch_assoc($res)) {
             $rows[] = $r;
         }
         echo json_encode($rows);
         // $direccion = new Direccion('Circunvalación Norte','Satelite','32','6',
         //                            'Napoles','66723','Zaguan negro, con jardinera al frente.');
         // $cliente = new Cliente('Jose Montes Hernández','5512345678','someone@example.com', $direccion);
         //
         // echo json_encode($cliente);

       ?>

   </body>
</html>
