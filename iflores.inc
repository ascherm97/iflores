<?php
/**
 *Cliente
 */
class Cliente
{
   public $nombre;
   public $telefono;
   public $email;
   public $emailVerificado;
   public $direccion;

   function __construct($nombre, $telefono, $email, $direccion)
   {
      $this->nombre             = $nombre;
      $this->telefono           = $telefono;
      $this->email              = $email;
      $this->emailVerificado    = false;
      $this->direccion          = $direccion;
   }

}
/**
 * Direccion
 */
class Direccion
{
   public $calle;
   public $colonia;
   public $numeroInterior;
   public $numeroExterior;
   public $ciudad;
   public $codigoPostal;
   public $referencia;

   function __construct($calle, $colonia, $numeroInterior, $numeroExterior,
                        $ciudad, $codigoPostal, $referencia)
   {
      $this->calle            = $calle;
      $this->colonia          = $colonia;
      $this->numeroInterior   = $numeroInterior;
      $this->numeroExterior   = $numeroExterior;
      $this->ciudad           = $ciudad;
      $this->codigoPostal     = $codigoPostal;
      $this->referencia       = $referencia;
   }

}

/**
 *Pedido
 */
class Pedido
{
   public $estatus;
   public $fechaPedido;
   public $fechaEntrega;
   public $costo;
   public $cliente;
   public $arregloFloral;

   function __construct($fechaPedido, $fechaEntrega, $costo, $cliente, $arregloFloral)
   {
      $this->estatus            = "Preparando pedido";
      $this->fechaPedido        = $fechaPedido;
      $this->fechaEntrega       = $fechaEntrega;
      $this->costo              = $costo;
      $this->cliente            = $cliente;
      $this->arregloFloral      = $arregloFloral;
   }

}
/**
 *
 */
class ArregloFloral
{
   public $nombre;
   public $descripcion;
   public $precio;
   public $disponibilidad;
   public $imagenes = array();

   function __construct($nombre, $descripcion, $precio, $disponibilidad, $imagen)
   {
      $this->nombre           = $nombre;
      $this->descripcion      = $descripcion;
      $this->precio           = $precio;
      $this->disponibilidad   = $disponibilidad;
      $this->imagenes         = add($imagen);
   }
}

/**
 *
 */
class Paquete extends ArregloFloral
{
   public $contenidoExtra;

   function __construct($nombre, $descripcion, $precio, $disponibilidad, $imagen, $contenidoExtra)
   {
      parent::__construct($nombre, $descripcion, $precio, $disponibilidad, $imagen);
      $this->contenidoExtra   =  $contenidoExtra;
   }
}


 ?>
