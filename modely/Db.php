<?php
class Db {

    /* Databázové spojení */
    private static $spojeni;

    /* Výchozí nastavení ovladače */
    private static $nastaveni = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false,
    );

    /* Připojí se k databázi pomocí daných údajů */
    public static function pripoj($host, $uzivatel, $heslo, $databaze) {
        if (!isset(self::$spojeni)) {
            self::$spojeni = @new PDO(
                "mysql:host=$host;dbname=$databaze",
                $uzivatel,
                $heslo,
                self::$nastaveni
            );
        }
    }

    /* Spustí dotaz a vrátí z něj první řádek */
    public static function dotazJeden($dotaz, $parametry = array()) {
        $navrat = self::$spojeni->prepare($dotaz);
        $navrat->execute($parametry);
        return $navrat->fetch();
    }

    /* Spustí dotaz a vrátí všechny jeho řádky jako pole asociativních polí */
    public static function dotazVsechny($dotaz, $parametry = array()) {
        $navrat = self::$spojeni->prepare($dotaz);
        $navrat->execute($parametry);
        return $navrat->fetchAll();
    }

    /* Spustí dotaz a vrátí z něj první sloupec prvního řádku */
    public static function dotazSamotny($dotaz, $parametry = array()) {
        $vysledek = self::dotazJeden($dotaz, $parametry);
        return $vysledek[0];
    }

    /* Spustí dotaz a vrátí počet ovlivněných řádků */
    public static function dotaz($dotaz, $parametry = array()) {
        $navrat = self::$spojeni->prepare($dotaz);
        $navrat->execute($parametry);
        return $navrat->rowCount();
    }

}