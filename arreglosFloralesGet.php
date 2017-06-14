<?php
header("Content-Type: text/html;charset=utf-8");
header("Access-Control-Allow-Origin: http://iflores.esy.es");
$method = $_SERVER['REQUEST_METHOD'];
if($method != "POST" and $method != "GET"){
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
$sql = "SELECT idArreglo, nombre, descripcion, precio, disponibilidad,
    idPaquete, contenidoExtra FROM arreglofloral LEFT JOIN paquete ON idArreglo=fkArreglo";
$res = mysqli_query($conexion, $sql);
if (!res){
    echo "{}";
    exit;
}

//Serializar la informacion para regresarla como un JSON
$filas = array();
while($r = mysqli_fetch_assoc($res)) {
    //Obtener las imagenes de un producto
    $sql =  "SELECT urlImagen FROM imagenes WHERE fkArreglo=".$r["idArreglo"];
    $respuesta = mysqli_query($conexion, $sql);
    //Serializa las imagenes correspondientes a cada producto
    $r["imagenes"] = array();
    while($f = mysqli_fetch_assoc($respuesta)) {
        array_push($r["imagenes"], $f["urlImagen"]);
    }
    $filas[] = $r;
}
echo json_encode(array('arreglos' => $filas));
?>
