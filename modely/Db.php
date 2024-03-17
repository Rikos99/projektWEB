<?php
// Wrapper pro snadnější práci s databází s použitím PDO a automatickým
// zabezpečením parametrů (proměnných) v dotazech.
class Db {

	// Databázové spojení
  private static $spojeni;

	// Výchozí nastavení ovladače
  private static $nastaveni = array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_EMULATE_PREPARES => false,
	);

	// Připojí se k databázi pomocí daných údajů
  public static function pripoj($server, $uzivatel, $heslo, $databaze)
  {
	  if (!isset(self::$spojeni)) 
      {
        $dsn = "mysql:host=$server;dbname=$databaze;charset=utf8";
			 self::$spojeni = new PDO(
				$dsn,
				$uzivatel,
				$heslo,
				self::$nastaveni
			 );
	  }
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
	
	// Spustí dotaz a vrátí z něj první sloupec prvního řádku
  public static function dotazSamotny($dotaz, $parametry = array()) {
		$vysledek = self::dotazJeden($dotaz, $parametry);
		return $vysledek[0];
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
		") VALUES (".str_repeat('?,', sizeOf($parametry)-1)."?)",
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