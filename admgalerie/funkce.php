<?

function ZobrazNemovitosti($spojeni)
{ // BEGIN function ZobrazNemovitosti
	        $sql="SELECT * FROM nemovitost order by priorita ";  
          $res = PrSql($spojeni,$sql);
          $i=0;
          while ($zaznam = mysqli_fetch_array($res) || $i<5 ) {
           ?>
             <div class="ramecekmaly">
               <a href="?cmd=zobnem&id=<?echo $zaznam["id"]?>"> <img alt="pic" src="<?echo $obrazek?>" />
              </div>

           <?
           $i++;
           
          
          }
} // END function ZobrazNemovitosti