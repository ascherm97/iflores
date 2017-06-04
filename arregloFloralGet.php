<?php
header("Content-Type: text/html;charset=utf-8");
//Class definitions
include 'ArreglosFlorales.inc';
//DB connection setup
include 'dbConn.inc';

//Recuperar los datos de la peticion
$data = json_decode(file_get_contents('php://input'), true);
//Peticion vacia
if (is_null($data)) {
    echo json_encode(array('errorCode' => 400 ));
    return;
}
//Checar si hay conexion con la base de datos
if (!$conexion) {
    echo json_encode(array('code' => 500 ));
    exit;
}

//Obtener la inforamcion de un producto
$sql = "SELECT idArreglo, nombre, descripcion, precio, disponibilidad,
    contenidoExtra, idPaquete FROM arreglofloral LEFT JOIN paquete ON idArreglo=fkArreglo
    WHERE idArreglo=".$data["idArreglo"];
$res = mysqli_query($conexion, $sql);
//Checar si dio resultado
if (!$res){
    echo json_encode(array('errorCode' => 400 ));
    exit;
}
$r = mysqli_fetch_assoc($res);

//Obtener las imagenes de un producto
$sql =  "SELECT urlImagen FROM imagenes WHERE fkArreglo=".$r["idArreglo"];
$respuesta = mysqli_query($conexion, $sql);
//Checar si dio resultado
if (!$respuesta) {
    echo json_encode(array('errorCode' => 400 ));
    exit;
}
//Serializa las imagenes correspondientes a cada producto
$r["imagenes"] = array();
while($f = mysqli_fetch_assoc($respuesta)) {
    array_push($r["imagenes"], $f["urlImagen"]);
}
mysqli_close($conexion);
echo json_encode($r);
?>
