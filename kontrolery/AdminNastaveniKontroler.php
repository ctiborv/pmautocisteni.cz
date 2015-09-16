<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminNastaveni
 *
 * @author ctibor
 */
class AdminNastaveniKontroler extends Kontroler {
    
    private $_nastaveniMd;
    
    
    
    public function zpracuj($param) {

        $this->_nastaveniMd = new NastaveniWeb();
        
        if ($_POST['Ulozit']) $res= $this->_nastaveniMd->ulozNastaveni($_POST);
        

        $data = $this->_nastaveniMd->vratNastaveni();
        
        // Naplnění proměnných pro šablonu		
        $this->data['keywords'] = $data['keywords'];
        $this->data['description'] = $data['description'];        
        $this->data['title'] = $data['title'];        
        $this->data['footer'] = $data['footer'];        

        $this->pohled="adminnastaveni";
        
        
    }
    //put your code here
}
