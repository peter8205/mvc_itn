<?php
mb_internal_encoding("UTF-8");

function autoloadFunkce($trida)
{
        /* Končí název třídy řetězcem "Kontroler" ? */
        if (preg_match('/Kontroler$/', $trida))
                require("kontrolery/" . $trida . ".php");
        else
                require("modely/" . $trida . ".php");
}

spl_autoload_register("autoloadFunkce");
// Připojení k databázi
Db::pripoj("127.0.0.1", "root", "", "mvc_db");
/* pridaj na koniec suboru */
$smerovac = new SmerovacKontroler();
$smerovac->zpracuj(array($_SERVER['REQUEST_URI']));
//http://www.domena.cz/clanek/nazev-clanku
$smerovac->vypisPohled();