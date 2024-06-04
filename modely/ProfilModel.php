<?php
require_once("modely/Db.php");

class ProfilModel {
    private $databaze;

    public function __construct($databaze) {
        $this->databaze = $databaze;
    }

    public function aktualizovatProfil($jmeno, $prijmeni, $prezdivka, $trida, $idUzivatele) {
        $update = [];
        $params = [];
        
        //pokud parametr neni nulovy = update
        if($jmeno !== null) {
            $update[] = "jmeno = ?";
            $params[] = $jmeno;
        }
        if($prijmeni !== null) {
            $update[] = "prijmeni = ?";
            $params[] = $prijmeni;
        }
        if($prezdivka !== null) {
            $update[] = "prezdivka = ?";
            $params[] = $prezdivka;
        }
        if($trida !== null) {
            $update[] = "trida = ?";
            $params[] = $trida;
        }
        
        if (empty($update)) {
            $_SESSION["zpravy"]["chyba"] = "Není nic k aktualizaci.";
            return;
        }
    
        $params[] = $idUzivatele;
        
        $sql = "UPDATE uzivatele SET " . implode(", ", $update) . " WHERE Id = ?";
        
        $stmt = $this->databaze->prepare($sql);
        $stmt->execute($params);
        
        if ($stmt->rowCount() > 0) {
            $_SESSION["zpravy"]["uspech"] = "Profil byl úspěšně aktualizován.";
        } else {
            $_SESSION["zpravy"]["chyba"] = "Nepodařilo se aktualizovat profil.";
        }
    }
    
    public function nahratProfilovyObrazek($fileTmpPath, $fileName, $idUzivatele) {
        $uploadDir = 'obrazky/';
        $dest_path = $uploadDir . $fileName;
    
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $this->aktualizovatProfilovouFotku($dest_path, $idUzivatele);
            return true;
        } else {
            return false;
        }
    }

    private function aktualizovatProfilovouFotku($fileDestPath, $idUzivatele) {
        // Aktualizace cesty k profilovce
        $sql = "UPDATE uzivatele SET ikona = ? WHERE Id = ?";
        $stmt = $this->databaze->prepare($sql);
        $stmt->execute([$fileDestPath, $idUzivatele]);
        
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function aktualizovatHeslo($heslo, $idUzivatele) {
        $hashedPassword = hash("sha256", $heslo);
        $sql = "UPDATE uzivatele SET heslo = ? WHERE Id = ?";
        $stmt = $this->databaze->prepare($sql);
        $stmt->execute([$hashedPassword, $idUzivatele]);
        
        //detekovani zda byla provedena zmena v databazi
        return $stmt->rowCount() > 0;
    }
    
    
    public function ziskatInfoUzivatele($id) {
        return Db::dotazJeden("SELECT u.*, t.Trida AS nazev_tridy, r.role AS nazev_role 
                                FROM uzivatele u
                                INNER JOIN tridy t ON u.trida = t.Id
                                INNER JOIN role r ON u.role = r.role
                                WHERE u.Id = ?", [$id]);
    }
}
?>
