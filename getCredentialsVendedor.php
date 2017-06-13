<?php
header("Content-Type: text/html;charset=utf-8");

//Obtener todos los datos del JSON de entrada
$data = json_decode(file_get_contents('php://input'), true);
//Password definido
if (!isset($data["password"])) {
    echo json_encode(array('errorCode' => 400 ));
    return;
}
//incluir la configuracion a la BD
include 'dbConn.inc';
// Obtener el hash para esa cuenta
$sql = "SELECT passwordHashed as hash FROM vendedor WHERE idVendedor=1";
$result = mysqli_fetch_assoc(mysqli_query($conexion, $sql));
mysqli_close($conexion);
//El email no es valido
if (!result) {
    echo json_encode(array('errorCode' => 400));
    return;
}
//Asignar el hash que se obtuvo de la query
$hash       = $result["hash"];
if(!password_verify($data["password"], $hash)) {
    echo json_encode(array('errorCode' => 503));
    return;
}

//Generar token de acceso de 32 caracteres
$token            = bin2hex(random_bytes(16));
//Obtener el timestamp en este momento
$tiempoActual     = time();
//Genera el timestamp de expiracion
//Expira 5 minutos despues de que se le otorgen credenciales
$tiempoExpira = $tiempoActual + 5*60;

//incluir la configuracion a la BD
include 'dbConn.inc';
//Guardar las nuevas credenciales en la BD
$sql = "UPDATE vendedor SET "
    ."token='".$token."',"
    ."tokenExpira=".$tokenExpira." "
    ." WHERE idVendedor=1";
$res = mysqli_query($conexion, $sql);
//Salir si no se hizo la query
if (!res) {
    echo json_encode(array('errorCode' => 500));
}
mysqli_close($conexion);

//Como se completo el registro regresar el id del arreglo
echo json_encode(array('idVendedor' => 1));
?>
