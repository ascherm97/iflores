   <?php
         header("Content-Type: text/html;charset=utf-8");
         //Class definitions
         include 'iflores.inc';
         //DB connection setup
         include 'dbConn.inc';
         if (!$conexion) {
             echo "Error: Unable to connect to MySQL." . PHP_EOL;
             exit;
         }


         $sql = "SELECT idArreglo, nombre, descripcion, precio, disponibilidad, contenidoExtra FROM arreglofloral LEFT JOIN paquete ON idArreglo=fkArreglo";
         $res = mysqli_query($conexion, $sql);
         $rows = array();
         while($r = mysqli_fetch_assoc($res)) {
             $rows[] = $r;
         }
         echo json_encode($rows);
       ?>
