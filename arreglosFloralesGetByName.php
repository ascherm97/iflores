<?php
header("Content-Type: text/html;charset=utf-8");
 header("Access-Control-Allow-Origin: http://iflores.esy.es");
$method = $_SERVER['REQUEST_METHOD'];
if($method != "POST" and $method!= "GET"){
    header("Location:  http://iflores.esy.es/");
    exit;
}
//Class definitions
include '../../includes/iflores.inc';
//DB connection setup
include '../../includes/dbConn.inc';
if (!$conexion) {
    echo json_encode(array('code' => 500 ));
    exit;
}

//Obtener todos los productos de la BD
$sql = "SELECT idArreglo, nombre FROM arreglofloral LEFT JOIN paquete ON idArreglo=fkArreglo";
$res = mysqli_query($conexion, $sql);
if (!res){
    echo "{}";
    exit;
}

//Generar un arreglo con todos los registros
$filas = array();
while($fila = mysqli_fetch_assoc($res)) {
    $filas[] = $fila;
}
//Serializar la informacion para regresarla como un JSON
echo json_encode(array('arreglos' => $filas));
?>
