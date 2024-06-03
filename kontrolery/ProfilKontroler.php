<?php

require_once("modely/Db.php");
require_once("modely/ProfilModel.php");
require_once("modely/config.php");

class ProfilKontroler extends Kontroler {
    private $profilModel;
    protected $prihlasenyUzivatel;

    public function __construct() {
        parent::__construct();
        $this->profilModel = new ProfilModel(Db::pripoj(DB_SERVER, DB_UZIVATEL, DB_HESLO, DB_NAME));
        $this->prihlasenyUzivatel = $this->vratPrihlasenehoUzivatele();
    }

    public function zpracuj($parametry){

        $this->cssCesty=["profilstyle.css"];

        if(isset($_POST["ulozit"])){
            $jmeno = isset($_POST["jmeno"]) ? $_POST["jmeno"] : "";
            $prijmeni = isset($_POST["prijmeni"]) ? $_POST["prijmeni"] : "";
            $trida = isset($_POST["trida"]) ? $_POST["trida"] : "";
            $prezdivka = isset($_POST["prezdivka"]) ? $_POST["prezdivka"] : ""; // Přidána kontrola na existenci prezdivky
    
    
            // Aktualizace údajů v databázi
            $this->profilModel->aktualizovatProfil($jmeno, $prijmeni, $prezdivka, $trida); // Předávání správných argumentů
            $_SESSION["zpravy"]["uspech"] = "Údaje byly úspěšně aktualizovány.";
        } elseif(isset($_POST["ulozit_heslo"])) {
            $heslo = isset($_POST["heslo"]) ? $_POST["heslo"] : "";
            $heslo2 = isset($_POST["heslo2"]) ? $_POST["heslo2"] : "";


            // Aktualizace hesla 
            if($heslo === $heslo2) {
                $this->profilModel->zmenitHeslo($heslo, $this->prihlasenyUzivatel['Id']);
                $_SESSION["zpravy"]["uspech"] = "Heslo bylo úspěšně změněno.";
            } else {
                $_SESSION["zpravy"]["chyba"] = "Hesla se neshodují.";
            }
        }
 
        $data["infoProfilu"] = $this->profilModel->ziskatInfoUzivatele($this->prihlasenyUzivatel['Id']);
    
        $this->pohled = "profil";
        $this->data = $data;
    }

    protected function vratPrihlasenehoUzivatele() {
        if (isset($_SESSION["uzivatel"])) {
            return $_SESSION["uzivatel"];
        } else {
            return false;
        }
    }
}

?>
