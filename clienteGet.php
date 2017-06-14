<?php
header("Content-Type: text/html;charset=utf-8");
//DB connection setup
include '../../includes/Cliente.inc';
//Recuperar los datos de la peticion
//$data = json_decode(file_get_contents('php://input'), true);
$idCliente = filter_input(INPUT_GET, 'idCliente', FILTER_SANITIZE_NUMBER_INT);
//Peticion vacia
if (!$idCliente) {
    echo json_encode(array('errorCode' => 400 ));
    return;
}
include 'dbConn.inc';

//Checar si hay conexion con la base de datos
if (!$conexion) {
    echo json_encode(array('code' => 500 ));
    exit;
}

//Obtener la inforamcion de un cliente
$sql = "SELECT idCliente, nombres, apellidoPaterno, apellidoMaterno,telefono,
    email FROM cliente WHERE idCliente=".$idCliente;
$res = mysqli_query($conexion, $sql);
//Checar que si haya resultados
if(!$res){
    echo json_encode(array('errorCode' => 400));
    exit;
}
$r = mysqli_fetch_assoc($res);
//Checar que haya resultado
if (!$r) {
    echo json_encode(array('errorCode' => 500));
    exit;
}

//Obtener la direccion del cliente
$sql = "SELECT calle, colonia, numeroExterior, numeroInterior, ciudad,
    codigoPostal, referencia FROM direccion
    WHERE fkCliente=".$idCliente;
$res = mysqli_query($conexion, $sql);

$r["direccion"] = mysqli_fetch_assoc($res);

//Serializar la informacion para regresarla como un JSON
echo json_encode($r);
?>
