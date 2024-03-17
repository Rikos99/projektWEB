<?php
class ChybaKontroler extends Kontroler {
    public function zpracuj($parametry) {
        $this->pohled = "chyba";
        $this->data["pozadovanaStranka"] = $parametry[0];
    }
}