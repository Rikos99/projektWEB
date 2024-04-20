<?php

class UzivatelKontroler extends Kontroler
{
    public function zpracuj($parametry)
    {

        $objektyModel = new ObjektyModel;

        if(
            isset($parametry[0]) &&
            is_numeric($parametry[0]) &&
            Db::dotaz("SELECT * FROM uzivatele WHERE id = ?", [$parametry[0]]) > 0){

            $this->data['uzivatel'] = Db::dotazJeden("SELECT * FROM uzivatele WHERE id = ?", [$parametry[0]]);
            unset($_SESSION["zpravy"]["uzivatel"]["chybaNacteni"]);
        }
        else{
            $_SESSION["zpravy"]["uzivatel"]["chybaNacteni"] = "Takovy uzivatel neexistuje";
        }
        $this->pohled = "uzivatel";
    }
}