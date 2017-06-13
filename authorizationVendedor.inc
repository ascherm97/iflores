<?php

//Obtener el token de la peticion

include 'getToken.inc';
//Valida si un token es valido
//0 si el token no existe
//1 si el token ya expiro
//2 si el token no se pudo renovar
//3 si el token es valido
function hasAuthorization(){
    $token = getBearerToken();

    //Token vacio
    if (is_null($token)){
        return 0;
    }
    //incluir la configuracion a la BD
    include 'dbConn.inc';
    // Obtener cuando expira el token de la BD
    $sql = "SELECT tokenExpira FROM vendedor WHERE token='".$token."'";
    $res = mysqli_query($conexion, $sql);
    //Checar que haya resultados de la query
    if (!res) {
        return 0;
    }
    $result = mysqli_fetch_assoc($res);
    mysqli_close($conexion);

    //Checar si el token ya expiro
    if (time()> $result["tokenExpira"]) {
        return 1;
    }
    //incluir la configuracion a la BD
    include 'dbConn.inc';
    //Renovar el token por 5 min
    $sql = "UPDATE vendedor SET "
        ."tokenExpira=".(time()+5*60)." "
        ." WHERE token='".$token."'";
    $res = mysqli_query($conexion, $sql);
    //Salir si no se hizo la query
    if (!res) {
        return 2;
    }
    mysqli_close($conexion);

    //El token es valido
    return 3;
}
?>
