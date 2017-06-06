<?php
//Incluir la clase padre
include 'ArreglosFlorales.inc';
class Paquete extends ArregloFloral
{
    public $idPaquete;
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
        $result = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT LAST_INSERT_ID() as idPaquete"));
        $this->idPaquete = $result["idPaquete"];
        mysqli_close($conexion);
        return true;
    }
    //Actualiza este arreglo floral en la BD
    //Regresa false sino se pudo hacer, true si fue exitoso
    function actualizar()
    {
        //Si no se pudo actualizar el arreglo regresar false
        if (!parent::actualizar()){
            return false;
        }
        //incluir la configuracion a la BD
        include 'dbConn.inc';
        $sql = "UPDATE paquete SET "
            ."contenidoExtra ='".$this->contenidoExtra."'"
            ." WHERE idPaquete=".$this->idPaquete;
        $res = mysqli_query($conexion, $sql);
        echo var_dump($res);
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
