<?php

class VytvareniKvizuKontroler extends Kontroler
{
    public function zpracuj($parametry) {

        $this->data["title"] = "Vytvareni Kvizu";

        $objektyModel = new ObjektyModel();

        if (isset($_POST['teloKvizu'])) {
            echo '<pre>';
            echo htmlspecialchars(print_r($_POST, true));
            echo '</pre>';

            //$objektyModel->pridatKviz($_POST['teloKvizu']);
        }

        $this->data['vsechnyKnihy'] = $objektyModel->vsechnyKnihy();

        $this->pohled = "vytvareniKvizu";
    }
}