<?php

/*
 *	       __          __                __            
 *	  ____/ /__ _   __/ /_  ____  ____  / /__ _________
 *	 / __  / _ \ | / / __ \/ __ \/ __ \/ //_// ___/_  /
 *	/ /_/ /  __/ |/ / /_/ / /_/ / /_/ / ,< _/ /__  / /_
 *	\__,_/\___/|___/_.___/\____/\____/_/|_(_)___/ /___/
 *                                                   
 *                                                           
 *      TUTORIÁLY  <>  DISKUZE  <>  KOMUNITA  <>  SOFTWARE
 * 
 *	Tento zdrojový kód je součástí tutoriálů na programátorské 
 *	sociální síti WWW.DEVBOOK.CZ	
 *	
 *	Kód můžete upravovat jak chcete, jen zmiňte odkaz 
 *	na www.devbook.cz :-) 
 */

// Controller pro výpis článků

class ClanekKontroler extends Kontroler
{
    public function zpracuj($parametry)
    {
		// Vytvoření instance modelu, který nám umožní pracovat s články
		$spravceClanku = new SpravceClanku();
		
		// Je zadáno URL článku
			// Získání článku podle URL
			$clanek = $spravceClanku->vratClanek($parametry[0]);
			// Pokud nebyl článek s danou URL nalezen, přesměrujeme na ChybaKontroler
			if (!$clanek)
			$clanek = $spravceClanku->vratClanek('uvod');
		
			// Hlavička stránky
			$this->hlavicka = array(
				'titulek' => $clanek['titulek'],
				'klicova_slova' => $clanek['klicova_slova'],
				'popis' => $clanek['popisek'],
                                
			);
			
			// Naplnění proměnných pro šablonu		
			$this->data['titulek'] = $clanek['titulek'];
			$this->data['obsah'] = $clanek['obsah'];
			if ($clanek['slider']){
                            
                            $sliderM = new Slider();
                            $slidery= $sliderM->vratSlidery();
                            $this->data['slidery']=$slidery;
                        }
			// Nastavení šablony
			$this->pohled = 'clanek';
    }
}