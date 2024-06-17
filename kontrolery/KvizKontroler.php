<?php

class KvizKontroler extends Kontroler {
    public function zpracuj($parametry)
    {

        $objektyModel = new ObjektyModel;

        if (!empty($_POST)) {
            print_r($_POST);
        }

        if (
            isset($parametry[0]) &&
            is_numeric($parametry[0]) &&
            Db::dotaz("SELECT * FROM Kvizy WHERE id = ?", [$parametry[0]]) > 0) {

            $this->data["kviz"] = $objektyModel->kvizPodleId($parametry[0], false);

            $this->pohled = "kviz";
        } else {
            $this->presmeruj("kvizy");
        }
    }
}