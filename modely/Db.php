<?php
require_once('config.php');

class Db {

    private static $spojeni;

    // Připojí se k databázi pomocí daných údajů
    public static function pripoj($server, $uzivatel, $heslo, $databaze) {
        try {
            if (!isset(self::$spojeni)) {
                // Vytvoření PDO objektu pro přístup k databázi
                self::$spojeni = new PDO(
                    "mysql:host=$server;dbname=$databaze;charset=utf8",
                    $uzivatel,
                    $heslo,
                    array(
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    )
                );
            }
        } catch (PDOException $e) {
            // Pokud nastane chyba, vypíše se chybové hlášení
            die("Chyba při připojení k databázi: " . $e->getMessage());
        }
        return self::$spojeni;
    }
    
    // Spustí dotaz a vrátí z něj první řádek
    public static function dotazJeden($dotaz, $parametry = array()) {
        $navrat = self::$spojeni->prepare($dotaz);
        $navrat->execute($parametry);
        return $navrat->fetch();
    }

    // Spustí dotaz a vrátí všechny jeho řádky jako pole asociativních polí
    public static function dotazVsechny($dotaz, $parametry = array()) {
        $navrat = self::$spojeni->prepare($dotaz);
        $navrat->execute($parametry);
        return $navrat->fetchAll();
    }

    // Spustí dotaz a vrátí počet ovlivněných řádků
    public static function dotaz($dotaz, $parametry = array()) {
        $navrat = self::$spojeni->prepare($dotaz);
        $navrat->execute($parametry);
        return $navrat->rowCount();
    }

    // Vloží do tabulky nový řádek jako data z asociativního pole
    public static function vloz($tabulka, $parametry = array()) {
        return self::dotaz("INSERT INTO $tabulka (".
            implode(', ', array_keys($parametry)).
            ") VALUES (".str_repeat('?,', count($parametry)-1)."?)",
            array_values($parametry));
    }

    // Změní řádek v tabulce tak, aby obsahoval data z asociativního pole
    public static function zmen($tabulka, $hodnoty = array(), $podminka, $parametry = array()) {
        return self::dotaz("UPDATE $tabulka SET ".
            implode(' = ?, ', array_keys($hodnoty)).
            " = ? " . $podminka,
            array_merge(array_values($hodnoty), $parametry));
    }
    
    // Vrací ID posledně vloženého záznamu
    public static function idPoslednihoVlozeneho()
    {
        return self::$spojeni->lastInsertId();
    }
}
?>
