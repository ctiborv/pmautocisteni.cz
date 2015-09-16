<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MenuKontroler  {
    
        private $_menudata;
        
        public function __construct() {
        
            $menu= New Menu();
            if ($_SESSION['admin']==1) {
                $_menudata = $menu->vratMenuAdmin();
            }
            else {
                $_menudata = $menu->vratMenuKlient();
            }
            $this->_menudata=$_menudata;
        }
        
       public function zpracujMenu($parametry) {       
           
           $menudata=$this->_menudata;
            foreach ($menudata as $menu) {
                if ($parametry[0]==$menu['url']) $aktivni=1;
                else $aktivni=0;
                $menuview[]=array('url'=>$menu['url'],'nazev'=>$menu['nazev'],'aktivni'=>$aktivni);
            }
            return $menuview;
                
       }
    
}