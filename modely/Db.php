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

// Wrapper pro snadnější práci s databází s použitím PDO a automatickýmail
// zabezpečením parametrů (proměnných) v dotazech.

class Db {

	// Databázové spojení
    private static $spojeni;

	// Výchozí nastavení ovladače
    private static $nastaveni = array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
		PDO::ATTR_EMULATE_PREPARES => false,
	);

	// Připojí se k databázi pomocí daných údajů
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

    public static function prikazUpdatePOST($dotaz, $par = array(),$where = array()) {
        try {
            $carka="";
            foreach ($par as $key=>$value) {

                if ($key!='Ulozit') {
                    $set .= "$carka$key=?";
                    $params[]=$value;
                    $carka = ",";
                }
            }
            $dotaz = str_replace('SET', "SET $set", $dotaz);

            $carka="";
            $set="";
            foreach ($where as $key=>$value) {
                    $set .= "$carka$key=?";
                    $params[]=$value;
                    $carka = ",";
            }
            $dotaz = str_replace('WHERE', "WHERE $set", $dotaz);
            
            //connect as appropriate as above
            $navrat = self::$spojeni->prepare($dotaz);
            $navrat->execute($params);
            return $navrat->rowCount();
            
        } catch(PDOException $ex) {
            echo "An Error occured!".$ex->getMessage();
            die($dotaz);
        }        
	}
        
        
    public static function prikazJeden($dotaz, $parametry = array()) {
        try {
            //connect as appropriate as above
            $navrat = self::$spojeni->prepare($dotaz);
            $navrat->execute($parametry);
            return $navrat->rowCount();
            
        } catch(PDOException $ex) {
            echo "An Error occured!".$ex->getMessage();
            die($dotaz);
        }        
	}
        
	// Spustí dotaz a vrátí z něj první řádek
    public static function dotazJeden($dotaz, $parametry = array()) {
        try {
            //connect as appropriate as above
            $navrat = self::$spojeni->prepare($dotaz);
            $navrat->execute($parametry);
            return $navrat->fetch();
        } catch(PDOException $ex) {
            echo "An Error occured!".$ex->getMessage();
            die($dotaz);
        }        
	}

	// Spustí dotaz a vrátí všechny jeho řádky jako pole asociativních polí
    public static function dotazVsechny($dotaz, $parametry = array()) {
        try {
            //connect as appropriate as above
            $navrat = self::$spojeni->prepare($dotaz);
            $navrat->execute($parametry);
            return $navrat->fetchAll();
        } catch(PDOException $ex) {
            echo "An Error occured!".$ex->getMessage();
            die($dotaz);
        }        
	}
	
	// Spustí dotaz a vrátí z něj první sloupec prvního řádku
    public static function dotazSamotny($dotaz, $parametry = array()) {
		$vysledek = self::dotazJeden($dotaz, $parametry);
		return $vysledek[0];
	}
	
	// Spustí dotaz a vrátí počet ovlivněných řádků
	public static function dotaz($dotaz, $parametry = array()) {
        try {
            //connect as appropriate as above
            $navrat = self::$spojeni->prepare($dotaz);
            $navrat->execute($parametry);
            return $navrat->rowCount();
        } catch(PDOException $ex) {
            die("An Error occured!".$ex->getMessage());
        }        
	}

}