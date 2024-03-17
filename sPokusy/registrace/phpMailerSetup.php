<?php

/////// "STATICKE" PROMENNE NA TEXT
$jmenoOdesilatele = "Knizky support";
$adresaOdesilatele = "phpemiltest@gmail.com"; //jeste nechapu k cemu



// musi byt nahrano z souboru
require("PHPMailer-master\src\PHPMailer.php");
require("PHPMailer-master\src\SMTP.php");
require("PHPMailer-master\src\Exception.php");

use master\src\Exception;
use master\src\PHPMailer;
use master\src\SMTP;

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = "phpemiltest@gmail.com";
$mail->Password = "erkl hetx xqkl xsem";

//////DULEZITE
/*$mail->isHTML(true);
$mail->Subject = 'Subject';
$mail->Body    = 'HTML message body in <b>bold</b>!';
$mail->AltBody = 'Body in plain text for non-HTML mail clients';*/





try {
    $mail->setFrom("phpemiltest@gmail.com", "KnizkySupport");
    $mail->addAddress("ova.standa.janca@gmail.com");
} catch (Exception $e) {
    echo $e;
}


$mail->Subject = "subject";
$mail->Body = "thhtht";

try {
    $mail->send();

} catch (Exception $e) {
    echo $e;
}