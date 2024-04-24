<?php

class KnihaKontroler extends Kontroler
{
    public function zpracuj($parametry)
    {

        $objektyModel = new ObjektyModel;

        $dotaz = Db::dotazJeden("SELECT Nazev FROM Knihy");
        $this->data["title"] = $dotaz["Nazev"]; //TODO název knihy místo "Kniha"

        if (
            isset($parametry[0]) &&
            is_numeric($parametry[0]) &&
            Db::dotaz("SELECT * FROM Knihy WHERE id = ?", [$parametry[0]]) > 0) {

            $this->data['jednaKniha'] = $objektyModel->knihaPodleId(intval($parametry[0]));
            $this->pohled = "kniha";
        } else {
            $this->presmeruj("knihy");
        }
    }
}