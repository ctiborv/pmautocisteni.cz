<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminGalerieKontroler
 *
 * @author ctibor
 */
class AdminGalerieKontroler extends Kontroler {
    
    //put your code here
    
    
      public function zpracuj($parametry) {
       
          $this->presmeruj('galerie/admin.php');
              	$spravceGalerie = new Galerie();
		
		// Je zadáno URL článku
		if (!empty($parametry[0]))
		{
			// Získání článku podle URL
			$galerie = $spravceGalerie->vratGalerii($parametry[0]);
			// Pokud nebyl článek s danou URL nalezen, přesměrujeme na ChybaKontroler
			if (!$galerie)
				$this->presmeruj('chyba');
		
			// Hlavička stránky
			$this->hlavicka = array(
				'titulek' => $galerie['titulek'],
				'klicova_slova' => $galerie['klicova_slova'],
				'popis' => $galerie['popisek'],
			);
			
			// Naplnění proměnných pro šablonu		
			$this->data['titulek'] = $galerie['titulek'];
			$this->data['obsah'] = $galerie['obsah'];
			
			// Nastavení šablony
			$this->pohled = 'galerie';
		}
		else
		// Není zadáno URL článku, vypíšeme všechny
		{
			$this->hlavicka = array(
				'titulek' => 'Galerie webu',
				'klicova_slova' => 'Fotogalerie',
				'popis' => 'Fotky webu PMAutocisteni.cz',
			);
			$galerie = $spravceGalerie->vratGalerie();

                        $this->data['galerie'] = $galerie;
			$this->pohled = 'admingalerie';
		}
            
      }
    
}
