<?php
header("Content-Type: text/html;charset=utf-8");
$method = $_SERVER['REQUEST_METHOD'];
if($method != "POST"){
    header("Location:  http://iflores.esy.es/");
    exit;
}
//Obtener todos los datos del JSON de entrada
$data = json_decode(file_get_contents('php://input'), true);
//Peticion vacia
if (is_null($data) or !isset($data["password"])) {
    echo json_encode(array('errorCode' => 400 ));
    exit;
}
$passwordHashed     = password_hash($data["password"], PASSWORD_DEFAULT);
//incluir la configuracion a la BD
include '../../includes/dbConn.inc';
$sql = "INSERT INTO vendedor(passwordHashed) "
    ."VALUES ('".$passwordHashed."')";
$res = mysqli_query($conexion, $sql);
$filasAfectadas = mysqli_affected_rows($conexion);
//Si no se creo el arreglo floral, salir
if ($filasAfectadas != 1) {
    echo json_encode(array('errorCode' => 400 ));
    exit;
}
mysqli_close($conexion);

//Como se completo el registro regresar el id del arreglo
echo json_encode(array('exitoso' => true));
?>
