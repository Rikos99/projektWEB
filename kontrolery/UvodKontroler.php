<?php
class UvodKontroler extends Kontroler {
    public function zpracuj($parametry) {
        $this->pohled = "uvod";
        $this->cssCesty=["style/style.css", "style/navstyle.css", "style/maintextstyle.css", "style/sidemainstyle.css"];
    }
}