<?php

/*
 *	       __          __                __            
 *	  ____/ /__ _   __/ /_  ____  ____  / /__ _________
 *	 / __  / _ \ | / / __ \/ __ \/ __ \/ //_// ___/_  /
 *	/ /_/ /  __/ |/ / /_/ / /_/ / /_/ / ,< _/ /__  / /_
 *	\__,_/\___/|___/_.___/\____/\____/_/|_(_)___/ /___/
 *                                                   
 *                                                           
 *      TUTORI�LY  <>  DISKUZE  <>  KOMUNITA  <>  SOFTWARE
 * 
 *	Tento zdrojov� k�d je sou��st� tutori�l� na program�torsk� 
 *	soci�ln� s�ti WWW.DEVBOOK.CZ	
 *	
 *	K�d m��ete upravovat jak chcete, jen zmi�te odkaz 
 *	na www.devbook.cz :-) 
 */

// Controller pro zpracov�n� �l�nku

class ChybaKontroler extends Kontroler
{
    public function zpracuj($parametry)
    {
		// Hlavi�ka po�adavku
		header("HTTP/1.0 404 Not Found");
		// Hlavi�ka str�nky
		$this->hlavicka['titulek'] = 'Chyba 404';
		// Nastaven� �ablony
		$this->pohled = 'chyba';
    }
}