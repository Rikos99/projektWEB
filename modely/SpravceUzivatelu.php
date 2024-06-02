<?php

class SpravceUzivatelu
{
    public function prihlas($prihlasovaciUdaje) {
        require_once("modely/Db.php");

        $sql = "SELECT * FROM uzivatele WHERE email = ?";
        
        $db = new Db();
        $uzivatel = Db::dotazJeden($sql, [$prihlasovaciUdaje['email']]);

        if ($uzivatel && $this->overHeslo($prihlasovaciUdaje['heslo'], $uzivatel['heslo'])) {
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
        return Db::dotazVsechny("SELECT email FROM uzivatele", []);
    }

    public function vytvoritUzivatele($udajeNovehoUzivatele) {
        Db::vloz("uzivatele", [
            "jmeno" => $udajeNovehoUzivatele["jmeno"],
            "prijmeni" => $udajeNovehoUzivatele["prijmeni"],
            "email" => $udajeNovehoUzivatele["email"],
            "heslo" => $this->vratHashHesla($udajeNovehoUzivatele["heslo"])
        ]);
    }

    public function aktualizovatHeslo($heslo, $idUzivatele) {
        $hashedPassword = $this->vratHashHesla($heslo);
        $sql = "UPDATE uzivatele SET heslo = ? WHERE Id = ?";
        $stmt = Db::dotaz($sql, [$hashedPassword, $idUzivatele]);
        
        return $stmt->rowCount() > 0;
    }

    private function vratHashHesla($heslo) {
        return hash("sha256", $heslo);
    }

    private function overHeslo($heslo, $hashedHeslo) {
        return hash("sha256", $heslo) === $hashedHeslo;
    }



}
?>
