<?php
/*	Primero hay que incluir la clase PHPMailer para poder instanciar
		 	un objeto de la misma. */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/*	Ruta donde se encuentra la clase PHPMailer. */

/**********************************************************************/
/********* CAMBIAR POR LA RUTA EN LA QUE ESTÉ EN TU ORDENADOR *********/
/**********************************************************************/
require BASE_URL . '/app/helpers/phpmailer/PHPMailer.php';
require BASE_URL . '/app/helpers/phpmailer/Exception.php';
require BASE_URL . '/app/helpers/phpmailer/SMTP.php';

/*	Creamos el objeto PHPMailer y lo llamamos, por ejemplo, mail. */
$mail = new PHPMailer;
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';

$mail->IsSMTP(); // habilita SMTP
$mail->SMTPDebug = 0; // 0, para que no salga todo el debug en el formulario una vez lo enviemos
$mail->SMTPAuth = true; // auth habilitada
$mail->SMTPSecure = 'ssl'; // transferencia segura REQUERIDA para Gmail
$mail->Host = "smtp.gmail.com"; // SMTP de Gmail
$mail->Port = 465;
$mail->IsHTML(true);

/* Email y contraseña que usaremos para enviar los mensajes */
$mail->Username = "iesjdhdaw2@gmail.com";
$mail->Password = "12345iesjdh";

/* Esta parte no funciona con Gmail por un bloqueo de Gmail contra el pishing, spam, etc.
Habría que poner una dirección fija diferente a la que utilizaremos desde la configuracicón
de GMAIL, en realidad, esta línea sobra. */
$mail->SetFrom("example@gmail.com");

/* Ponemos un asunto al mensaje (podríamos poner de asunto la información recibida en por POST 
			desde nuestro formulario, pero he preferido hacerlo de esta manera). */
$mail->Subject = "Práctica PHPMailer Pablo Herranz Cano";

/* Aquí va el cuerpo del mensaje, en él irá toda la información de contacto de la persona que nos
			contacta, y el mensaje en sí. */
$mail->Body =
	"<b><u>Nombre</u></b>" . ":   " . $_POST['name']  . "<br>" .
	"<b><u>Email de contacto</u></b>" . ":   " . $_POST['email'] .	"<br>" .
	"<b><u>Mensaje</u></b>" . ":   " . "<br>" .
	$_POST['mensaje'];

/**********************************************************/
/********* DIRECCIÓN A LA QUE ENVIAR LOS MENSAJES *********/
/**********************************************************/
$mail->AddAddress("pablo.herranzcano@iesjuandeherrera.net");

/* Mensajes de error o éxito */
if (!$mail->Send()) {
	echo "Ha habido un error:" . $mail->ErrorInfo;
} else {
	echo "<h3 style='text-align: center;'>Hemos recibido tu mensaje.</h3>";
}
/* Mensajes de error o éxito */
if (isset($_POST['contact-btn']) && !$mail->Send()) {
	$_SESSION['message'] = "Ha habido un error: " . $mail->ErrorInfo;
	$_SESSION['type'] = 'error';
} else if (isset($_POST['contact-btn']) && $mail->Send()) {
	$_SESSION['message'] = "Hemos recibido tu mensaje";
	$_SESSION['type'] = 'success';
}
