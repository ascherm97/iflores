<?php
include '../../includes/Cliente.inc';
header("Content-Type: text/html;charset=utf-8");

//Obtener todos los datos del JSON de entrada
$data = json_decode(file_get_contents('php://input'), true);
//Peticion vacia
if (is_null($data) or !isset($data["email"])
    or !isset($data["email"])) {
    echo json_encode(array('errorCode' => 400 ));
    return;
}
//Email definido
if (!isset($data["email"]) or !isset($data["email"])) {
    echo json_encode(array('errorCode' => 400 ));
    return;
}
//Password definido
if (!isset($data["password"]) or !isset($data["password"])) {
    echo json_encode(array('errorCode' => 400 ));
    return;
}
//incluir la configuracion a la BD
include '../../includes/dbConn.inc';
// Obtener el hash para esa cuenta
$sql = "SELECT idCliente, nombres,passwordHashed as hash FROM cliente WHERE email='".$data["email"]."'";
$result = mysqli_fetch_assoc(mysqli_query($conexion, $sql));
mysqli_close($conexion);
//El email no es valido
if (!result) {
    echo json_encode(array('errorCode' => 1));
    return;
}
// Obtener el hash para esa cuenta
$hash       = $result["hash"];
$nombres    = $result["nombres"];
$idCliente  = $result["idCliente"];

if(!password_verify($data["password"], $hash)) {
    echo json_encode(array('errorCode' => 1));
    return;
}

//Generar token de acceso de 32 caracteres
$token            = bin2hex(random_bytes(16));
//Obtener el timestamp en este momento
$tiempoActual     = time();
//Genera el timestamp de expiracion
//Expira 5 minutos despues de que se le otorgen credenciales
$tiempoExpiracion = $tiempoActual + 5*60;
//Inicializar el cliente para pasarle las credenciales
$cliente = new Cliente(null, null, null, null, null, "", null);
$cliente->idCliente     = $idCliente;
$cliente->token         = $token;
$cliente->tokenExpira   = $tiempoExpiracion;

//Guardar las nuevas credenciales en la BD
if(!$cliente->actualizarCredenciales()){
    echo json_encode(array('errorCode' => 500));
    return;
}

//Como se completo el registro regresar el id del arreglo
echo json_encode(array('idCliente' => $idCliente, 'nombres' => $nombres, 'token' => $token));
?>
