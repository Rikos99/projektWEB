<?php

use PHPMailer\PHPMailer\Exception;
use phpMailer\PHPMailer\PHPMailer;


class PhpMailerModel
{

    private static PHPMailer $mailer;
    private static string $authenticationEmailUsername = "Knizky Autentikace";
    private static string $newsEmailUsername = "Knizky Novinky";

    static function initialize(): void {
        require(__DIR__ ."/../vendor/phpmailer/phpmailer/src/PHPMailer.php");
        require(__DIR__ ."/../vendor/phpmailer/phpmailer/src/SMTP.php");
        require(__DIR__ ."/../vendor/phpmailer/phpmailer/src/Exception.php");

        self::$mailer = new PHPMailer(true);

        self::$mailer->isSMTP();
        self::$mailer->SMTPAuth = true;

        self::$mailer->Host = "smtp.gmail.com";
        self::$mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        self::$mailer->Port = 587;
        self::$mailer->Username = "phpemiltest@gmail.com";

        $file = fopen( __DIR__ ."/../hesla/heslo.config", "r")  or die("Unable to open file!");
        self::$mailer->Password = fread($file, 19);
        fclose($file);
    }

    public static function sendAuthenticationEmail($sendTo): string
    {
        //try {self::isInitialized();}
        //catch (Exception $e) {self::sendAuthenticationEmail($e);}

        /// NASTAVENI EMAILU, KTERY POSILA
        try {
            self::$mailer->setFrom("phpemiltest@gmail.com", self::$authenticationEmailUsername);
            self::$mailer->addAddress($sendTo);
        } catch (Exception $e) {
            self::exceptionToFile($e);
        }


        /// GENEROVANI OVEROVACIHO KODU
        $str = "";
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        for ($i = 0; $i < 6; $i++) {
            $str = $str . $characters[random_int(0, $charactersLength - 1)];
        }

        /// NASTAVENI OBSAHU EMAILU

        self::$mailer->isHTML(true);
        self::$mailer->Subject = 'Autentikace';
        self::$mailer->Body = "Autentikacni kod je <b>$str</b>!";// html kod //potom dat jako soubor
        self::$mailer->AltBody = "Autentikacni kod je $str";// kdyz nefunguje html, tak plain text

        /// POSLANI EMAILU

        try {
            self::$mailer->send();
            self::$mailer->clearAllRecipients();
        } catch (Exception $e) {
            self::exceptionToFile($e);
        }



        return $str;
    }

    public static function sendNews($sendTo = array(), $obsahHTML, $obsahPlainText)
    {
        //try {self::isInitialized();}
        //catch (Exception $e) {self::sendAuthenticationEmail($e);}

        /// NASTAVENI EMAILU, KTERY POSILA
        try {
            self::$mailer->setFrom("phpemiltest@gmail.com", self::$newsEmailUsername);

            var_dump($sendTo);

            foreach ($sendTo as $oneEmail) {
                echo $oneEmail;
                self::$mailer->addAddress($oneEmail);
            }

        } catch (Exception $e) {
            self::exceptionToFile($e);
        }

        /// NASTAVENI OBSAHU EMAILU

        self::$mailer->isHTML(true);
        self::$mailer->Subject = 'Novinky';
        self::$mailer->Body = "<H2>NOVE</H2> <b>Novinky</b>!";// html kod //potom dat jako soubor
        self::$mailer->AltBody = "NOVE NOVINKY";// kdyz nefunguje html, tak plain text

        /// POSLANI EMAILU

        try {
            self::$mailer->send();
            self::$mailer->clearAllRecipients();
        } catch (Exception $e) {
            echo $e;
        }

    }


    static public function isInitialized()
    {
        if (!isset($mailer)) {
            throw new Exception("Mailer is not initialized");
        }
    }

    static private function exceptionToFile(Exception $e)
    {
        $myfile = fopen(__DIR__."/../log/exception.log", "a");

        fwrite($myfile, date("Y-m-d H:i:s", time()) . " " . $e . "\n\n");

        fclose($myfile);
    }

}