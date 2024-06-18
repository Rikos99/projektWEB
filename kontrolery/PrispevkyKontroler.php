<?php

class PrispevkyKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $this->cssCesty=["prispevkyListStyle.css"];


        $objektyModel = new ObjektyModel;


        $this->data['vsechnyPrispevky'] =
            $objektyModel->vsechnyPrispevkyFiltr($objektyModel->arrayToAssociative($parametry));
        $this->pohled = "prispevky";
        $this->data["title"] = "Příspěvky";

    }
}
