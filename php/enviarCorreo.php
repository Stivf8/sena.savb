<?php

// Definimos las variables que nos llega desde php
require_once "conexion.php";
$mensaje='';
$mensajeElse='';
$titulo= htmlspecialchars($_POST['titulo'],ENT_QUOTES,'UTF-8');
$contenido= htmlspecialchars($_POST['contenido'],ENT_QUOTES,'UTF-8');
$img= htmlspecialchars($_POST['imagen'],ENT_QUOTES,'UTF-8');
$nombre="alvaro";
$correo= $conexion->query("SELECT Correo
FROM (
    /*SELECT correoSena_fun as Correo
    FROM funcionario
   WHERE correoSena_fun is not null
    
    UNION ALL 

    SELECT correoSena_voc as Correo
    FROM vocero
    WHERE correoSena_voc is not null
    
    UNION ALL*/
    
    SELECT correoSena_fun as Correo
    FROM funcionario
    WHERE correoSena_ins is not null
) correo
");

//Importamos la libreria  PHPMailer para enviar correos a los usuarios que se encuentran registrados en el aplicativo
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Aqui invocamos los archivos que nos ayudara para enviar correos
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

//Creamos una instacia
$mail = new PHPMailer(true);

try {

    //Configurar el servidor
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'alvarojosecabezas4@gmail.com';                     //SMTP username
    $mail->Password   = 'Ajcj1000689227ajcj';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('alvarojosecabezas4@gmail.com', 'SAVB'); 

    $result_registro= $correo->fetchAll(PDO::FETCH_ASSOC);
foreach ($result_registro as $dato) {
    $email= $dato['Correo'];

    $mail->addAddress($email, $nombre);   //Add a recipient
    

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $titulo;
    $mail->Body    = $contenido;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    $mensaje= 'Mensaje enviado';
    echo print_r($mensaje); 
    } catch (Exception $e) {
        $mensajeElse="Mensajo no enviado. Mailer Error: {$mail->ErrorInfo}";
        echo print_r($mensajeElse);
    }
}
?>