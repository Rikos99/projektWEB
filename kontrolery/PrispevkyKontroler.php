<?php

class PrispevkyKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $objektyModel = new ObjektyModel;

        $this->cssCesty=["style.css", "navstyle.css", "maintextstyle.css", "sidemainstyle.css"];
        $this->data["title"] = "Příspěvky";

        $this->data['vsechnyPrispevky'] =
            $objektyModel->vsechnyPrispevkyFiltr($objektyModel->arrayToAssociative($parametry));
        $this->pohled = "prispevky";

    }
}
