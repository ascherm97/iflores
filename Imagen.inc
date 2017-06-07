<?php
class Imagen {
    public $idImagen;
    public $idArreglo;
    public $url;
    function __construct($idArreglo, $url) {
        $this->idArreglo = $idArreglo;
        $this->url       = $url;
    }
    //Agrega una nueva imagen a la base de datos, por medio de la URL
    function guardar()
    {
        //incluir la configuracion a la BD
        include 'dbConn.inc';
        $sql = "INSERT INTO imagenes (urlImagen, fkArreglo)
            VALUES ('".$this->url."', ".$this->idArreglo.")";
        $res = mysqli_query($conexion, $sql);
        $filasAfectadas = mysqli_affected_rows($conexion);
        //Si no se creo el arreglo floral, salir
        if ($filasAfectadas != 1) {
            return false;
        }
        $result = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT LAST_INSERT_ID() as idImagen"));
        $this->idImagen = $result["idImagen"];
        mysqli_close($conexion);
        return true;

    }
   //Elimina imagen de la BD
    //Regresa false sino se pudo hacer, true si fue exitoso
    function eliminar()
    {
        //incluir la configuracion a la BD
        include 'dbConn.inc';
        $sql = "DELETE FROM imagenes WHERE idImagen=".$this->idImagen;
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
