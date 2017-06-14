<?php
require 'PHPMailer/PHPMailerAutoload.php';
function sendSignUpMail($email, $nombre){
    $mail = new PHPMailer;


    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'iflores.escom@gmail.com';                 // SMTP username
    $mail->Password = 'password.iflores.MVV';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('iflores.escom@gmail.com', 'iFLores');
    $mail->addAddress($email, $nombre);     // Add a recipient

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Bienvenido a iFlores.esy.es';
    $mail->Body    ='El correo '.$email.' ha sido usado para registrarse en iflores.esy.es<br> bienvenido '.$nombres.'<br>'
        .'<h4>Desde este momento ya puedes comprar nuestros arreglos florales!</h4><br>'
        .'<h7>Si deseas editar tus datos lo pudes hacer desde Editar Datos en el menu despues de iniciar sesión.</h7><br>';
    $mail->AltBody = 'El correo '.$email.' ha sido usado para registrarse en iflores.esy.es, bienvenido '.$nombres;

    if(!$mail->send()) {
        return false;
        //echo 'Message could not be sent.';
        //echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        return true;
        //echo 'Message has been sent';
    }
}

?>
