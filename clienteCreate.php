<?php
header("Content-Type: text/html;charset=utf-8");
 
$method = $_SERVER['REQUEST_METHOD'];
if($method != "POST"){
    header("Location:  http://iflores.esy.es/");
    exit;
}
$data = json_decode(file_get_contents('php://input'), true);
include '../../includes/Cliente.inc';
include '../../includes/mailer.inc';

//Peticion vacia
if (is_null($data)) {
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

//Intentar guardar el objeto en la BD
if (!$cliente->guardar()){
    echo json_encode(array('errorCode' => 500 ));
}
$emailEnviado = sendSignUpMail($cliente->email,$cliente->nombres." ".$cliente->apellidoPaterno." ".$cliente->apellidoMaterno);
//Como se completo el registro regresar el id del clietne
echo json_encode(array('idCliente' => $cliente->idCliente));
?>
