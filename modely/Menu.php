<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Menu {
    
    private $_menuadmin = array();
    
    public function __construct() {
        

            $_menuadmin[]=array('url'=>'/adminClanek','nazev'=>'Články');
            $_menuadmin[]=array('url'=>'/admgalerie/admin.php','nazev'=>'Galerie');
            $_menuadmin[]=array('url'=>'/adminNastaveni','nazev'=>'Nastavení');
            $_menuadmin[]=array('url'=>'/logout','nazev'=>'Odhlásit');
            
            $this->_menuadmin=$_menuadmin;
            
            
            
    }
    
    public function vratMenuKlient(){
            
        $spravceClanku = new SpravceClanku();
        $clanky= $spravceClanku->vratClankyKlient();
            
            foreach ($clanky as $clanek) {
                $menuklient[]=array('url'=>'clanek/'.$clanek['url'],'nazev'=>$clanek['titulek']);
                
            }
            $menuklient[]=array('url'=>'/nase-prace','nazev'=>'Naše práce');
//            $menuklient[]=array('url'=>'/login','nazev'=>'Přihlásit');
            return $menuklient;
    }

    public function vratMenuAdmin(){
            return $this->_menuadmin;
    }

}
