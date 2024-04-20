<?php

class KnihyKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $objektyModel = new ObjektyModel;

        $this->cssCesty=["style.css", "navstyle.css", "maintextstyle.css", "sidemainstyle.css"];

        $this->data['vsechnyKnihy'] =
            $objektyModel->vsechnyKnihyFiltr($objektyModel->arrayToAssociative($parametry));

        $this->pohled = "knihy";

    }
}