<?php
$formNome = $_POST['nome'];
$formEmail = $_POST['email'];
$formMsg = $_POST['msg'];

require_once('./phpMailer/PHPMailer.php');
require_once('./phpMailer/SMTP.php');
require_once('./phpMailer/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
	$mail->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'sistemabiometricotcc@gmail.com';
  //VERIFICAR SENHA
	$mail->Password = '';
	$mail->Port = 587;

	$mail->setFrom('sistemabiometricotcc@gmail.com');
	$mail->addAddress('sistemabiometricotcc@gmail.com');

	$mail->isHTML(true);
	$mail->Subject = $formNome.' | Contato via Website';
	$mail->Body = 'Mensagem de '.$formNome.' ('.$formEmail.'): '.$formMsg;
	$mail->AltBody = $formMsg;

	if($mail->send()) {
    header('Location:./index.html');
	} else {
		header('Location:./index.html?ErroEnviarEmail');
	}
} catch (Exception $e) {
	echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}
?>