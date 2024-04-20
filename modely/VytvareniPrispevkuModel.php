<?php

class VytvareniPrispevkuModel
{

    public function prispevekDoDatabaze(): void{
        Db::vloz("prispevky", [
            "Nazev" => $_POST["nazevPrispevku"],
            "Obsah" => $_POST["textareaContentJakoHtml"],
            "Typ" => $_POST["typPrispevku"],
            "knihaId" => $_POST["vyberKnizky"],
            "uzivatelId" => $_SESSION["uzivatel"]["Id"]]);

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