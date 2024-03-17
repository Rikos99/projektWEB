<?php
class SmerovacKontroler extends Kontroler {
  protected $kontroler; // objekt kontroleru
  
  // podle URL ($parametry[0]) "předané z indexu" 
    // nalezne správný kontroler a předá mu řízení 
  public function zpracuj($parametry) {
     $url = $parametry[0];
     $castiCesty = $this->parsujURL($url);
     if (empty($castiCesty[0])) {
        // přesměrujeme na výchozí kontroler
        $this->presmeruj("uvod");
     }
     else { // v URL je neprázdná cesta (tedy určen kontroler)      
          // ["uzivatel", "10", "editace"]    // $castiCesty
          $castNazvuKontroleru = array_shift($castiCesty); // vrátí první prvek a ostatní prvky posune na začátek
          $nazevKontroleru = $this->pomlckyDoVelbloudiNotace($castNazvuKontroleru)
                              . "Kontroler";

          if (file_exists("kontrolery/$nazevKontroleru.php")) {

            $this->kontroler = new $nazevKontroleru;
            $this->kontroler->zpracuj($castiCesty);

            $this->pohled = "rozlozeni";

          } else { // třída kontroleru neexistuje
            // přesměrujeme na chybový kontroler
            $this->presmeruj("chyba/$castNazvuKontroleru");
          }                             
     } 
  }
  
  // z editace-studenta udělá EditaceStudenta
  private function pomlckyDoVelbloudiNotace($text) {
      $text = str_replace("-", " ", $text);
      $text = ucwords($text);
      $text = str_replace(" ", "", $text);
      return $text;
  }
  
  // z https://localhost/uzivatel/10/editace 
  // udělá pole
  // ["uzivatel", "10", "editace"]
  private function parsujURL($url) {
      $naparsovanaURL = parse_url($url);
      $cesta = $naparsovanaURL["path"];
      
      $cesta = ltrim($cesta, "/"); // odebere počáteční lomítko
      $cesta = trim($cesta); // odebere bílé znaky
      
      $rozdelenaCesta = explode("/", $cesta);
      
      return $rozdelenaCesta;
  }
}

?>