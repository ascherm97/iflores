<?php
/**
 *Pedido
 */
class Pedido
{
   public $idPedido;
   public $precio;
   public $estatus;
   public $fechaPedido;
   public $fechaEntrega;
   public $idCliente;
   public $idArreglo;

   function __construct($fechaPedido, $fechaEntrega, $idCliente, $idArreglo)
   {
      $this->fechaPedido       = $fechaPedido;
      $this->fechaEntrega      = $fechaEntrega;
      $this->idCliente         = $idCliente;
      $this->idArreglo         = $idArreglo;
      $this->estatus           = 0;
   }
    //Inserta al cliente en la BD
    //Regresa false sino se pudo hacer, true si fue exitoso
    function guardar()
    {
        //incluir la configuracion a la BD
        include 'dbConn.inc';
        $sql = "INSERT INTO pedido(fkCliente, fkArreglo, precio,estatus,fechaPedido, fechaEntrega) "
            ."VALUES ("
            .$this->idCliente.","
            .$this->idArreglo.","
            .$this->precio.","
            .$this->estatus.",'"
            .$this->fechaPedido."','"
            .$this->fechaEntrega."')";
        $res = mysqli_query($conexion, $sql);
        $filasAfectadas = mysqli_affected_rows($conexion);
        //Si no se creo el pedido, salir
        if ($filasAfectadas != 1) {
            return false;
        }
        //Recuperar el ID del pedido recien creado
        $result = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT LAST_INSERT_ID() as idPedido"));
        $this->idPedido = $result["idPedido"];
        mysqli_close($conexion);
        //Registro creado exitosamente
        return true;
    }

   //Calcula el costo, que es igual a el precio del arreglo en el momento de la compra
   function calcularCosto()
   {
       //incluir la configuracion a la BD
       include 'dbConn.inc';
       //Obtener el precio del arreglo floral
       $sql = "SELECT precio FROM arreglofloral WHERE idArreglo=".$this->idArreglo;
       $res = mysqli_query($conexion, $sql);
        $filasAfectadas = mysqli_affected_rows($conexion);
       //Checar que si haya resultados
       if(!$res or $filasAfectadas!=1){
           echo json_encode(array('errorCode' => 400));
           return false;
       }
       $r = mysqli_fetch_assoc($res);
       //Checar que haya resultado
       if (!r) {
           echo json_encode(array('errorCode' => 500));
           return false;
       }
       $this->precio = $r["precio"];
       return true;

   }

}

?>
