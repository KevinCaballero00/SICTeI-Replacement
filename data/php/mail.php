<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $number = htmlspecialchars($_POST['number']);
        $subject = htmlspecialchars($_POST['subject']);
        $message = htmlspecialchars($_POST['message']);

        // Validar los datos (opcional, pero recomendado)
        if (empty($name) || empty($email) || empty($message) || empty($subject)) {
            echo "Todos los campos son obligatorios.";
            exit;
        }
        
        //Server settings
        $mail->SMTPDebug = 0 ;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'SICTeI@ufps.edu.co';                     //SMTP username
        $mail->Password   = 'blhtyzurbugkqxfq';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    }



    //Recipients}
    //$to = "SICTeI@ufps.edu.co"; // Reemplaza con tu dirección de correo
    $mail->setFrom('SICTeI@ufps.edu.co', 'SICTeI');
    $mail->addAddress('SICTeI@ufps.edu.co');     //Add a recipient
    $mail->addAddress("$email");     //Add a recipient
    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject ="Duda sobre SICTeI: $subject";
    $mail->Body =   "Has recibido un nuevo mensaje de contacto. <br><br>" .
                    "Nombre: $name <br>" .
                    "Correo Electrónico: $email <br>" .
                    "Número de Teléfono: $number <br>" .
                    "Asunto: $subject <br>" .
                    "Mensaje: $message <br>";

    $mail->send();
    echo 'Mensaje enviado con éxito.';
} catch (Exception $e) {
    echo "No se pudo enviar el mensaje: {$mail->ErrorInfo}";
}