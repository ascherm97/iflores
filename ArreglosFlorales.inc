<?php
/**
 * Clase para el Arreglo flora
 */
Class ArregloFloral
{
    public $idArreglo;
    public $nombre;
    public $descripcion;
    public $precio;
    public $disponibilidad;
    public $imagenes = array();

    function __construct($nombre, $descripcion, $precio, $disponibilidad)
    {
        $this->nombre           = $nombre;
        $this->descripcion      = $descripcion;
        $this->precio           = $precio;
        $this->disponibilidad   = $disponibilidad;
    }
    //Inserta este arreglo floral en la BD
    //Regresa false sino se pudo hacer, true si fue exitoso
    function guardar()
    {
        //incluir la configuracion a la BD
        include 'dbConn.inc';
        $sql = "INSERT INTO arreglofloral (nombre, descripcion, precio, disponibilidad)
            VALUES ('".$this->nombre."', '".$this->descripcion."', ".$this->precio
            .", ".$this->disponibilidad.")";
        $res = mysqli_query($conexion, $sql);
        $filasAfectadas = mysqli_affected_rows($conexion);
        //Si no se creo el arreglo floral, salir
        if ($filasAfectadas != 1) {
            return false;
        }
        $result = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT LAST_INSERT_ID() as idArreglo"));
        $this->idArreglo = $result["idArreglo"];
        mysqli_close($conexion);
        return true;
    }
   //Actualiza este arreglo floral en la BD
    //Regresa false sino se pudo hacer, true si fue exitoso
    function actualizar()
    {
        //incluir la configuracion a la BD
        include 'dbConn.inc';
        $sql = "UPDATE arreglofloral SET "
            ."nombre ='".$this->nombre."', "
            ."descripcion ='".$this->descripcion."', "
            ."precio =".$this->precio.", "
            ."disponibilidad =".$this->disponibilidad
            ." WHERE idArreglo=".$this->idArreglo;
        $res = mysqli_query($conexion, $sql);
        $filasAfectadas = mysqli_affected_rows($conexion);
        echo $filasAfectadas;
        //Si no se creo el arreglo floral, salir
        if ($filasAfectadas != 1) {
            return false;
        }
        mysqli_close($conexion);
        return true;
    }
}

?>
