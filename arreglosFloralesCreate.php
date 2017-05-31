<?php
   header("Content-Type: text/html;charset=utf-8");
   include 'iflores.inc';
   $data = json_decode(file_get_contents('php://input'), true);
   //Peticion vacia
   if (is_null($data)) {
      echo json_encode(array('errorCode' => 400 ));
      return;
   }

   //Crear el arreglo floral, si se trata de un de un arreglofloral
   if (is_null($data["contenidoExtra"])) {
      $sql = "INSERT INTO arreglofloral (nombre, descripcion, precio, disponibilidad)
       VALUES ($data['nombre'], $data['descripcion'], $data['precio'], $data['disponibilidad'])";
      $res = mysqli_query($conexion, $sql);
      $filasAfectadas = mysqli_affected_rows($conexion);
      //Si no se creo el arreglo floral, salir
      if ($filasAfectadas != 1) {
         echo json_encode( array('errorCode' => 500 ));
         exit;
      }
   }
   //Crear el paquete, si se trata de un de un paquete
   if (isset($data["contenidoExtra"])) {
      //Primero crear el Arreglo Floral
      $sql = "INSERT INTO arreglofloral (nombre, descripcion, precio, disponibilidad)
      VALUES ($data['nombre'], $data['descripcion'], $data['precio'], $data['disponibilidad'])";
      $res = mysqli_query($conexion, $sql);
      $filasAfectadas = mysqli_affected_rows($conexion);
      //Si no se creo el arreglo floral, salir
      if ($filasAfectadas != 1) {
         echo json_encode( array('errorCode' => 500 ));
         exit;
      }
      //Obtener ID del arreglo recien creado
      $sql = "SELECT idArreglo FROM arreglofloral
               WHERE nombre = $data['nombre']";
      $res = mysqli_fetch_assoc(mysqli_query($conexion, $sql));
      $idArreglo = $res["idArreglo"];
      //Crear el paquete referenciando al arreglofloral recien creado
      $sql = "INSERT INTO paquete (fkArreglo, contenidoExtra)
      VALUES ($idArreglo, $data['contenidoExtra'])";
      //Si no se creo el paquete, salir
      if ($filasAfectadas != 1) {
         echo json_encode( array('errorCode' => 500 ));
         exit;
      }
   }
   echo json_encode(array('code' => 203 ));
 ?>
