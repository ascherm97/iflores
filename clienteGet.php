<?php
header("Content-Type: text/html;charset=utf-8");
//DB connection setup
include 'Cliente.inc';
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

//Peticion vacia
if (is_null($data)) {
    echo json_encode(array('errorCode' => 400 ));
    return;
}
//Validar que solo sea un Int
if (!is_int($data["idCliente"]) or !isset($data["idCliente"])) {
    echo json_encode(array('errorCode' => 400 ));
    return;
}
//Obtener la inforamcion de un cliente
$sql = "SELECT idCliente, nombres, apellidoPaterno, apellidoMaterno,telefono,
    email FROM cliente WHERE idCliente=".$data["idCliente"];
$res = mysqli_query($conexion, $sql);

$r = mysqli_fetch_assoc($res);
//Checar que haya resultado
if (!r) {
    echo json_encode(array('errorCode' => 500));
}

//Obtener la direccion del cliente
$sql = "SELECT calle, colonia, numeroExterior, numeroInterior, ciudad,
    codigoPostal, referencia FROM direccion
    WHERE fkCliente=".$data["idCliente"];
$res = mysqli_query($conexion, $sql);

$r["direccion"] = mysqli_fetch_assoc($res);

//Serializar la informacion para regresarla como un JSON
echo json_encode($r);
?>
