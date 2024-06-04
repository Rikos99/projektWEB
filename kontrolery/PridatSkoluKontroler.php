<?php

class PridatSkoluKontroler extends Kontroler
{
    public function zpracuj($parametry)
    {
        $this->data["title"] = "Přidání školy";

        $skola = new NovaSkolaModel();
        $skola->pridatSkolu();

        $this->presmeruj("profil");
    }
}