<?php

class AutorKontroler extends Kontroler
{
    public function zpracuj($parametry)
{

    $objektyModel = new ObjektyModel;

    if(
        isset($parametry[0]) &&
        is_numeric($parametry[0]) &&
        Db::dotaz("SELECT * FROM autori WHERE id = ?", [$parametry[0]]) > 0){

        $this->data['autor'] = Db::dotazJeden("SELECT * FROM autori WHERE id = ?", [$parametry[0]]);

        $this->pohled = "autor";}
    else{
        $this->presmeruj("autori");
    }

}
}