<?php

class KvizyKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $this->cssCesty=["knihastyle.css"];

        $objektyModel = new ObjektyModel;


        $this->data['vsechnyKvizy'] = $objektyModel->vsechnyKvizy();
        $this->pohled = "kvizy";

    }
}