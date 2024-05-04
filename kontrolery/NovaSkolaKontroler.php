<?php

class NovaSkolaKontroler extends Kontroler
{
    public function zpracuj($parametry)
    {
        //$this->cssCesty=[""];
        $this->data["title"] = "Nová škola";
        $this->pohled = "novaSkola";
        /*
        if()
        {

        }
        else
        {
            if(!$this->prihlasenyUzivatel)
            {
                $this->presmeruj("prihlaseni");
            }
            else
            {
                $this->pohled = "novaSkola";
            }
        }
        */
    }
}