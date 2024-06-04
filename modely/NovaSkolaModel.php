<?php
require_once("modely/Db.php");
class NovaSkolaModel
{

    public function pridatSkolu()
    {
        if(isset($_COOKIE["nazev"]))
        {
            echo "načtena cookie";
            setcookie("nazev", "", time()-3600);

            //kontrola, zda IČO existuje

            //SELECT 1 FROM skoly WHERE ICO = '00000000';

            $parametry = array(
                "Nazev" => $_COOKIE["nazev"],
                "ICO" => $_COOKIE["ico"]
            );
            $sql = "SELECT 1 FROM skoly WHERE ICO = " . $parametry["ICO"];

            if(Db::dotazJeden($sql)["1"] != 1)
            {
                Db::vloz("skoly", $parametry);
            }


        }
        else
        {
            if(!$this->prihlasenyUzivatel) //nefunguje
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