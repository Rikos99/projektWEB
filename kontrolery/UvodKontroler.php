<?php
class UvodKontroler extends Kontroler {
    public function zpracuj($parametry) {
        $this->pohled = "uvod";
        $this->cssCesty=["style.css", "navstyle.css", "maintextstyle.css", "sidemainstyle.css"];
    }
}