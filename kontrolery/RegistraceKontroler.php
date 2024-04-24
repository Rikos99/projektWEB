<?php
class RegistraceKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $registraceModel = new RegistraceModel;
        $SpravceUzivatelu = new SpravceUzivatelu;

        $this->data["title"] = "Registrace";

        if(isset($_POST["jmeno"])){

            $regRes = $registraceModel->checkRegisterForm($SpravceUzivatelu);
            if ($regRes == -1) {
                $_SESSION["zpravy"]["registrace"]["chyba"] = "Hesla se neshoduji.";
                $this->presmeruj("registrace");
            } else if ($regRes == -2) {
                $_SESSION["zpravy"]["registrace"]["chyba"] = "Uzivatel s timto emailem jiz existuje.";
                $this->presmeruj("registrace");
            }
            unset($_SESSION["zpravy"]["registrace"]["chyba"]);
        }else

        if(isset($_POST["authCode"])){
            if($registraceModel->checkAuthForm()){ // uspesna registrace
                $SpravceUzivatelu->vytvoritUzivatele($_SESSION["prevPost"]);

                unset($_SESSION["authCode"]);
                unset($_SESSION["prevPost"]);
                unset($_SESSION["zpravy"]["registrace"]["chyba"]);

                $this->presmeruj("prihlaseni");
            }
            else{// neuspesna registrace
                $this->presmeruj("registrace");
                $_SESSION["zpravy"]["registrace"]["chyba"] = "Spatny autorizacni kod.";
            }
        }

        $this->pohled = "registrace";
    }
}