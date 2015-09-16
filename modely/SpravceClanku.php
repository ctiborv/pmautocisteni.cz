<?php

// Třída poskytuje metody pro správu článků v redakčním systému
class SpravceClanku
{
	
	// Vrátí článek z databáze podle jeho URL
	public function vratClanek($url)
	{
		return Db::dotazJeden('
			SELECT `clanky_id`, `titulek`, `obsah`, `url`, `popisek`, `klicova_slova`,`slider`,`poradi`
			FROM `clanky` 
			WHERE `url` = ?
		', array($url));
	}
        
        public function vymazClanek($id)
	{
		return Db::prikazJeden('
			DELETE FROM `clanky` 
                        WHERE clanky_id=?
		', array($id));
	}
        

        public function ulozClanek($url,$params)
	{
                $where = array('url'=>$url);
		return Db::prikazUpdatePOST('
			UPDATE `clanky`
                        SET
			WHERE 
		', $params,$where);
	}

        public function vlozClanek($params)
	{
		return Db::prikazUpdatePOST('
			INSERT INTO `clanky`
                        SET
		', $params);
	}
        
        
	// Vrátí seznam článků v databázi
	public function vratClanky()
	{
		return Db::dotazVsechny('
			SELECT `clanky_id`, `titulek`, `url`, `popisek`,`poradi`
			FROM `clanky` 
			ORDER BY `poradi` DESC
		');
	}
        
        
	
}