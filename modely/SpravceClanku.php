<?php

/* Třída poskytuje metody pro správu článků v redakčním systému */
class SpravceClanku
{

    /* Vrátí článek z databáze podle jeho URL */
    public function vratClanek($url)
    {
        return Db::dotazJeden('
            SELECT `clanky_id`, `titulek`, `obsah`, `url`, `popisek`, `klicova_slova`
            FROM `clanky`
            WHERE `url` = ?
        ', array($url));
    }

    /* Vrátí seznam článků v databázi */
    public function vratClanky()
    {
        return Db::dotazVsechny('
            SELECT `clanky_id`, `titulek`, `url`, `popisek`
            FROM `clanky`
            ORDER BY `clanky_id` DESC
        ');
    }

}