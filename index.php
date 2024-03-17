<?php
require "init.php";

$smerovac = new SmerovacKontroler();
$smerovac->zpracuj([$_SERVER["REQUEST_URI"]]);
$smerovac->vypisPohled();