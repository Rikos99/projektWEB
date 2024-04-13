<?php

class KnihyModel
{

    public function knihaPodleId($idKniha){
        $sql = "SELECT * FROM knihy WHERE id=?";
        return Db::dotazJeden($sql, [$idKniha]);
    }

    public function vsechnyKnihy(){
        $sql = "SELECT * FROM knihy";
        return Db::dotazVsechny($sql);
    }


}