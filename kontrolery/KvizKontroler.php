<?php

class KvizKontroler extends Kontroler {
    public function zpracuj($parametry)
    {

        $this->cssCesty=["kvizsingleStyle.css"];

        $objektyModel = new ObjektyModel;


        if (
            isset($parametry[0]) &&
            is_numeric($parametry[0]) &&
            Db::dotaz("SELECT * FROM Kvizy WHERE id = ?", [$parametry[0]]) > 0) {

            $this->data["kviz"] = $objektyModel->kvizPodleId($parametry[0], false);

            if (!empty($_POST)) {
                echo '<pre>';
                print_r(json_decode($this->data["kviz"]['SpravneOdpovedi']));
                echo '</pre>';
                echo '<pre>';
                print_r($_POST);
                echo '</pre>';

                $spravne = json_decode($this->data["kviz"]['SpravneOdpovedi']);

                print_r($spravne);

                foreach ($spravne as $key => $value) {
                    echo $key;
                }

            }

            $this->pohled = "kviz";
        } else {
            $this->presmeruj("kvizy");
        }
    }
}