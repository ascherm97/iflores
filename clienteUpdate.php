<?php
header("Content-Type: text/html;charset=utf-8");
$data = json_decode(file_get_contents('php://input'), true);
include 'Cliente.inc';

//ID de arreglo invalido
if (is_null($data) or !isset($data["idCliente"])
    or !is_int($data["idCliente"])) {
    echo json_encode(array('errorCode' => 400 ));
    return;
}
//ID de paquete invalido
if (is_null($data) or !isset($data["idDireccion"])
    or !is_int($data["idDireccion"])) {
    echo json_encode(array('errorCode' => 400 ));
    return;
}


//Inicializar objeto direccion con las variables recibidas
$direccion= new Direccion(
    $data["direccion"]["calle"],
    $data["direccion"]["colonia"],
    $data["direccion"]["numeroExterior"],
    $data["direccion"]["numeroInterior"],
    $data["direccion"]["ciudad"],
    $data["direccion"]["codigoPostal"],
    $data["direccion"]["referencia"]
);
$direccion->idDireccion = $data["idDireccion"];

//Inicializar objeto cliente con las variables recibidas
$cliente= new Cliente(
    $data["nombres"],
    $data["apellidoPaterno"],
    $data["apellidoMaterno"],
    $data["telefono"],
    $data["email"],
    $data["password"],
    $direccion
);
$cliente->idCliente= $data["idCliente"];

//Intentar guardar el objeto en la BD
if (!$cliente->actualizar()){
    echo json_encode(array('code' => 500 ));
}

//Como se completo el registro regresar el id del clietne
echo json_encode(array('idCliente' => $cliente->idCliente));
?>
