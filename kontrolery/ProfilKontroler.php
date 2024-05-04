<?php

class ProfilKontroler extends Kontroler {
    public function zpracuj($parametry){

        $this->cssCesty=["profilstyle.css"];

        $profilModel = new ProfilModel();
        
        
        if(!empty($_POST)){
            $profilModel->aktualizovatprofil();   
             
        }
        $this->pohled = "profil";
        $this->data["title"] = "Profil";
        $this->data["infoProfilu"] = $profilModel->ziskatInfoUzivatele($_SESSION["uzivatel"]["Id"]);

    }

    
}
