<?php
$method = $_SERVER['REQUEST_METHOD'];
if($method != "POST"){
    header("Location:  http://iflores.esy.es/");
    exit;
}
include '../../includes/Imagen.inc';

//Validar que se reciban los datos bien
if (!isset($_POST["idArreglo"]) or !isset($_FILES["inpImagenes"]["name"])) {
    echo json_encode(array('errorCode' => 400 ));
    return;
}
//Recuperar los parametros
$imagenNombre = $_FILES['inpImagenes']['name'];
$idArreglo    = $_POST["idArreglo"];
//Crear la uri unica para esa imagen
$uri          = 'imgs/'.date('Y-m-d-h:i:s', time()).$imagenNombre;
//Mover la imagen subida a la carpeta permanente
move_uploaded_file($_FILES['inpImagenes']['tmp_name'],'../'.$uri);
//Inicializar objeto con las variables recibidas
$imagen= new Imagen($idArreglo, $uri);
$imagen->idArreglo = $idArreglo;
$imagen->url       = $uri;
//Intentar guardar el objeto en la BD
////Mover la imagen subida a la carpeta permanente
if (!$imagen->guardar()){
    echo json_encode(array('code' => 500 ));
    exit;
}
///Como se completo el registro regresar el id del arreglo
echo json_encode(array('idImagen' => $imagen->idImagen));
?>
