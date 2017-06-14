<?php
header("Content-Type: text/html;charset=utf-8");
//Class definitions
include '../../includes/Pedido.inc';
$method = $_SERVER['REQUEST_METHOD'];
if($method != "POST"){
    header("Location:  http://iflores.esy.es/");
    exit;
}
//Recuperar los datos de la peticion
//$data = json_decode(file_get_contents('php://input'), true);
$idPedido = filter_input(INPUT_GET, 'idPedido', FILTER_SANITIZE_NUMBER_INT);
//Peticion vacia
if (!$idPedido) {
    echo json_encode(array('errorCode' => 400 ));
    return;
}

//DB connection setup
include '../../includes/dbConn.inc';
//Checar si hay conexion con la base de datos
if (!$conexion) {
    echo json_encode(array('code' => 500 ));
    exit;
}

//Obtener la inforamcion de un producto
$sql = "SELECT * FROM resumenPedido WHERE idArreglo=".$idPedido;
$res = mysqli_query($conexion, $sql);
//Checar si dio resultado
if (!$res){
    echo json_encode(array('errorCode' => 400 ));
    exit;
}
$fila = mysqli_fetch_assoc($res);

if (!$fila){
    echo json_encode(array('errorCode' => 400 ));
    exit;
}
mysqli_close($conexion);
//Serializa las imagenes correspondientes a cada producto
echo json_encode($fila);
?>
