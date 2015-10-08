<?php

// Třída poskytuje metody pro správu článků v redakčním systému
class SpravceClanku
{
	
	// Vrátí článek z databáze podle jeho URL
	public function vratClanek($url)
	{
		return Db::dotazJeden('
			SELECT `clanky_id`, `titulek`, `obsah`, `url`, `popisek`, `klicova_slova`,`slider`,`poradi`, `skryt`
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

        public function posunClanek($params,$poradi,$smer)
	{
            if (!$smer) {
                $cl_meneny = Db::dotazJeden("SELECT clanky_id,poradi FROM clanky WHERE poradi>? order by poradi ASC LIMIT 0,1",array($poradi));
            }
            else {
                $cl_meneny = Db::dotazJeden("SELECT clanky_id,poradi FROM clanky WHERE poradi<? order by poradi DESC LIMIT 0,1",array($poradi));
            }
            $poradi_meneny = $cl_meneny['poradi'];

            $id_meneny = $cl_meneny['clanky_id'];
            
            DB::prikazJeden("UPDATE clanky SET poradi=? WHERE clanky_id=?",array($poradi_meneny,$params));
            DB::prikazJeden("UPDATE clanky SET poradi=? WHERE clanky_id=?",array($poradi,$id_meneny));
	}
                
        
        public function vratMaxPoradi()
        {
  		return Db::dotazJeden('
			SELECT max(poradi) as maxporadi
			FROM `clanky` 
		');          
        }
        
	// Vrátí seznam článků v databázi
	public function vratClanky()
	{
		return Db::dotazVsechny('
			SELECT `clanky_id`, `titulek`, `url`, `popisek`,`poradi`,`skryt`
			FROM `clanky` 
			ORDER BY `poradi` ASC
		');
	}
        
	public function vratClankyKlient()
	{
		return Db::dotazVsechny('
			SELECT `clanky_id`, `titulek`, `url`, `popisek`,`poradi`,`skryt`
			FROM `clanky` 
                        WHERE `skryt` = 0
			ORDER BY `poradi` ASC
		');
	}
                
	
}