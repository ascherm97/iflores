<?php
/**
 * Direccion
 */
class Direccion
{
   public $idDireccion;
   public $fkCliente;
   public $calle;
   public $colonia;
   public $numeroExterior;
   public $numeroInterior;
   public $ciudad;
   public $codigoPostal;
   public $referencia;

   function __construct($calle, $colonia, $numeroExterior, $numeroInterior,
                        $ciudad, $codigoPostal, $referencia)
   {
      $this->calle            = $calle;
      $this->colonia          = $colonia;
      $this->numeroExterior   = $numeroExterior;
      $this->numeroInterior   = $numeroInterior;
      $this->ciudad           = $ciudad;
      $this->codigoPostal     = $codigoPostal;
      $this->referencia       = $referencia;
   }
    //Guardar la direccion de un cliente en laa BD
    function guardar()
    {
        include 'dbConn.inc';
        //Crear la direccion de un cliente
        $sql = "INSERT INTO direccion (fkCliente, calle, colonia, numeroExterior, numeroInterior,
                ciudad, codigoPostal, referencia) "
            ."VALUES ("
            .$this->fkCliente.",'"
            .$this->calle."','"
            .$this->colonia."','"
            .$this->numeroExterior."','"
            .$this->numeroInterior."','"
            .$this->ciudad."','"
            .$this->codigoPostal."','"
            .$this->referencia."')";
        $res = mysqli_query($conexion, $sql);
        $filasAfectadas = mysqli_affected_rows($conexion);
        //Si no se creo el arreglo floral, salir
        if ($filasAfectadas != 1) {
            return false;
        }
        //Recupera el ID de la direccion actual
        $result = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT LAST_INSERT_ID() as idDireccion"));
        $this->idDireccion = $result["idDireccion"];
        mysqli_close($conexion);
        return true;
    }
    //Actualiza este arreglo floral en la BD
    //Regresa false sino se pudo hacer, true si fue exitoso
    function actualizar()
    {
        //incluir la configuracion a la BD
        include 'dbConn.inc';
        $sql = "UPDATE direccion SET "
            ."calle='".$this->calle."',"
            ."colonia='".$this->colonia."',"
            ."numeroExterior='".$this->numeroExterior."',"
            ."numeroInterior='".$this->numeroInterior."',"
            ."ciudad='".$this->ciudad."',"
            ."codigoPostal='".$this->codigoPostal."',"
            ."referencia='".$this->referencia."' "
            ." WHERE idDireccion=".$this->idDireccion;
        $res = mysqli_query($conexion, $sql);
        //Si no se hizo la query salir
        if (!$res) {
            return false;
        }
        mysqli_close($conexion);
        return true;
    }


}

?>
