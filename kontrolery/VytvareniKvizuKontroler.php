<?php

class VytvareniKvizuKontroler extends Kontroler
{
    public function zpracuj($parametry) {

        $this->data["title"] = "Vytvareni Kvizu";
        $this->cssCesty=["style.css", "kvizStyle.css", "navstyle.css"];

        $objektyModel = new ObjektyModel();

        if (isset($_POST['teloKvizu'])) {
            echo '<pre>';
            echo htmlspecialchars(print_r($_POST, true));
            echo '</pre>';

            $objektyModel->pridatKviz($_POST['nazevKvizu'],$_POST['kniha'],$_POST['teloKvizu'],json_decode($_POST['spravneOdpovedi'],true));
        }

        if(
            isset($parametry[0]) && $parametry[0] == "kniha" &&
            isset($parametry[1]) && is_numeric($parametry[1]) &&
            (Db::dotaz("SELECT * FROM knihy WHERE id=?", [$parametry[1]]) > 0)
        ) {
            $predurcenaKniha = $objektyModel->knihaPodleId(intval($parametry[1]));
            $this->data['predurcenaKnihaString'] = $predurcenaKniha["nazevKniha"] . " - " . $predurcenaKniha["jmenoAutora"] . " " . $predurcenaKniha["prijmeniAutora"];
            $this->data['predurcenaKnihaId'] = $parametry[1];
        }

        if (!isset($this->data['predurcenaKnihaString']) || empty($this->data['predurcenaKnihaString'])){
            $this->data['vsechnyKnihy'] = $objektyModel->vsechnyKnihy();
        }

        $this->pohled = "vytvareniKvizu";
    }
}