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
        //nacteni uzivatele
        $this->prihlasenyUzivatel = $this->vratPrihlasenehoUzivatele();
    }



    public function zpracuj($parametry) {

        $this->cssCesty=["profil.css"];


        if (isset($_POST["ulozit_heslo"])) {
            //zmena hesla
            $noveHeslo = isset($_POST["nove_heslo"]) ? $_POST["nove_heslo"] : null;
            $potvrzeniHesla = isset($_POST["potvrzeni_hesla"]) ? $_POST["potvrzeni_hesla"] : null;

            if ($noveHeslo && $potvrzeniHesla && $noveHeslo === $potvrzeniHesla) {
                //kontrola ze bylo heslo spravne zadano
                if ($this->profilModel->aktualizovatHeslo($noveHeslo, $this->prihlasenyUzivatel['Id'])) {
                    $_SESSION["zpravy"]["uspech"] = "Heslo bylo úspěšně změněno.";
                } else {
                    $_SESSION["zpravy"]["chyba"] = "Nepodařilo se změnit heslo.";
                }
            } else {
                $_SESSION["zpravy"]["chyba"] = "Nová hesla se neshodují nebo nebyla zadána.";
            }
            $this->presmeruj("profil");
        }

        // nahrani obrazku
        if (isset($_POST["nahrat_obrazek"])) {
            $fileName = $_FILES['profilovka']['name'];
            $fileTmpPath = $_FILES['profilovka']['tmp_name'];

            if ($this->profilModel->nahratProfilovyObrazek($fileTmpPath, $fileName, $this->prihlasenyUzivatel['Id'])) {
                $_SESSION["zpravy"]["uspech"] = "Profilový obrázek byl úspěšně nahrán.";
            } else {
                $_SESSION["zpravy"]["chyba"] = "Nepodařilo se nahrát profilový obrázek.";
            }
            $this->presmeruj("profil");
        }

        //aktualizace profilu
        if (isset($_POST["ulozit"])) {
            $jmeno = isset($_POST["jmeno"]) ? $_POST["jmeno"] : null;
            $prijmeni = isset($_POST["prijmeni"]) ? $_POST["prijmeni"] : null;
            $prezdivka = isset($_POST["prezdivka"]) ? $_POST["prezdivka"] : null;
            $trida = isset($_POST["trida"]) ? $_POST["trida"] : null;

            $this->profilModel->aktualizovatProfil($jmeno, $prijmeni, $prezdivka, $trida, $this->prihlasenyUzivatel['Id']);
            $this->presmeruj("profil");
        }

        $data["infoProfilu"] = $this->profilModel->ziskatInfoUzivatele($this->prihlasenyUzivatel['Id']);

        //kontrola zda ma uzivatel profilovku
        $obrazekProfilu = isset($data["infoProfilu"]["ikona"]) ? $data["infoProfilu"]["ikona"] : '';

        $data["obrazekProfilu"] = htmlspecialchars($obrazekProfilu);

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
