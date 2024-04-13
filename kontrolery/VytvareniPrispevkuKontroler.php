<?php

class VytvareniPrispevkuKontroler extends Kontroler
{
    public function zpracuj($parametry) {

        $vytvareniPrispevkuModel = new VytvareniPrispevkuModel;

        $knihyModel = new KnihyModel;

        if( isset($parametry[0]) && $parametry[0] == "kniha" && isset($parametry[1]) && is_numeric($parametry[1])) {
            $predurcenaKniha = $knihyModel->knihaPodleId(intval($parametry[1]));
            $this->data['predurcenaKnihaString'] = $predurcenaKniha["nazev"] . " - " . $predurcenaKniha["autor"];
            $this->data['predurcenaKnihaId'] = $parametry[1];
        }

        if (!isset($this->data['predurcenaKnihaString'])){
            $this->data['vsechnyKnihy'] = $knihyModel->vsechnyKnihy();
        }

        // Poslani prispevku do databaze (formular)
        if (isset($_POST["nazevPrispevku"])) {
            $vytvareniPrispevkuModel->prispevekDoDatabaze();
        }

        $this->pohled = "vytvareniPrispevku";
    }

}