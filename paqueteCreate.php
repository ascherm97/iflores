<?php
header("Content-Type: text/html;charset=utf-8");
$data = json_decode(file_get_contents('php://input'), true);
include 'Paquete.inc';
// Peticion vacia
if (is_null($data)) {
    echo json_encode(array('errorCode' => 400));
    return;
}
//Validar idArreglo sea int
if (!is_int($data["idArreglo"])) {
    echo json_encode(array('errorCode' => 400 ));
    return;
}
/// Inicializar objeto con el idArreglo y contenido extra
$paquete = new Paquete($data["idArreglo"], $data["contenidoExtra"]);
// Intentar guardar el objeto en la BD
if (!$paquete->guardar()){
    echo json_encode(array('code' => 500 ));
    exit;
}
// Como se completo el registro regresar el id del arreglo
echo json_encode(array('idPaquete' => $paquete->idPaquete));
?>
