<?
include ("db.php");

function Uvodnistranka($spojeni)
{ // BEGIN function Uvodnistranka($spojeni)
?>
<div class="slider">
<img class="ramecek" src="images/ramec.png" />	
</div>

<h1>Nabídka služeb makléře</h1>

<ul class="listt">
<li>prodej a koupě nemovitostí
<li>pronájem nemovitostí                                      </li>
<li>výkup a oddlužení nemovitostí                          </li>
<li>zprostředkování výhodné hypotéky                     </li>
<li>poradenská činnost v oblasti nemovitostí ZDARMA     </li>       
<li>Česká republika, Slovenská republika a zahraničí</li>
</ul>


<h2><a href="?sekce=zobrazn">Nabídka nemovitostí makléře</a></h2>
<div>
<?

$sql="SELECT * FROM nemovitost order by priorita ";  
$res = PrSql($spojeni,$sql);
$i=0;
while (($zaznam = mysqli_fetch_array($res) ) && ($i<=5)) {
 ?>
   <div class="ramecekmaly">
     <a href="?sekce=zobrazn#<?echo $zaznam["id"]?>"> <img width="300" alt="<?echo $zaznam["nazev"] ?>" src="<?echo $zaznam['obrazek']?>" /></a>
    </div>
 <?
 $i++;
}
?>
</div>
<?	
} // END function Uvodnistranka($spojeni)


function ZobrazNemovitosti($spojeni)
{ // BEGIN function ZobrazNemovitosti
  ?>
  <h3>Aktuální nabídky nemovitostí</h3>
             <div class="mezera"><hr></div>
  <?
          $id=$_GET["id"];
          if ($id) $sql="SELECT * FROM nemovitost where id=$id"; 
          else $sql="SELECT * FROM nemovitost order by priorita ";
          $res = PrSql($spojeni,$sql);
          while ($zaznam = mysqli_fetch_array($res)) {
          ?>
          <div class="nabidka">
            <div class="nadpisnab" id="<?echo $zaznam["id"]?>">
                <?echo $zaznam["nazev"]?>
            
            </div>
                <span class="obrazek"><a target="_blank" href="<?echo $zaznam["odkaz"]?>"><img class="obrnab" width="400" src="<?echo $zaznam["obrazek"]?>"/></a></span>
                  <div class="popisnab">
                  Popis : <?echo $zaznam["popis"]?>
                  </div>
            <table border="0" width="90%">
              <tr>
                <td>
                </td>
                <td>
                </td>
                </tr>
              </table>
              <div class="datumvl">
              Datum vložení : <?echo date("j.n.Y",strtotime($zaznam['datumvlozeni']))?>
              </div> 
            </div>
            
            <h3><a target="_blank" href="<?echo $zaznam["odkaz"]?>">VÍCE INFORMACÍ O TÉTO NABÍDCE</a></H3>
            <div class="mezera"><hr></div>
          <?}
    ?>
    <?
} // END function ZobrazNemovitosti

?>
<!DOCTYPE html>
<html lang="cs">


	<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>JJ REALITY</title>
		
		     <meta name="author" content="VCONSULT.CZ Tomáš Vyjídák"/>
    
    

<meta name="keywords" content="jj reality"/>
    <meta name="description" content="jj reality"/>     

    <meta name="Robots" content="all, follow" />
    <meta name="Googlebot" content="index,follow,archive" />
		
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/supersized.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="theme/supersized.shutter.css" type="text/css" media="screen" />
		
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.easing.min.js"></script>
		
		<script type="text/javascript" src="js/supersized.3.2.7.min.js"></script>
		<script type="text/javascript" src="theme/supersized.shutter.min.js"></script>
		
		<script type="text/javascript">
			
			jQuery(function($){
				
				$.supersized({
				
					// Functionality
					slide_interval          :   7000,		// Length between transitions
					transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	500,		// Speed of transition
															   
					// Components							
					slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					slides 					:  	[			// Slideshow Images
														
														{image : 'images/background.jpg'},
														{image : 'images/background2.jpg'},
														{image : 'images/background3.jpg'}
												]
					
				});
		    });
		    
		</script>
		
	</head>
	

<body>
	
<div class="main">
<div class="content">
   
<img class="logo" src="images/logo.png" alt="jj reality"/>
<?

global $spojeni;


$spojeni= mysqli_connect(SQL_HOST, SQL_USERNAME, SQL_PASSWORD); 
$db=mysqli_select_db($spojeni,SQL_DBNAME);
$prikaz = $_GET["sekce"];
PrSql($spojeni,"SET NAMES utf8");
 
switch ($prikaz) :
  case "zobrazn":
    ZobrazNemovitosti($spojeni);
    break;
  default:
    Uvodnistranka($spojeni);
endswitch;


?>	

<h2>Kontakty</h2>

<p>Jan Juránek, BA  Email: jan.juranek@remax-czech.cz  Tel: +420 731 646 366  Web:  <a href="www.remax-czech.cz">www.remax-czech.cz</a> , <a href="www.jjreality.cz">www.jjreality.cz</a></p>


<br /><br />

<img class="baner" src="images/baner.png">

<br /><br /><br /><br />
</div> <!-- div content konec -->
</div> <!-- div main konec -->
</body>
</html>
