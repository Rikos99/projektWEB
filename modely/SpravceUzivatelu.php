<?php

class SpravceUzivatelu
{

    public function prihlas($prihlasovaciUdaje) {

        $sql = "SELECT * FROM uzivatele WHERE email = ? AND heslo = ?";

        $uzivatel = Db::dotazJeden($sql,[
            $prihlasovaciUdaje['email'],
            $this->vratHashHesla($prihlasovaciUdaje['heslo'])
        ]);

        if ($uzivatel) {
            $_SESSION["uzivatel"] = $uzivatel;
            return 1;
        }
        return 0;

    }
    public function odhlas() {

        if ($this->vratPrihlasenehoUzivatele()) {
            unset($_SESSION["uzivatel"]);
            return 1;
        }
        return 0;

    }
    public function vratPrihlasenehoUzivatele() {

        if (isset($_SESSION["uzivatel"]))
            return $_SESSION["uzivatel"];
        else
            return false;

    }

    public function vratVsechnyUzivatele() {

        return Db::dotazVsechny("SELECT email FROM uzivatele",[]);
    }

    public function vytvoritUzivatele($udajeNovehoUzivatele) {

        Db::vloz("uzivatele",[
            "jmeno" => $udajeNovehoUzivatele["jmeno"],
            "prijmeni" => $udajeNovehoUzivatele["prijmeni"],
            "email" => $udajeNovehoUzivatele["email"],
            "heslo" => $this->vratHashHesla($udajeNovehoUzivatele["heslo"])
        ]);
    }


    private function vratHashHesla($heslo) {

        return hash("sha256", $heslo);
    }




}