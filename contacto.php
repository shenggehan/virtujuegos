<?php session_start(); ?>

<?php

$name=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message'];


$to='alebrega@gmail.com';

$headers = 'From: '.$name."\r\n" .
	'Reply-To: '.$email."\r\n" .
	'X-Mailer: PHP/' . phpversion();
$subject = 'Mensaje desde VirtuJuegos';
$body='Usted tiene un nuevo mensaje desde el formulario de contacto en su sitio web VirtuJuegos.'."\n\n";

$body.='Nombre: '.$name."\n";
$body.='Email: '.$email."\n";
$body.='Mensaje: '."\n".$message."\n";
	



include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';

$securimage = new Securimage();

if ($securimage->check($_POST['captcha_code']) == false) {
  // the code was incorrect
  // you should handle the error so that the form processor doesn't continue

  // or you can use the following code if there is no validation or you do not know how
  echo "El codigo de seguridad ingresado es incorrecto. Por favor ingrese un nuevo codigo correcto<br /><br />";
  echo "<meta http-equiv='refresh' content='2;URL=http://virtujuegos.net/page/contacto-44'>"; 
  exit;
} else { if(mail($to, $subject, $body, $headers)) {
	echo('Mensaje enviado. Gracias le responderemos en brevedad.');
	echo "<meta http-equiv='refresh' content='2;URL=http://virtujuegos.net/page/contacto-44'>"; 
} else {
	echo('Error: fallo de envio por parte del servidor, por favor intente de nuevo');
	echo "<meta http-equiv='refresh' content='2;URL=http://virtujuegos.net/page/contacto-44'>"; 
}
 }
?>
