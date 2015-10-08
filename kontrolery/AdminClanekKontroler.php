<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminClankyKontroler
 *
 * @author ctibor
 */
class AdminClanekKontroler extends Kontroler {
    //put your code here
        private $_kontrolerMd;
        
        private function friendly_url($nadpis) {
                $url = $nadpis;
                $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
                $url = trim($url, "-");
                $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
                $url = strtolower($url);
                $url = preg_replace('~[^-a-z0-9_]+~', '', $url);
        return $url;
    }
        
        public function __construct() {
                $this->_kontrolerMd= new SpravceClanku();
                $spravceClanku = $this->_kontrolerMd;
        }
    
        public function zpracuj($parametry) {

        
		if (!empty($parametry[0]))
		{
                    
                        if ($parametry[0]=='vymaz') {
                            $this->_kontrolerMd->vymazClanek($parametry[1]);
                            $this->presmeruj('adminClanek/');                        
                        }
                        if ($parametry[0]=='posundolu') {
                            $this->_kontrolerMd->posunClanek($parametry[1],$parametry[2],0);
                            $this->presmeruj('adminClanek/');                        
                        }
                        if ($parametry[0]=='posunnahoru') {
                            $this->_kontrolerMd->posunClanek($parametry[1],$parametry[2],1);
                            $this->presmeruj('adminClanek/');                        
                        }
                        if ($_POST['Ulozit']) { 
                            $this->ulozitClanek($parametry);
                       }
                        
                        if ($parametry[0]!='novy') {
			$clanek = $this->_kontrolerMd->vratClanek($parametry[0]);
			// Pokud nebyl článek s danou URL nalezen, přesměrujeme na ChybaKontroler
                        
			if (!$clanek)
				die($clanek);
		
			// Naplnění proměnných pro šablonu		
			$this->data['klicova_slova'] = $clanek['klicova_slova'];
			$this->data['popisek'] = $clanek['popisek'];
			$this->data['titulek'] = $clanek['titulek'];
			$this->data['poradi'] = $clanek['poradi'];
			$this->data['obsah'] = $clanek['obsah'];
			$this->data['skryt'] = $clanek['skryt'];
			$this->data['slider'] = $clanek['slider'];
                        }
                        else {
                        $poradi=$this->_kontrolerMd->vratMaxPoradi();    
			$this->data['poradi'] = $poradi['maxporadi'];
                        }
			// Nastavení šablony
			$this->pohled = 'adminclanek';
		}
		else
		// Není zadáno URL článku, vypíšeme všechny
		{
			$clanky = $this->_kontrolerMd->vratClanky();
                        
			$this->data['clanky'] = $clanky;
			$this->pohled = 'adminclanky';
		}
        }
        
        private function ulozitClanek($parametry) {
            
            $_POST['slider']=($_POST['slider']=='on');
            $_POST['skryt']=($_POST['skryt']=='on');
            
            if ($parametry[0]!='novy') {
                $this->_kontrolerMd->ulozClanek($parametry[0],$_POST);
            }
            else {
                    $_POST['url']=$this->friendly_url($_POST['titulek']);
                    $this->_kontrolerMd->vlozClanek($_POST);
                    $this->presmeruj('adminClanek/');
            }
            
        }
        
    
}
