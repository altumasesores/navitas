<?php
include("../phpmailer/class.phpmailer.php");
//include("../phpmailer/class.smtp.php");

  //instanciamos un objeto de la clase phpmailer al que llamamos 
  //por ejemplo mail
  //$mail = new phpmailer();
$to      = 'alumna_cohuop@hotmail.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: alumna_cohuop@hotmail.com';

mail($to, $subject, $message, $headers);
?>