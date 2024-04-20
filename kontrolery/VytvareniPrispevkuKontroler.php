<?php

class VytvareniPrispevkuKontroler extends Kontroler
{
    public function zpracuj($parametry) {

        if($this->prihlasenyUzivatel)
        {
            unset($_SESSION["zpravy"]["prihlasovani"]["duvodPresmerovani"]);

            $vytvareniPrispevkuModel = new VytvareniPrispevkuModel;

            $objektyModel = new ObjektyModel;

            $this->cssCesty=["style.css", "navstyle.css", "maintextstyle.css", "sidemainstyle.css"];
            $this->data["title"] = "Nový Příspěvek";

            if(
                isset($parametry[0]) && $parametry[0] == "kniha" &&
                isset($parametry[1]) && is_numeric($parametry[1]) &&
                (Db::dotaz("SELECT * FROM knihy WHERE id=?", [$parametry[1]]) > 0)
            ) {
                $predurcenaKniha = $objektyModel->knihaPodleId(intval($parametry[1]));
                $this->data['predurcenaKnihaString'] = $predurcenaKniha["nazevKniha"] . " - " . $predurcenaKniha["jmenoAutora"] . " " . $predurcenaKniha["prijmeniAutora"];
                $this->data['predurcenaKnihaId'] = $parametry[1];
            }

            if (!isset($this->data['predurcenaKnihaString'])){
                $this->data['vsechnyKnihy'] = $objektyModel->vsechnyKnihy();
            }

            // Poslani prispevku do databaze (formular)
            if (isset($_POST["nazevPrispevku"])) {
                $vytvareniPrispevkuModel->prispevekDoDatabaze();
                $this->presmeruj("prispevky/uzivatel/". $_SESSION["uzivatel"]["Id"]);
            }

            $this->data['typyPrispevku'] = Db::dotazVsechny("SELECT * FROM typyprispevku;");

            $this->pohled = "vytvareniPrispevku";
        }
        else
        {
            $_SESSION["zpravy"]["prihlasovani"]["duvodPresmerovani"] = "Nejste přihlášen.";
            $this->presmeruj("prihlaseni");
        }
    }

}