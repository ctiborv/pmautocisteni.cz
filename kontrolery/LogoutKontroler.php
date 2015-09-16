<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LogoutKontroler
 *
 * @author ctibor
 */
class LogoutKontroler extends Kontroler {
    //put your code here
    public function zpracuj($parametry){
        
        
        $_SESSION['admin']=0;
        $this->presmeruj('');
        
    }
}
