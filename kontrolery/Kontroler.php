<?php
abstract class Kontroler {
    protected $pohled = ""; // název souboru s pohledem (bez přípony .phtml)
    protected array $data = []; // pole pro data
    protected $prihlasenyUzivatel;
    protected array $cssCesty = [];

    // Konstruktor inicializuje přihlášeného uživatele a provádí příslušné kroky v závislosti na jeho stavu
    public function __construct()
    {
        $spravceUzivatelu = new SpravceUzivatelu;
        $this->prihlasenyUzivatel = $spravceUzivatelu->vratPrihlasenehoUzivatele();
        // Pokud je uživatel přihlášený, můžete prověřit, zda jsou v proměnné $prihlasenyUzivatel očekávaná data
        if (!$this->prihlasenyUzivatel) {
            // Uživatel není přihlášený nebo nebyla nalezena očekávaná data, můžete provést další kroky
        }
    }

    // Metoda zpracuj je abstraktní a musí být implementována potomky
    abstract public function zpracuj($parametry);

    // Metoda vypisPohled vypíše obsah pohledu
    public function vypisPohled() {
        extract($this->data);
        require "pohledy/{$this->pohled}.phtml";
    } 

    // Metoda presmeruj provede přesměrování na danou URL
    protected function presmeruj($url) 
    {
        header("Location: /$url");
        exit;
    }
}

?>