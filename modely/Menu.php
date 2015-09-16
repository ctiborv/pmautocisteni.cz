<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Menu {
    
    private $_menuadmin = array();
    
    public function __construct() {
        

            $_menuadmin[]=array('url'=>'/adminclanek','nazev'=>'Články');
            $_menuadmin[]=array('url'=>'/admgalerie/admin.php','nazev'=>'Galerie');
            $_menuadmin[]=array('url'=>'/adminnastaveni','nazev'=>'Nastavení');
            $_menuadmin[]=array('url'=>'/logout','nazev'=>'Odhlásit');
            
            $this->_menuadmin=$_menuadmin;
            
            
            
    }
    
    public function vratMenuKlient(){
            $clanky= Db::dotazVsechny('
			SELECT `titulek` , `url` 
			FROM `clanky` 
			ORDER BY `poradi` ASC
		');
            
            foreach ($clanky as $clanek) {
                $menuklient[]=array('url'=>'clanek/'.$clanek['url'],'nazev'=>$clanek['titulek']);
                
            }
            $menuklient[]=array('url'=>'/galerie','nazev'=>'Naše práce');
            $menuklient[]=array('url'=>'/login','nazev'=>'Přihlásit');
            return $menuklient;
    }

    public function vratMenuAdmin(){
            return $this->_menuadmin;
    }

}
