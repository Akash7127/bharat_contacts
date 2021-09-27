<?php
require 'class.phpmailer.php';
require 'class.smtp.php';
$mail = new PHPMailer();
try {
    //Server settings
    $mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 0;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	//$mail->Host = "smtp.gmail.com";
	$mail->Host = "mail.khodaldesign.com";
	$mail->Port = 465;
	$mail->IsHTML(true);
	$mail->Username = "info@khodaldesign.com";
	$mail->Password = "info@123";
	
	$mail->Subject = "Gau Seva";
	$mail->Body = "hi your account is actived.";
	
	//Recipients
    $mail->setFrom('info@khodaldesign.com', 'Mailer');
    $mail->addAddress('crghadiya@gmail.com', '');
    $mail->addReplyTo('info@khodaldesign.com', 'Information');
	
	//Attachments
    /* $mail->addAttachment('/var/tmp/file.tar.gz');
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); */

	$mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}