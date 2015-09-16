<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NastaveniWeb {
    
    
    function vratNastaveni(){
        
        return DB::dotazJeden('SELECT * from fla_setting');
        
    }
    
    function ulozNastaveni($par) {

        return DB::prikazUpdatePOST('UPDATE fla_setting SET where id=1', $par);

        
    }
    
}

