<?php
header("Content-Type: text/html;charset=utf-8");
include 'Pedido.inc';
//Obtener todos los datos del JSON de entrada
$data = json_decode(file_get_contents('php://input'), true);
//ID de pedido invalido
if (is_null($data) or !isset($data["idPedido"])) {
    echo json_encode(array('errorCode' => 400 ));
    return;
}
//Validar estatus
if (!isset($data["estatus"])) {
    echo json_encode(array('errorCode' => 400 ));
    return;
}
$data["idPedido"]   = filter_var($data["idPedido"], FILTER_VALIDATE_INT);
$data["estatus"]    = filter_var($data["estatus"], FILTER_VALIDATE_INT);
//Validar estatus tenga un valor 0,1,2
if ($data["estatus"]<0 or $data["estatus"]>2) {
    echo json_encode(array('errorCode' => 401 ));
    return;
}

//DB connection setup
include 'dbConn.inc';
//Checar si hay conexion con la base de datos
if (!$conexion) {
    echo json_encode(array('code' => 500 ));
    exit;
}

//Obtener la inforamcion de un producto
$sql = "UPDATE pedido SET estatus='".$data["estatus"]."' WHERE idPedido= '".$data["idPedido"]."'";
$res = mysqli_query($conexion, $sql);
//Checar si dio resultado
if (!$res){
    echo json_encode(array('errorCode' => 400 ));
    exit;
}
$filasAfectadas = mysqli_affected_rows($conexion);
//Si no se creo el pedido, salir
if ($filasAfectadas != 1) {
    echo json_encode(array('errorCode' => 400 ));
    exit;
}
mysqli_close($conexion);

//Como se completo el registro regresar el id del arreglo
echo json_encode(array('code' => $data["idPedido"]));
?>
