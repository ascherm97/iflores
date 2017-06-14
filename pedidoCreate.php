<?php
header("Content-Type: text/html;charset=utf-8");
include '../../includes/Pedido.inc';
//Obtener todos los datos del JSON de entrada
$data = json_decode(file_get_contents('php://input'), true);
//Peticion vacia
if (is_null($data) or !isset($data["idCliente"])
    or !isset($data["idArreglo"])) {
    echo json_encode(array('errorCode' => 400 ));
    return;
}
//Inicializar objeto con las variables recibidas
$pedido = new Pedido(
    $data["fechaPedido"],
    $data["fechaEntrega"],
    $data["idCliente"],
    $data["idArreglo"]
);
//Calcular el precio
if (!$pedido->calcularCosto()){
    echo json_encode(array('code' => 500 ));
}
//Guardar el objeto en la BD
if (!$pedido->guardar()){
    echo json_encode(array('code' => 500 ));
}
//Como se completo el registro regresar el id del arreglo
echo json_encode(array('idPedido' => $pedido->idPedido));
?>
