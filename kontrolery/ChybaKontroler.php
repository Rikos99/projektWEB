<?php
class ChybaKontroler extends Kontroler {
    public function zpracuj($parametry) {
        $this->pohled = "chyba";
        $this->data["pozadovanaStranka"] = $parametry[0];
        $this->cssCesty=["style.css", "navstyle.css", "maintextstyle.css", "sidemainstyle.css"];
        $this->data["title"] = "Chyba";
    }
}