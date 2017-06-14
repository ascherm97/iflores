<?php
header("Content-Type: text/html;charset=utf-8");
include '../../includes/Paquete.inc';
//Obtener todos los datos del JSON de entrada
$data = json_decode(file_get_contents('php://input'), true);
//ID de arreglo invalido
if (is_null($data) or !isset($data["idArreglo"])
    or !is_int($data["idArreglo"])) {
    echo json_encode(array('errorCode' => 400 ));
    return;
}
//ID de paquete invalido
if (is_null($data) or !isset($data["idPaquete"])
    or !is_int($data["idPaquete"])) {
    echo json_encode(array('errorCode' => 400 ));
    return;
}

//Inicializar objeto con los datos recibidas
$paquete = new Paquete(
    filter_var($data["idArreglo"], FILTER_VALIDATE_INT),
    $data["contenidoExtra"]
);
$paquete->nombre            = $data["nombre"];
$paquete->descripcion       = $data["descripcion"];
$paquete->precio            = $data["precio"];
$paquete->disponibilidad    = $data["disponibilidad"];
$paquete->idPaquete         = filter_var($data["idPaquete"], FILTER_VALIDATE_INT);
//Actualizar el objeto en la BD
if (!$paquete->actualizar()){
    echo json_encode(array('code' => 500 ));
    exit;
}

//Como se completo el registro regresar el id del arreglo
echo json_encode(array('idArreglo' => $data["idArreglo"]));
?>
