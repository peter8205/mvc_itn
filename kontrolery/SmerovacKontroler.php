<?php
class SmerovacKontroler extends Kontroler
{
	protected $kontroler;
	
	private function pomlckyDoVelbloudiNotace($text) 
	{
		$veta = str_replace('-', ' ', $text);
		$veta = ucwords($veta);
		$veta = str_replace(' ', '', $veta);
		return $veta;
	}
	
	private function parsujURL($url)
	{
        $naparsovanaURL = parse_url($url);  /*[path] => /clanek/nazev-clanku/dalsi-parametr */
		$naparsovanaURL["path"] = ltrim($naparsovanaURL["path"], "/"); /* odstrani /*/
		$naparsovanaURL["path"] = trim($naparsovanaURL["path"]); /* odstrani medzeri*/
		$rozdelenaCesta = explode("/", $naparsovanaURL["path"]); /*pole o 3. prvkoch */
		return $rozdelenaCesta;
	}

    public function zpracuj($parametry)
    {
		$naparsovanaURL = $this->parsujURL($parametry[0]);/* [0] => /clanek/nazev-clanku/dalsi-parametr */
		$tridaKontroleru = $this->pomlckyDoVelbloudiNotace(array_shift($naparsovanaURL)) . 'Kontroler';
		echo($tridaKontroleru); /*ClanekKontroler*/
		
		echo('<br />');
		print_r($naparsovanaURL); /*Array ( [0] => nazev-clanku [1] => dalsi-parametr ) */
    }

}