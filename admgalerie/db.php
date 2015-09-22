<?php


  define("SQL_HOST","wm70.wedos.net");
  define("SQL_DBNAME","d95530_mz");
  define("SQL_USERNAME","w95530_mz");
  define("SQL_PASSWORD","FNskHfKX");

  

  

function ProvedSql($spojeni,$sqldotaz,$txtUspech,$txtNeuspech){



  $result = mysqli_query($spojeni,$sqldotaz);

  if ($result) {

      echo $txtUspech;
    }

    else {
      echo "SQL : ".$sqldotaz;
      die ($txtNeuspech." :".mysqli_error($spojeni));
    }


}

function PrSql($pspojeni,$sqldotaz){

  $result = mysqli_query($pspojeni,$sqldotaz);

  if (!$result) {
     echo "SQL dotaz: ".$sqldotaz."<BR>";
     die ("Chyba DB :".mysqli_error($pspojeni));
     
    }
  return $result;
  
}


?>

