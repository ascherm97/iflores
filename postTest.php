<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Testing</title>
   </head>
   <body>
      <?php
         header("Content-Type: text/html;charset=utf-8");
         include 'iflores.inc';
         $data = json_decode(file_get_contents('php://input'), true);
         echo json_encode($data);
         // $direccion = new Direccion('Circunvalación Norte','Satelite','32','6',
         //                            'Napoles','66723','Zaguan negro, con jardinera al frente.');
         // $cliente = new Cliente('Jose Montes Hernández','5512345678','someone@example.com', $direccion);
         //
         // echo json_encode($cliente);

       ?>

   </body>
</html>
