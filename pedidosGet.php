<?php
header("Content-Type: text/html;charset=utf-8");
//Class definitions
include '../../includes/Pedido.inc';
//DB connection setup
include '../../includes/dbConn.inc';
//Checar si hay conexion con la base de datos
if (!$conexion) {
    echo json_encode(array('code' => 500 ));
    exit;
}

//Obtener la inforamcion de un producto
$sql = "SELECT * FROM resumenPedido";
$res = mysqli_query($conexion, $sql);
//Checar si dio resultado
if (!$res){
    echo json_encode(array('errorCode' => 400 ));
    exit;
}
//Serializar la informacion para regresarla como un JSON
$filas = array();
while($r = mysqli_fetch_assoc($res)) {
    $filas[] = $r;
}
echo json_encode(array('pedidos' => $filas));
?>
