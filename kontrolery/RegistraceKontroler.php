<?php
class RegistraceKontroler extends Kontroler {
    public function zpracuj($parametry) {

        //require("phpMailer\phpMailerController.php");

        $registraceModel = new RegistraceModel;

        if(isset($_POST["jmeno"])){
            $registraceModel->checkRegisterFom();
        }

        if(isset($_POST["authCode"])){
            $registraceModel->checkAuthFom();
        }

        $this->pohled = "registrace";
    }
}