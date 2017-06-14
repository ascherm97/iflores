<?php
include '../../includes/Imagen.inc';

//Validar que se reciban los datos bien
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data["idImagen"])){
    echo json_encode(array('errorCode' => 400 ));
    exit;
}
//Recuperar los parametros
$idImagen    = filter_var($data["idImagen"], FILTER_VALIDATE_INT);
//Inicializar objeto con las variables recibidas
$imagen= new Imagen(null, null);
$imagen->idImagen = $idImagen;
//Intentar guardar el objeto en la BD
////Mover la imagen subida a la carpeta permanente
if (!$imagen->eliminar()){
    echo json_encode(array('code' => 500 ));
    exit;
}
$uri = '../'.$imagen->url;
if (!unlink($uri)) {
    echo json_encode(array('code' => 501 ));
    exit;
}
///Como se completo el registro regresar el id del arreglo
echo json_encode(array('delete' => true));
?>
