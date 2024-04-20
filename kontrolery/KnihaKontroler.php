<?php

class KnihaKontroler extends Kontroler
{
    public function zpracuj($parametry)
    {

        $objektyModel = new ObjektyModel;

        if (
            isset($parametry[0]) &&
            is_numeric($parametry[0]) &&
            Db::dotaz("SELECT * FROM Knihy WHERE id = ?", [$parametry[0]]) > 0) {

            $this->data['jedenaKniha'] = $objektyModel->knihaPodleId(intval($parametry[0]));
            $this->pohled = "kniha";
        } else {
            $this->presmeruj("knihy");
        }
    }
}