<?php
class ProfilModel{

    private $databaze;

    public function __construct($databaze) {
        $this->databaze = $databaze;
    }

    public function aktualizovatProfil($jmeno, $prijmeni, $prezdivka, $trida) {
        $jmeno = htmlspecialchars(trim($_POST["jmeno"]));
        $prijmeni = htmlspecialchars(trim($_POST["prijmeni"]));
        $prezdivka = htmlspecialchars(trim($_POST["prezdivka"]));
        $trida = htmlspecialchars(trim($_POST["trida"]));
    
        if (!empty($_POST["heslo"])) {
            $heslo = htmlspecialchars($_POST["heslo"]);
            $hashedHeslo = password_hash($heslo, PASSWORD_DEFAULT);
            $stmt = $this->databaze->prepare("UPDATE uzivatele SET jmeno=?, prijmeni=?, prezdivka=?, heslo=?, trida=? WHERE id=?");
            $stmt->bind_param("sssssi", $jmeno, $prijmeni, $prezdivka, $hashedHeslo, $trida, $_SESSION['idUzivatele']);
        } else {
          
            $stmt = $this->databaze->prepare("UPDATE uzivatele SET jmeno=?, prijmeni=?, prezdivka=?, trida=? WHERE id=?");
            $stmt->bind_param("ssssi", $jmeno, $prijmeni, $prezdivka, $trida, $_SESSION['idUzivatele']);
        }
        
        if ($stmt->execute()) {
            $_SESSION["zpravy"]["uspech"] = "Profil byl úspěšně aktualizován.";
        } else {
            $_SESSION["zpravy"]["chyba"] = "Nepodařilo se aktualizovat profil.";
        }
        $stmt->close();
    }

    public function ziskatInfoUzivatele($id){
        return  Db::dotazJeden("SELECT u.*, t.Trida AS nazev_tridy, r.role AS nazev_role 
                                FROM uzivatele u
                                INNER JOIN tridy t ON u.trida = t.Id
                                INNER JOIN role r ON u.role = r.role
                                WHERE u.Id = ?", [ $id ]);
    }
}

