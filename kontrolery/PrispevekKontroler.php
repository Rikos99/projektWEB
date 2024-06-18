<?php

class PrispevekKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $objektyModel = new ObjektyModel;

        $this->data["title"] = "Příspěvek";
        $this->cssCesty=["singlePrispevekStyle.css"];


        if(
            isset($parametry[0]) &&
            is_numeric($parametry[0]) &&
            Db::dotaz("SELECT * FROM prispevky WHERE id = ?", [$parametry[0]]) > 0){

                $this->data['jedenPrispevek'] = $objektyModel->prispevekPodleId(intval($parametry[0]));
                $this->pohled = "prispevek";
        }
        else{
            $this->presmeruj("prispevky");
        }
    }
}
