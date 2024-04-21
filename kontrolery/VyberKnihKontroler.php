<?php

class VyberKnihKontroler extends Kontroler {
    
    public function zpracuj($parametry) {
        $objektyModel = new ObjektyModel;
        $knihy = $objektyModel->vsechnyKnihy();
        $this->data["vsechny_knihy"] = $knihy;

        $this->pohled = "formular_knihy";
    }
}

?>
