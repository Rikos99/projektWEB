<?php
abstract class Kontroler {
    protected $pohled = ""; // název souboru s pohledem (bez přípony .phtml)
    protected array $data = []; //pole pro data
    protected $prihlasenyUzivatel;
    protected array $cssCesty = ["style.css", "navstyle.css", "maintextstyle.css", "sidemainstyle.css"];

    public function __construct()
    {
        $spravceUzivatelu = new SpravceUzivatelu;
        $this->prihlasenyUzivatel = $spravceUzivatelu->vratPrihlasenehoUzivatele();
    }

    abstract public function zpracuj($parametry);

    public function vypisPohled() {
        extract($this->data);
        require "pohledy/{$this->pohled}.phtml";
    } 

    protected function presmeruj($url) 
    {
        header("Location: /$url");
        exit;
    }
}