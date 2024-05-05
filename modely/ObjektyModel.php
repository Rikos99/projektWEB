<?php

class ObjektyModel
{
    private $vysledkyProPrispevek;
    private $vysledkyProKnihu;
    private $vysledkyProAutora;
    private $vysledkyProObdobi;
    private $vysledkyProUzivatele;


    public function __construct(){
        $this->vysledkyProPrispevek = array(
            'prispevky.id' => 'idPrispevku',
            'prispevky.nazev' => 'nazevPrispevku',
            'prispevky.obsah' => 'obsahPrispevku',
            'prispevky.typ' => 'typPrispevku',
        );

        $this->vysledkyProKnihu = array(
            'knihy.id' => 'idKniha',
            'knihy.nazev' => 'nazevKniha'
            );
        $this->vysledkyProAutora = array(

            'autori.id' => 'idAutora',
            'autori.jmeno' => 'jmenoAutora',
            'autori.prijmeni' => 'prijmeniAutora'
        );
        $this->vysledkyProObdobi = array(
            'obdobi.id' => 'idObdobi',
            'obdobi.nazev' => 'nazevObdobi',
        );
        $this->vysledkyProUzivatele = array(

            'uzivatele.id' => 'idUzivatele',
            'uzivatele.jmeno' => 'jmenoUzivatele',
            'uzivatele.prijmeni' => 'prijmeniUzivatele'
        );
    }

    function formatovatAliasy(array $polePoli): string {
        $formattedStrings = [];

        foreach ($polePoli as $pole) {
            foreach ($pole as $key => $value) {
                $parts = explode('.', $key);
                $column = end($parts);
                $formattedStrings[] = "$key AS '$value'";
            }
        }

        return implode(', ', $formattedStrings);
    }

    public function knihaPodleId($idKniha){
        $sql = "
            SELECT ".
            $this->formatovatAliasy(
                [$this->vysledkyProKnihu, $this->vysledkyProAutora]
            ).
            " FROM knihy
            LEFT JOIN autori ON autori.id = knihy.autor
            WHERE knihy.id=?
            ";
        return Db::dotazJeden($sql, [$idKniha]);
    }

    public function vsechnyKnihy(){
        $sql = "
            SELECT ".
            $this->formatovatAliasy(
                [$this->vysledkyProKnihu, $this->vysledkyProAutora, $this->vysledkyProObdobi]
            ).
            " FROM knihy
            LEFT JOIN autori ON autori.id = knihy.autor
            LEFT JOIN obdobi ON knihy.Obdobi = obdobi.id
            ";
        return Db::dotazVsechny($sql);
    }

    public function vsechnyKnihyFiltr($parametry){
        $sql = "
            SELECT ".
            $this->formatovatAliasy(
                [$this->vysledkyProKnihu, $this->vysledkyProAutora, $this->vysledkyProObdobi]
            ).
            " FROM knihy
            LEFT JOIN autori ON autori.id = knihy.autor
            LEFT JOIN obdobi ON knihy.Obdobi = obdobi.id
            ";
        if (empty($parametry)){ // KDYZ NEJSOU PARAMETRY, TAK VSECHNY KNIHY
            unset($_SESSION["zpravy"]["knihy"]);
            return Db::dotazVsechny($sql);
        }

        // ID KNIHY
        if (isset($parametry['kniha']) && is_numeric($parametry['kniha'])) {
            $sql .= " WHERE knihy.id =".$parametry['kniha'];
        }
        // ID AUTORA
        if (isset($parametry['autor']) && is_numeric($parametry['autor'])) {
            $sql .= " WHERE autori.id =".$parametry['autor'];
        }
        if (isset($parametry['obdobi']) && is_numeric($parametry['obdobi'])) {
            $sql .= " WHERE obdobi.id =".$parametry['obdobi'];
        }
        if (isset($parametry['uzivatel']) && is_numeric($parametry['uzivatel'])) {
            $sql .= " WHERE uzivatele.id =".$parametry['uzivatel'];
        }

        if(empty(Db::dotazVsechny($sql))){ // JESTLIZE NEJSOU KNIHY S FILTREM
            $_SESSION["zpravy"]["knihy"]["chybaNacteni"] = "Nenalezeny žádné knihy s temito parametry";
            return [];
        }
        unset($_SESSION["zpravy"]["knihy"]);
        return Db::dotazVsechny($sql); // VRAT VSECHNY KNIHY S FILTREM
    }

    public function prispevekPodleId($idPrispevku){
        $sql = "
                    SELECT ".
                    $this->formatovatAliasy(
                        [$this->vysledkyProPrispevek, $this->vysledkyProKnihu, $this->vysledkyProAutora, $this->vysledkyProObdobi, $this->vysledkyProUzivatele]
                    ).

                    "FROM prispevky 
                    
                    LEFT JOIN knihy ON knihy.id = prispevky.knihaID
                    LEFT JOIN autori ON autori.id = knihy.Autor
                    LEFT JOIN obdobi ON obdobi.id = knihy.Obdobi
                    
                    LEFT JOIN uzivatele ON uzivatele.id = prispevky.uzivatelID
                    WHERE prispevky.id=?";
        return Db::dotazJeden($sql, [$idPrispevku]);
    }

    public function vsechnyPrispevky (){
        $sql = "
            SELECT ".
            $this->formatovatAliasy(
                [$this->vysledkyProPrispevek, $this->vysledkyProKnihu, $this->vysledkyProAutora, $this->vysledkyProObdobi, $this->vysledkyProUzivatele]
            ).

            "FROM prispevky 
                    
                    LEFT JOIN knihy ON knihy.id = prispevky.knihaID
                    LEFT JOIN autori ON autori.id = knihy.Autor
                    LEFT JOIN obdobi ON obdobi.id = knihy.Obdobi
                    
                    LEFT JOIN uzivatele ON uzivatele.id = prispevky.uzivatelID";
        return Db::dotazVsechny($sql);
    }
    public function vsechnyPrispevkyFiltr ($parametry){
        $sql = "
            SELECT ".
            $this->formatovatAliasy(
                [$this->vysledkyProPrispevek, $this->vysledkyProKnihu, $this->vysledkyProAutora, $this->vysledkyProObdobi, $this->vysledkyProUzivatele]
            ).

            "FROM prispevky 
                    
            LEFT JOIN knihy ON knihy.id = prispevky.knihaID
            LEFT JOIN autori ON autori.id = knihy.Autor
            LEFT JOIN obdobi ON obdobi.id = knihy.Obdobi
            
            LEFT JOIN uzivatele ON uzivatele.id = prispevky.uzivatelID";

        if (empty($parametry)){ // KDYZ NEJSOU PARAMETRY, TAK VSECHNY PRISPEVKY
            unset($_SESSION["zpravy"]["prispevky"]);
            return Db::dotazVsechny($sql);
        }

        // ID KNIHY
        if (isset($parametry['kniha']) && is_numeric($parametry['kniha'])) {
            $sql .= " WHERE knihy.id =".$parametry['kniha'];
        }
        // ID AUTORA
        if (isset($parametry['autor']) && is_numeric($parametry['autor'])) {
            $sql .= " WHERE autori.id =".$parametry['autor'];
        }
        if (isset($parametry['obdobi']) && is_numeric($parametry['obdobi'])) {
            $sql .= " WHERE obdobi.id =".$parametry['obdobi'];
        }
        if (isset($parametry['uzivatel']) && is_numeric($parametry['uzivatel'])) {
            $sql .= " WHERE uzivatele.id =".$parametry['uzivatel'];
        }

        if(empty(Db::dotazVsechny($sql))){ // JESTLIZE NEJSOU PRISPEVKY S FILTREM
            $_SESSION["zpravy"]["prispevky"]["chybaNacteni"] = "Nenalezeny žádné příspevky s temito parametry";
            return [];
        }
        unset($_SESSION["zpravy"]["prispevky"]);
        return Db::dotazVsechny($sql); // VRAT VSECHNY PRISPEVKY S FILTREM
    }

    public function vsichniAutoriFiltr($parametry){
        $sql = "
            SELECT ".
            $this->formatovatAliasy(
                [$this->vysledkyProAutora]
            ).
            " FROM autori
            ";
        if (empty($parametry)){ // KDYZ NEJSOU PARAMETRY, TAK VSECHNY KNIHY
            unset($_SESSION["zpravy"]["knihy"]);
            return Db::dotazVsechny($sql);
        }

        // ID AUTORA
        if (isset($parametry['autor']) && is_numeric($parametry['autor'])) {
            $sql .= " WHERE autori.id =".$parametry['autor'];
        }
        if(empty(Db::dotazVsechny($sql))){ // JESTLIZE NEJSOU KNIHY S FILTREM
            $_SESSION["zpravy"]["autori"]["chybaNacteni"] = "Nenalezeny žádné knihy s temito parametry";
            return [];
        }
        unset($_SESSION["zpravy"]["autori"]);
        return Db::dotazVsechny($sql); // VRAT VSECHNY KNIHY S FILTREM
    }

    public function vsichniAutori()
    {
        $sql = 'SELECT * FROM autori';
        return Db::dotazVsechny($sql);
    }

    public function vsechnyObdobi()
    {
        $sql = 'SELECT * FROM obdobi';
        return Db::dotazVsechny($sql);
    }

    public function pridatDoPovinnych($idKnihy, $idUzivatale)
    {
        return Db::vloz("knihauzivatel", ["knihaId" => $idKnihy, "uzivatelId" => $idUzivatale, "povinna" => 1]);

    }

    public function odstranitZPovinnych($idKnihy, $idUzivatale){
        $sql = "DELETE FROM knihauzivatel WHERE knihaId = ? AND uzivatelId = ?";
        return Db::dotaz($sql, [$idKnihy, $idUzivatale]);
    }

    public function povinneKnihyUzivatele($idUzivatele)
    {
        $sql = 'SELECT * FROM knihauzivatel WHERE uzivatelId = ? AND povinna = 1';
        return Db::dotazVsechny($sql, [$idUzivatele]);
    }



    public function arrayToAssociative($array) {
        $assocArray = array();

        for ($i = 0; $i < count($array); $i += 2) {
            if (isset($array[$i + 1])) {
                $key = $array[$i];
                $value = $array[$i + 1];
                $assocArray[$key] = $value;
            }
        }

        return $assocArray;
    }

    public function pridatKviz($teloKvizu)
    {
        Db::vloz("prispevky",[

        ]);
    }


}