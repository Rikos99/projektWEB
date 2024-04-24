<?php

class KnihyKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $objektyModel = new ObjektyModel;


        $this->data['vsechnyKnihy'] =
            $objektyModel->vsechnyKnihyFiltr($objektyModel->arrayToAssociative($parametry));

        $this->pohled = "knihy";
        $this->data["title"] = "Knihy";

    }
}