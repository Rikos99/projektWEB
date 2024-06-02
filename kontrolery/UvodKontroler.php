<?php
class UvodKontroler extends Kontroler {
    public function zpracuj($parametry) {
        $this->pohled = "uvod";
        $this->data["title"] = "Úvod";
        $this->data["jmeno"] = (!empty($_SESSION['uzivatel']))?$_SESSION['uzivatel']['jmeno']:'Nikdo neni prihlaseny'; //['Jmeno'] // ['jmeno']
    }
}
?>
