<?php

// Router je speciální typ controlleru, který podle URL adresy zavolá
// správný controller a jím vytvořený pohled vloží do šablony stránky

class SmerovacKontroler extends Kontroler
{
	// Instance controlleru
	protected $kontroler;
	
	// Metoda převede pomlčkovou variantu controlleru na název třídy
	private function pomlckyDoVelbloudiNotace($text) 
	{
		$veta = str_replace('-', ' ', $text);
		$veta = ucwords($veta);
		$veta = str_replace(' ', '', $veta);
		return $veta;
	}
	
	// Naparsuje URL adresu podle lomítek a vrátí pole parametrů
	private function parsujURL($url)
	{
		// Naparsuje jednotlivé části URL adresy do asociativního pole
                $naparsovanaURL = parse_url($url);
		// Odstranění počátečního lomítka
		$naparsovanaURL["path"] = ltrim($naparsovanaURL["path"], "/");
		// Odstranění bílých znaků kolem adresy
		$naparsovanaURL["path"] = trim($naparsovanaURL["path"]);
		// Rozbití řetězce podle lomítek
		$rozdelenaCesta = explode("/", $naparsovanaURL["path"]);
		return $rozdelenaCesta;
	}

    // Naparsování URL adresy a vytvoření příslušného controlleru
    public function zpracuj($parametry)
    {
		$naparsovanaURL = $this->parsujURL($parametry[0]);
				
		if (empty($naparsovanaURL[0]))		
                    if ($_SESSION['admin']==1) {
                           $tridaKontroleru = 'AdminNastaveniKontroler';
                    }
                    else $tridaKontroleru = 'ClanekKontroler';
		// kontroler je 1. parametr URL
                else {
                    $tridaKontroleru = $this->pomlckyDoVelbloudiNotace(array_shift($naparsovanaURL)) . 'Kontroler';
                }
		if (file_exists('kontrolery/' . $tridaKontroleru . '.php'))
			$this->kontroler = new $tridaKontroleru;
		else
			$this->presmeruj('chyba');
		
		// Volání controlleru
                
        
        $this->kontroler->zpracuj($naparsovanaURL);

                $nastaveniModel = new NastaveniWeb();
                $nastaveniData = $nastaveniModel->vratNastaveni();

		// Nastavení proměnných pro šablonu

      		$this->data['titulek'] = $nastaveniData['title'].$this->kontroler->hlavicka['titulek'];
		$this->data['popis'] = $nastaveniData['description'].$this->kontroler->hlavicka['popis'];
		$this->data['klicova_slova'] = $nastaveniData['keywords'].$this->kontroler->hlavicka['klicova_slova'];
		$this->data['slidery'] = $this->kontroler->hlavicka['slidery'];
                
                $this->data['clanky']=$clanky;
                $this->neodata['footer'] = $nastaveniData['footer'];
                $this->neodata['copyright'] = $nastaveniData['copyright'];

                $menuKontroler =  new MenuKontroler();
                
                $this->data['menus']= $menuKontroler->zpracujMenu($parametry) ;

                // Nastavení hlavní šablony
		$this->pohled = 'rozlozeni';
    }

}