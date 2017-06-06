<?php
header("Content-Type: text/html;charset=utf-8");
include 'ArreglosFlorales.inc';
//Obtener todos los datos del JSON de entrada
$data = json_decode(file_get_contents('php://input'), true);
//ID de arreglo invalido
if (is_null($data) or !isset($data["idArreglo"])
    or !is_int($data["idArreglo"])) {
    echo json_encode(array('errorCode' => 400 ));
    return;
}

//Inicializar objeto con los datos recibidas
$arreglo = new ArregloFloral(
    $data["nombre"],
    $data["descripcion"],
    $data["precio"],
    $data["disponibilidad"]
);
$arreglo->idArreglo = $data["idArreglo"];
//Actualizar el objeto en la BD
if (!$arreglo->actualizar()){
    echo json_encode(array('code' => 500 ));
    exit;
}

//Como se completo el registro regresar el id del arreglo
echo json_encode(array('idArreglo' => $data["idArreglo"]));
?>
