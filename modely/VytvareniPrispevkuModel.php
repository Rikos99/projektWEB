<?php

class VytvareniPrispevkuModel
{

    public function prispevekDoDatabaze(): void{

        Db::vloz("prispevky", [
            "nazev" => $_POST["nazevPrispevku"],
            "typ" => $_POST["typPrispevku"],
            "obsah" => $_POST["textareaContentJakoHtml"],
            "knihaID" => $_POST["vyberKnizky"],
            "autorID" => $_SESSION["uzivatel"]["id"] ]);
    }

    public function prispevekDoSouboru(): void {
        $myfile = fopen("debugVtvareniPrispevku.txt", "w") or die("Unable to open file!");

        /*if (!isset($_POST["nazevPrispevku"]) || !isset($_POST["typPrispevku"]) || !isset($_POST["textareaContentJakoHtml"])) {
            echo "Formular nenacten";
        }*/
        foreach ($_POST as $key => $value) {
            fwrite($myfile, $key . " : " . $value . "\n");
        }
        fwrite($myfile,"end");
        fclose($myfile);
    }

}