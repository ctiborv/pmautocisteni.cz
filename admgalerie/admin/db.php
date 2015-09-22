<?php


  define("SQL_HOST","127.0.0.1");

  define("SQL_DBNAME","jjrealitycz1");

  define("SQL_USERNAME","jjreality.cz");

  define("SQL_PASSWORD","pgT4T2X4");

  

  

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

