<?php

class ProfilModel{

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

    public function ziskatInfoUzivatele($id){
        //Db::dotazJeden()
        //vratit info o uzivateli

        return array("prijmeni" => "erfgberag");
    }

}


?>