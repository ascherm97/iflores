<?php
   header("Content-Type: text/html;charset=utf-8");
   include 'iflores.inc';
   $data = json_decode(file_get_contents('php://input'), true);
   //Peticion vacia
   if (is_null($data)) {
      echo json_encode(array('errorCode' => 400 ));
      return;
   }
   $sql = "INSERT INTO arreglofloral (nombre, descripcion, precio, disponibilidad)
    VALUES ('".$data["nombre"]."', '".$data["descripcion"]."', ".$data["precio"].", '".$data["disponibilidad"]."')";
    echo $sql;
   $res = mysqli_query($conexion, $sql);
   $filasAfectadas = mysqli_affected_rows($conexion);
   //Si no se creo el arreglo floral, salir
   if ($filasAfectadas != 1) {
      echo json_encode( array('errorCode' => 500 ));
      exit;
   }

   echo json_encode(array('code' => 203 ));
 ?>
