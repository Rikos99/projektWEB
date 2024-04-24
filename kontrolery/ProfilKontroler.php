<?php
session_start();

class ProfilKontroler {
    private $databaze;

    public function __construct($databaze) {
        $this->databaze = $databaze;
    }

    public function zobrazitFormular() {
        include_once("profil.phtml");
    }

    public function aktualizovatProfil() {
        $jmeno = htmlspecialchars(trim($_POST["jmeno"]));
        $prijmeni = htmlspecialchars(trim($_POST["prijmeni"]));
        $prezdivka = htmlspecialchars(trim($_POST["prezdivka"]));
        $heslo = htmlspecialchars($_POST["heslo"]);
        $role = htmlspecialchars($_POST["role"]);
        $trida = htmlspecialchars(trim($_POST["trida"]));

        if (empty($jmeno) || empty($prijmeni) || empty($prezdivka) || empty($heslo) || empty($role) || empty($trida)) {
            $_SESSION["zpravy"]["chyba"] = "Všechna pole jsou povinná.";
            return;
        }

        $idUzivatele = $_SESSION['idUzivatele'];

        $stmt = $this->databaze->prepare("UPDATE uzivatele SET jmeno=?, prijmeni=?, prezdivka=?, heslo=?, role=?, trida=? WHERE id=?");
        $hashedHeslo = password_hash($heslo, PASSWORD_DEFAULT);
        $stmt->bind_param("sssssii", $jmeno, $prijmeni, $prezdivka, $hashedHeslo, $role, $trida, $idUzivatele);
        
        if ($stmt->execute()) {
            $_SESSION["zpravy"]["uspech"] = "Profil byl úspěšně aktualizován.";
        } else {
            $_SESSION["zpravy"]["chyba"] = "Nepodařilo se aktualizovat profil.";
        }
        $stmt->close();
    }
}

$kontroler = new ProfilKontroler($databaze);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ulozit"])) {
    $kontroler->aktualizovatProfil();
} else {
    $kontroler->zobrazitFormular();
}
?>
