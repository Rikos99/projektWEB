<?php

class prihlaseniModel
{
    public function checkPrihlaseniForm(){

        if($_POST["password"] == $this->getUserPassword($_POST["email"])){
            header( "Location: "."uspesnePrihlaseni" ); // presmerovat na hlavni stranku
        }
        else {
            // pridat counter na spatne pokusy (dat promennou do session jako array(zacatekBanu (datum/timestamp), delkaBanu))
            header( "Location: ".(empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."?chybnePrihlaseni" );

        }

    }

    private function getUserPassword(string $email)// z databaze vytahnout heslo od uzivatele s emailem v parametru funkce
    {
        return "pp";
    }
}