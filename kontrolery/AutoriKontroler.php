<?php

class AutoriKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $objektyModel = new ObjektyModel;

        $this->data['autori'] =
            $objektyModel->vsichniAutoriFiltr($objektyModel->arrayToAssociative($parametry));
        $this->pohled = "autori";
    }
}
