<?php
abstract class Kontroler {
    protected $pohled = ""; // název souboru s pohledem (bez přípony .phtml)
    protected $data = []; //pole pro data

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