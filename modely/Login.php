<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Login {
    
    private $uzivatele = array('admin'=>'reebok','pavel'=>'klarka');
   
        
        public function vratUzivatele(){
            
            return $this->uzivatele;
        }
    
    
}