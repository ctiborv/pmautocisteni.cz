<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class LoginKontroler extends Kontroler {
    
    public function Zpracuj($parametry) {
        
        	$this->hlavicka = array(
			'titulek' => 'Přihlašovací formulář do administrace',
			'klicova_slova' => 'kontakt, email, formulář',
			'popis' => 'Přihlašovací formulář našeho webu.'
		);
		
		if (isset($_POST["prihlaseni"]))
		{
			$jmeno=$_POST['login'];
                        $heslo=$_POST['heslo'];
                        
                        
                        $overeni=$this->overUzivatele($jmeno, $heslo);
                        
                        if ($overeni==1) {
                            $_SESSION['admin']=1;
                            $this->presmeruj('');
                                                }
                        else {
                            $_SESSION['admin']=0;
                            $this->data['chyba']="Nesprávné jméno nebo heslo";
                        }
 
                        
		}
		
		$this->pohled = 'login';
        
    }
  
    private function overUzivatele($jmeno, $heslo){
        
            $moduzivatele = new Login();
            
            $uzivatele = $moduzivatele->vratUzivatele();
            if ($uzivatele[$jmeno]==$heslo) {
                return 1;
            }
            else {
                return 0;
            } 
        
    }

    
}