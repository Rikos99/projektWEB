<?php

class NovaSkolaModel
{

    public function pridatSkolu()
    {
        if(isset($_COOKIE["nazev"]))
        {
            echo "načtena cookie";
            setcookie("nazev", "", time()-3600);
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
    }

}