<?php
//Incluir la clase padre
include 'ArreglosFlorales.inc';
class Paquete extends ArregloFloral
{
    public $contenidoExtra;

    function __construct($nombre, $descripcion, $precio, $disponibilidad, $contenidoExtra)
    {
        parent::__construct($nombre, $descripcion, $precio, $disponibilidad);
        $this->contenidoExtra   =  $contenidoExtra;
    }

    //Guardar un paquete en la BD
    function guardar()
    {
        //Si no se pudo guardar el arreglo mandar false
        if (!parent::guardar()){
            return false;
        }
        //incluir la configuracion a la BD
        include 'dbConn.inc';
        //Crear el paquete referenciando al arreglofloral recien creado
        $sql = "INSERT INTO paquete (fkArreglo, contenidoExtra)
            VALUES (".$this->idArreglo.", '".$this->contenidoExtra."')";
        $res = mysqli_query($conexion, $sql);
        $filasAfectadas = mysqli_affected_rows($conexion);
        //Si no se creo el arreglo floral, salir
        if ($filasAfectadas != 1) {
            return false;
        }
        mysqli_close($conexion);
        return true;


    }
}



?>
