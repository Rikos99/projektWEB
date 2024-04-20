<?php

class PrispevkyKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $objektyModel = new ObjektyModel;

        $this->data['vsechnyPrispevky'] =
            $objektyModel->vsechnyPrispevkyFiltr($objektyModel->arrayToAssociative($parametry));
        $this->pohled = "prispevky";

    }
}
