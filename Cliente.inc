<?php
//Inportar la clase Direccion
include 'Direccion.inc';
/**
 *Cliente
 */
class Cliente
{
    public $idCliente;
    public $nombre;
    public $telefono;
    public $email;
    public $emailVerificado;
    public $direccion;
    public $token;
    public $tokenExpira;
    public $passwordHashed;

    function __construct($nombre, $telefono, $email, $password, $direccion)
    {
        $this->nombre             = $nombre;
        $this->telefono           = $telefono;
        $this->email              = $email;
        $this->emailVerificado    = 0;
        $this->passwordHashed     = password_hash($password, PASSWORD_DEFAULT);
        $this->direccion          = $direccion;
    }
    //Inserta al cliente en la BD
    //Regresa false sino se pudo hacer, true si fue exitoso
    function guardar()
    {
        //incluir la configuracion a la BD
        include 'dbConn.inc';
        $sql = "INSERT INTO cliente(nombre, telefono, email, passwordHashed) "
            ."VALUES ('"
            .$this->nombre."','"
            .$this->telefono."','"
            .$this->email."','"
            .$this->passwordHashed."')";
        $res = mysqli_query($conexion, $sql);
        $filasAfectadas = mysqli_affected_rows($conexion);
        //Si no se creo el arreglo floral, salir
        if ($filasAfectadas != 1) {
            return false;
        }
        $result = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT LAST_INSERT_ID() as idCliente"));
        $this->idCliente = $result["idCliente"];
        $this->direccion->fkCliente = $this->idCliente;
        mysqli_close($conexion);
        //Ya que se registro el cliente falta guardar su direccion
        return $this->direccion->guardar();
    }

}
?>
