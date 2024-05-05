<?php

class KnihyKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $this->cssCesty=["knihastyle.css"];

        $objektyModel = new ObjektyModel;

        $this->data['vsechnyKnihyFiltr'] =
            $objektyModel->vsechnyKnihyFiltr($objektyModel->arrayToAssociative($parametry));

        $this->data['vsichniAutori'] = $objektyModel->vsichniAutori();
        $this->data['vsechnyObdobi'] = $objektyModel->vsechnyObdobi();
        $this->data['vsechnyKnihy'] = $objektyModel->vsechnyKnihy();

        $this->pohled = "knihy";
        $this->data["title"] = "Knihy";

        $this->data['povinneKnihy'] = $objektyModel->povinneKnihyUzivatele($_SESSION['uzivatel']['Id']);
//        echo '<pre>';
//        print_r($this->data['povinneKnihy']);
//        echo '</pre>';

        if (isset($_POST['idKnihy'])){ // pridat mezi povinne knizky

            try {
                if ($_POST['type'] == "pridat_do_povinnych"){
                    $objektyModel->pridatDoPovinnych($_POST['idKnihy'], $_SESSION['uzivatel']['Id']);
                }
                else {
                    $objektyModel->odstranitZPovinnych($_POST['idKnihy'], $_SESSION['uzivatel']['Id']);
                }
                header("Refresh:0");
            }catch (PDOException $e){}

        }

    }
}