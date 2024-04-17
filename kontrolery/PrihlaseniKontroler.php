<?php
class PrihlaseniKontroler extends Kontroler {
    public function zpracuj($parametry) {

        $spravceUzivatelu = new SpravceUzivatelu;

        if(!empty($_POST)){

            if($spravceUzivatelu->prihlas($_POST)){
                //uspasne prihlaseni
                $this->presmeruj("uvod");
            }
            else{
                //chybne prihlaseni
                $this->presmeruj("prihlaseni");
            }

            //header( "Location: "."uspesnePrihlaseni" ); // presmerovat na hlavni stranku
        }
        else{
            $this->pohled = "prihlaseni";
        }


    }
}