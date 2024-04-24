<?php
class UvodKontroler extends Kontroler {
    public function zpracuj($parametry) {
        $this->pohled = "uvod";
        $this->data["title"] = "Úvod";
    }
}