<?
error_reporting(E_ALL);
include ("db.php");
//Header("Pragma: no-cache"); 
//Header("Cache-control: no-cache"); 
//Header("Expires: ".GMDate("D, d m Y H:i:s")." GMT");

//setlocale(LC_TIME, 'cs_CZ.utf-8');

?>



<?

$spojeni= mysqli_connect(SQL_HOST, SQL_USERNAME, SQL_PASSWORD); 
$db=mysqli_select_db($spojeni,SQL_DBNAME);
$prikaz = $_GET["sekce"];
PrSql($spojeni,"SET NAMES utf8");
$sqlg="SELECT * FROM galerie order by priorita";  
$resg = PrSql($spojeni,$sqlg);
while ($zaznam = mysqli_fetch_array($resg)) {
  ?>
    <div>
    <h1><?echo $zaznam["nazev"]?></h1>
    <h2><?echo $zaznam["popis"]?></h2>
    <div class="galerie">
    <?
    $sqlf="SELECT * FROM foto where id_galerie=".$zaznam["id_galerie"];  
    $resf = PrSql($spojeni,$sqlf);
    while ($zaznamf = mysqli_fetch_array($resf)) {
      ?><span><a href="<?echo $zaznamf["soubor"]?>"><img alt="<?echo $zaznamf["nazev"]?>" class="foto" src="<?echo $zaznamf["soubormale"]?>"/></a></span>
      <?  
    }
  ?>
   </div> 
    </div>
  <?
}




?>