<?php
class PrihlaseniKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $prihlaseniModel = new prihlaseniModel;

        if(isset($_POST["email"])){
            $prihlaseniModel->checkPrihlaseniForm();
        }

        $this->pohled = "prihlaseni";
    }
}