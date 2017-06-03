<?php
header("Content-Type: text/html;charset=utf-8");
$data = json_decode(file_get_contents('php://input'), true);
include 'Paquete.inc';
//Peticion vacia
if (is_null($data)) {
    echo json_encode(array('errorCode' => 400 ));
    return;
}
//Inicializar objeto con las variables recibidas
$paquete = new Paquete(
    $data["nombre"],
    $data["descripcion"],
    $data["precio"],
    $data["disponibilidad"],
    $data["contenidoExtra"]
);
//Intentar guardar el objeto en la BD
if (!$paquete->guardar()){
    echo json_encode(array('code' => 500 ));
}
//Agregar cada url a la BD
$imagenesAgregadas = 0;
foreach ($data["imagenes"] as $imagen){
    if ($paquete->agregarImagen($imagen)){
        $imagenesAgregadas =  $imagenesAgregadas + 1;
    }
}
unset($imagen);

//Como se completo el registro regresar el id del arreglo
echo json_encode(array('idArreglo' => $arreglo->idArreglo));
?>
