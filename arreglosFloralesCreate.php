<?php
header("Content-Type: text/html;charset=utf-8");
$data = json_decode(file_get_contents('php://input'), true);
include 'ArreglosFlorales.inc';
//Peticion vacia
if (is_null($data)) {
    echo json_encode(array('errorCode' => 400 ));
    exit;
}
//Inicializar objeto con las variables recibidas
$arreglo = new ArregloFloral(
    $data["nombre"],
    $data["descripcion"],
    $data["precio"],
    $data["disponibilidad"]
);
//Intentar guardar el objeto en la BD
if (!$arreglo->guardar()){
    echo json_encode(array('code' => 500 ));
    exit;
}
//Agregar cada url a la BD
//$imagenesAgregadas = 0;
//foreach ($data["imagenes"] as $imagen){
    //if ($arreglo->agregarImagen($imagen)){
        //$imagenesAgregadas =  $imagenesAgregadas + 1;
    //}
//}
//unset($imagen);
////Como se completo el registro regresar el id del arreglo
echo json_encode(array('idArreglo' => $arreglo->idArreglo));
?>
