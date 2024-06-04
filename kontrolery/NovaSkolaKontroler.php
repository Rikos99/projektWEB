<?php

class NovaSkolaKontroler extends Kontroler
{
    public function zpracuj($parametry)
    {
        //$this->cssCesty=[""];
        $this->data["title"] = "Nová škola";
        $this->pohled = "novaSkola";
    }
}