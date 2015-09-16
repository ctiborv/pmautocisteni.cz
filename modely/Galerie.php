<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Galerie {

    public function vratGalerie() {
        
        $galerie = array();
        $galerie = DB::dotazVsechny('SELECT * '
                .'FROM galerie order by priorita');
        
        foreach ($galerie as $i=>$galerka) {
            
            $galerie[$i]['fotky'] = $this->vratFotky($galerka['id_galerie']);
        }
        
        return $galerie;
        
        
    }


    public function vratGalerii($id_galerie) {
        
        $galerie = DB::dotazJeden('SELECT * '
                .'FROM galerie where id_galerie = ?', $id_galerie);
        
        
        $galerie['fotky'] = $this->vratFotky($galerie['id_galerie']);
        
        return $galerie;
        
        
    }
    
    public function vratFotky($id_galerie) {
        
        return DB::dotazVsechny('SELECT * FROM `foto` where `id_galerie` = ? ', array($id_galerie));
        
    }    
    
    
}