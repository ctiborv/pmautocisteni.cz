<?php

define ("RESIZEX", "300");
define ("RESIZEY", "200");
define ("ZACHOVATSTRANY", "1");

define ("CESTAOBRAZKY", "obrazky");



include ("db.php");
//Header("Pragma: no-cache"); 
//Header("Cache-control: no-cache"); 
//Header("Expires: ".GMDate("D, d m Y H:i:s")." GMT");

//setlocale(LC_TIME, 'cs_CZ.utf-8');

?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8" />
    <title>Galerie PM Autočištění</title>
  	<script language="JavaScript" src="includes/js/calendar/calendar_eu.js"></script>
  	<link rel="stylesheet" href="includes/js/calendar/calendar.css">
    <link href="includes/Site.css" rel="stylesheet" type="text/css" />
    

<LINK href="css/Site.css" type=text/css rel=stylesheet>
<script language="JavaScript" src="js/calendar/calendar_eu.js"></script>
<link rel="stylesheet" href="js/calendar/calendar.css"><!-- Load jQuery -->
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("jquery", "1");
</script>

<!-- Load TinyMCE -->
<script type="text/javascript" src="js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
	$().ready(function() {
		$('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : 'js/tiny_mce/tiny_mce.js',

			// General options
			theme : "advanced",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "css/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
	});
</script>
<!-- /TinyMCE -->

</head>

<?

        function friendly_url($nadpis) {
                $url = $nadpis;
                $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
                $url = trim($url, "-");
                $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
                $url = strtolower($url);
                $url = preg_replace('~[^-a-z0-9_]+~', '', $url);
        return $url;
    }

function convertTime($dformat,$sformat,$ts) {
    extract(strptime($ts,$sformat));
    return strftime($dformat,mktime(
                                  intval($tm_hour),
                                  intval($tm_min),
                                  intval($tm_sec),
                                  intval($tm_mon)+1,
                                  intval($tm_mday),
                                  intval($tm_year)+1900
                                ));
}

 function Nahoru($spojeni)
 { // BEGIN function Nahoru($spojeni)
    $id=$_GET["id"];
    $idc=$_GET["idc"];
 	  $sql="SELECT * FROM galerie where id_galerie=$id";
    $res = PrSql($spojeni,$sql);
 	  $zaznam = mysqli_fetch_array($res);
 	  $priorita=$zaznam["priorita"];
 	  $sql = "SELECT * FROM galerie where id_content_menu=$idc and priorita<$priorita order by priorita DESC LIMIT 0,1";
    $res = PrSql($spojeni,$sql);
 	  if ($zaznam=mysqli_fetch_array($res)) {
      $idn=$zaznam["id_galerie"];
      $prioritan=$zaznam["priorita"];
      $sql="UPDATE galerie SET priorita=$prioritan where id_galerie=$id";
      $res = PrSql($spojeni,$sql);
      $sql="UPDATE galerie SET priorita=$priorita where id_galerie=$idn";
      $res = PrSql($spojeni,$sql);
    }
 } // END function Nahoru($spojeni)

function Dolu($spojeni)
 { // BEGIN function Nahoru($spojeni)
    $id=$_GET["id"];
    $idc=$_GET["idc"];
    
 	  $sql="SELECT * FROM galerie where id_galerie=$id";
    $res = PrSql($spojeni,$sql);
 	  $zaznam = mysqli_fetch_array($res);
 	  $priorita=$zaznam["priorita"];
 	  $sql = "SELECT * FROM galerie where id_content_menu=$idc and priorita>$priorita order by priorita ASC LIMIT 0,1";
    $res = PrSql($spojeni,$sql);
 	  if ($zaznam=mysqli_fetch_array($res)) {
      $idn=$zaznam["id_galerie"];
      $prioritan=$zaznam["priorita"];
      $sql="UPDATE galerie SET priorita=$prioritan where id_galerie=$id";
      $res = PrSql($spojeni,$sql);
      $sql="UPDATE galerie SET priorita=$priorita where id_galerie=$idn";
      $res = PrSql($spojeni,$sql);
    }
 } // END function Nahoru($spojeni)


function SmazatG($spojeni)
 { // BEGIN function Nahoru($spojeni)
    $id=$_GET["id"];
    $sql="DELETE FROM galerie where id_galerie=$id";  
    $res = PrSql($spojeni,$sql);
 }

 function SmazatF($spojeni)
 { // BEGIN function Nahoru($spojeni)
    $id=$_GET["idfoto"];
    $sql="DELETE FROM foto where id_foto=$id";  
    $res = PrSql($spojeni,$sql);
 }


 function SpravaGalerie($spojeni) {
      ?>
      <div>
      <br>
             <table >
              <tr>
              <th>Menu</th>
              <th>Název</th>
              <th>Popis</th>
              <th>Datumvlozeni</th>
              <th>Umístění</th>
              <th>Přesun</th>
              <th>Editovat</th>
              <th>Přidat foto na konec</th>
              <th>Editovat fotografie</th>
              <th>Smazat galerii</th>
              </tr>
        
        <?
          $sql="SELECT * FROM galerie order by id_content_menu,priorita";  
          $res = PrSql($spojeni,$sql);
          $oldn="";
          while ($zaznam = mysqli_fetch_array($res)) {
            echo "<tr>";
            $idc=$zaznam["id_content_Menu"];
            $sqlm="SELECT titulek FROM clanky where clanky_id = ".$idc;  
            $resm = PrSql($spojeni,$sqlm);
            $zaznamm = mysqli_fetch_array($resm);
            $nazevm=$zaznamm['titulek'];
            if ($oldn!=$nazevm) {
              $oldn=$nazevm;
              $sqlmx="SELECT Max(priorita) as max from galerie where id_content_Menu = ".$idc;
              $resmx = PrSql($spojeni,$sqlmx);
              $zaznammx = mysqli_fetch_array($resmx);
              $max=$zaznammx["max"];  

              
            }
            else {
              $nazevm="&nbsp;";
            }
            echo "<td>".$nazevm."</td>";
            echo "<td>".$zaznam['nazev']."</td>";
            echo "<td>".substr($zaznam['popis'],0,150)."... </td>";
            echo "<td>".date("j.n.Y",strtotime($zaznam['datumvlozeni']))."</td>";
            echo "<td>".$zaznam['priorita']."</td>";
            echo "<td align=\"center\">";
            if ($oldn!=$nazevm) echo "<a href=\"?sekce=nahoru&idc=$idc&id=".$zaznam["id_galerie"]."\"><img width=\"20\" src=\"img/sort_asc.png\"></a>";
            if  ($zaznam["priorita"]<$max) echo "<a href=\"?sekce=dolu&idc=$idc&id=".$zaznam["id_galerie"]."\"><img width=\"20\" src=\"img/sort_desc.png\"></a>";
            echo "</td>";
            echo "<td align=\"center\"><a href=\"?sekce=pridatg&id=".$zaznam["id_galerie"]."\"><img src=\"img/b_edit.png\"></a></td>";
           echo "<td align=\"center\"><a href=\"?sekce=pridatf&id=".$zaznam["id_galerie"]."\"><img src=\"img/expandall.png\"></a></td>";
           echo "<td align=\"center\"><a href=\"?sekce=editf&id=".$zaznam["id_galerie"]."\"><img src=\"img/j_button2_image.png\"></a></td>";
             ?>
           <td align="center"><a href="?sekce=smazatg&id=<? echo $zaznam["id_galerie"] ?>" onclick="return confirm('Opravdu smazat galerie?')"><img src="img/b_drop.png"></a></td>
          <? 
          }
          ?>

          </table>
      </div>

      <?
      }
    function resizePhoto($vstup,$vystup,$width,$height,$aspectratio,$quality)  {
    
       /*
       $vstup //cesta k původnímu obrázku
       $vystup //cesta ke zmenšenému obrázku
       $width //šířka zmenšeného obrázku
       $height //délka zmenšeného obrázku
       $aspectratio //zachovávat poměr stran (0/1)
       $quality //komprese (100 - nejlepsi) - doporucuji 75
        */
    
        if(file_exists($vstup)){  //nejprve zjistíme, zda-li byl zadán vstup a existuje
            $vstup = ImageCreateFromJPEG($vstup);  //načteme si obrázek do proměnné
        } else {
            echo "resizePhoto: Nebyl zadán vstup !";
            return false;
        }
    
        $vstup_wd = imagesx($vstup); //zjistíme šířku původního obrázku
        $vstup_ht = imagesy($vstup);  //zjistíme délku původního obrázku
    
        if($vstup_wd <= $width && $vstup_ht <= $height) {
            //pokud je obrázek menší než požadovaná velikost nebudeme počítat nové hodnoty
            $width = $vstup_wd;
            $height = $vstup_ht;
        } else {
    
            if($aspectratio) {
                //pokud je zaplý aspect ratio spočítáme novou velikost v daném poměru
                $w = round($vstup_wd * $height / $vstup_ht);
                $h = round($vstup_ht * $width / $vstup_wd);
                if(($height-$h)<($width-$w)){
                    $width =& $w;
                } else {
                    $height =& $h;
                }
    
            }
        }
    
        $temp = imageCreateTrueColor($width,$height);
        //vytvoříme obrázek o rozměrech zmenšeného obrázku
        imageCopyResampled($temp, $vstup, 0, 0, 0, 0, $width, $height, $vstup_wd, $vstup_ht);
        //obrázky zkopíruje na sebe, takže dojde vlastně ke zmenšení výsledného obrázku
        ImageJPEG($temp, $vystup, $quality);
        //uložíme zmenšený obrázek na výstup
        imagedestroy($vstup); //uvolnime pamět
        imagedestroy($temp); //uvolnime pamět
    }

		function perform_upload($spojeni,$filename, $fextension, $temp_file, $filesize, $filetype,$fileerror,$nazev,$id,$poradi){
		$goodSize=($filesize < 5950000);
		$allowedExts= array("jpg", "jpeg", "gif", "png");	
		$extensionMatch = in_array(strtolower($fextension), $allowedExts);
                $filename=friendly_url($filename).".".$fextension;
		if(!$extensionMatch ) echo "Soubor není typu obrázek<br>";
                if ($goodSize  && $extensionMatch) {
                if ($fileerror > 0) {
                echo "Return Code: " . $fileerror . "<br/>";
                }   else   {
                echo "<ul>";
                echo "<li>Upload: " . $filename . "</li><br/>";
                echo "<li>Type: " . $filetype . " </li><br/>";
                echo "<li>Size: " . ($filesize / 1024) . " Kb</li><br/>";
                echo "</ul>";
                        $location = CESTAOBRAZKY."/".$id."-".$filename ;
                        $locationsm = CESTAOBRAZKY."/".$id."-sm".$filename ;

                        if(!move_uploaded_file($temp_file, $location))
                                echo "failed to move the upload file to $location<br>";
                        else
                                echo "Stored in: " . $location;
                                resizePhoto($location,$locationsm,RESIZEX,RESIZEY,ZACHOVATSTRANY,'75');

          $sql = "UPDATE foto SET poradi=poradi+1 where id_galerie=$id and poradi>=$poradi";
          echo $sql;
          $res = PrSql($spojeni,$sql);

          $sql = "INSERT INTO foto (id_galerie,nazev,soubor,soubormale,datumvlozeni,poradi) VALUES ($id,'$filename','$location','$locationsm',NOW(),$poradi)";
          echo $sql;
          $res = PrSql($spojeni,$sql );
          
	}
		} else  {
			echo "Nesprávná přípona souboru: $fextension";
		}
	}

  
     function EditovatF($spojeni)
      { // BEGIN function PridatDokument
      $idg=$_GET["id"];
      $sql="SELECT * FROM galerie where id_galerie=$idg ";  
      $res = PrSql($spojeni,$sql);
      $zaznam = mysqli_fetch_array($res);
      $nazev=$zaznam["nazev"];
          
      ?>
      <br>
       <h1>Fotogalerie : <?echo $nazev?></h1>
             <table >
              <tr>
              <th>Obrázek</th>
              <th>Nazev</th>
              <th>Popis</th>
              <th>Datumvlozeni</th>
              <th>Editovat fotografie</th>
              <th>Přidat foto za</th>
              <th>Pořadí</th>
              <th>Smazat</th>
              </tr>
        
        <?
          $id=$_GET["id"];
          $sql="SELECT * FROM foto where id_galerie=$id order by poradi";  
          $res = PrSql($spojeni,$sql);
          $pocet = mysqli_num_rows($res);
          $i=0;

          while ($zaznam = mysqli_fetch_array($res)) {
          
            echo "<tr>";
            echo "<td><a href=\"".$zaznam["soubor"]."\"><img height=\"100\" src=\"".$zaznam["soubormale"]."\"/></a></td>";
            echo "<td>".$zaznam['nazev']."</td>";
            echo "<td>".substr($zaznam['popis'],0,150)."</td>";
            echo "<td>".date("j.n.Y",strtotime($zaznam['datumvlozeni']))."</td>";
            echo "<td align=\"center\"><a href=\"?sekce=editfot&id=".$zaznam["id_foto"]."\"><img src=\"img/b_edit.png\"></a></td>";
            echo "<td align=\"center\"><a href=\"?sekce=pridatf&poradi=".$zaznam["poradi"]."&id=".$zaznam["id_galerie"]."\"><img src=\"img/j_button2_image.png\"></a></td>";
             ?>
           
      	    <form name="MoveFoto" ENCTYPE="multipart/form-data"  method="post" action="?sekce=MoveFoto&id=<? echo $id ?>" >
            <td><input type="hidden" name="poradi" value="<?echo $zaznam["poradi"]?>">
            <? if ($i>0) {?><input style="margin-bottom:5px" name="nahoru" type ="image" src="img/sort_asc.png" value="1"><br><?}
            if ($i<($pocet-1)) {?><input name="dolu" type ="image" src="img/sort_desc.png" value="1"><?}?>
            <input name="idf" type="hidden" value="<?echo $zaznam["id_foto"]?>">
            <input name="idg" type="hidden" value="<?echo $zaznam["id_galerie"]?>">
            </td>
            </form>
           <td align="center"><a href="?sekce=smazatf&idfoto=<? echo $zaznam["id_foto"] ?>&id=<? echo $idg ?>" onclick="return confirm('Opravdu smazat foto?')"><img src="img/b_drop.png"></a></td>
           <?
            $i=$i+1;

          }
          echo "</table";
      }
  
     function PridatF($spojeni)
      { // BEGIN function PridatDokument
          $id=$_GET["id"];
          echo "<div>";
          $odeslat=$_POST["odeslat"];
          if ($id) {
              $sql="Select * from galerie where id_galerie=".$id;
              $res = PrSql($spojeni,$sql);
              $zaznam = mysqli_fetch_array($res);
              $nazev=$zaznam["nazev"];
              $popis=$zaznam["popis"];
              $priorita=$zaznam["priorita"];
          }
          if ($_POST["Odeslat"]!="Nahrát") {
          ?>
          <p>
           </p>  
      	   <form name="dokument" ENCTYPE="multipart/form-data"  method="post" action="?sekce=pridatf&id=<?echo $id?>">
            Nahrát foto do galerie <?echo $nazev?>:<br />
            <input name="thefile[]" type="file" accept="image/jpg" multiple="" /><br />
            <input name="poradi" type="hidden" value="<?echo $_GET["poradi"]?>"  multiple="" /><br />
            <input type="submit" name="Odeslat" value="Nahrát" />
            </form>           
          <?
        }
        else {
      	$uploaded= $_FILES['thefile']['name'];
      	echo "Nahrávám soubory : ";
        $poradi=$_POST["poradi"];
        if (!$poradi) {
              $sql="Select Max(poradi) as max from foto  where id_galerie=".$id;
              $res = PrSql($spojeni,$sql);
              $zaznam = mysqli_fetch_array($res);
              $poradi=$zaznam["max"];
        }
      	foreach ($uploaded as $key => $value){				
         $poradi++;
      		$fname	=	$value;
      		$fext		=  end(  explode(".",$fname));		
      		$ftype	=	$_FILES['thefile']['type'][$key];
      		$ftmp	=	$_FILES['thefile']['tmp_name'][$key];
      		$fsize	=	$_FILES['thefile']['size'][$key];					
      		$ferror=	$_FILES['thefile']['error'][$key];
          perform_upload($spojeni,$fname, $fext, $ftmp, $fsize, $type,$ferror,$nazev,$id,$poradi);
      	//	echo "<pre>          <b>extension</b>=$fext type='$ftype'  type_name='$ftmp'  size='$fsize'  errors='$ferror'</pre><br>";
      	                    ?>
                      <script language="Javascript">
                        window.location="<? echo $_SERVER["PHP_SELF"]."?sekce=editf&id=".$id ?>";
                      </script>
                    <?
         }
	       }
         echo "</div>";

       }    


      function EditovatFoto($spojeni)
      { // BEGIN function PridatDokument
          $id=$_GET["id"];
          $odeslat=$_POST["odeslat"];
          if ($id) {
              $sql="Select * from foto where id_foto=".$id;
              $res = PrSql($spojeni,$sql);
              $zaznam = mysqli_fetch_array($res);
              $nazev=$zaznam["nazev"];
              $popis=$zaznam["popis"];
              
          }
          else {
              $nazev=$_POST["nazev"];
              $popis=$_POST["e1m1"];
              $id=$_POST["id"];
          }
          if ($odeslat) {
            if (!$nazev) {
              $chyba.=" název ";
              $carka=",";
            }
          }
          if ($odeslat && !$chyba) {
          
                  $id=$_POST["id"];
                  $sql = "UPDATE foto SET nazev='$nazev', popis='$popis' where id_foto=$id";
                  echo $sql;
                  $res = PrSql($spojeni,$sql );
                  $sql = "SELECT * from foto where id_foto=$id";
                  $res = PrSql($spojeni,$sql );
                  $zaznam = mysqli_fetch_array($res);
                  $idg=$zaznam["id_galerie"];

                    ?>
                      <script language="Javascript">
                        window.location="<? echo $_SERVER["PHP_SELF"]."?sekce=editf&id=".$idg ?>";
                      </script>
                    <?
                     }
          else {
          $text="Editovat";
          $butt="Aktualizovat";
      	?>
      	<h2><?echo $text ?> zprávu</h2>
      	<? if ($chyba) {
          ?><h3>Nebyly zadány údaje : <?echo $chyba?></h3><?
        }
        ?>
      	<form name="dokument" ENCTYPE="multipart/form-data"  method="post" action="?sekce=editfot">
          <table>
          <tr>
            <td>Název galerie :</td>
            <td><input name="nazev" type="text" size="120" value="<?echo $nazev ?>"></td>
          </tr>
          <tr>
            <td>Popis galerie :</td>
            <td>
      		<div>
      			<textarea id="elm1" name="e1m1" rows="15" cols="80" style="width: 80%" class="tinymce"><?echo $zaznam["popis"]?></textarea>
      		</div>
          </td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input name="odeslat" type="submit" value="<?echo $butt?>"></td>
          </tr>    </table>
          <input type="hidden" name="id" value="<?echo $id?>">
              
        </form>
      	<?
      	}
      } // END function PridatDokument



   
      function PridatG($spojeni)
      { // BEGIN function PridatDokument
          $id=$_GET["id"];
          $odeslat=$_POST["odeslat"];
          if ($id) {
              $sql="Select * from galerie where id_galerie=".$id;
              $res = PrSql($spojeni,$sql);
              $zaznam = mysqli_fetch_array($res);
              $nazev=$zaznam["nazev"];
              $popis=$zaznam["popis"];
              $priorita=$zaznam["priorita"];
              $idcmenu=$zaznam["id_content_Menu"];
              
          }
          else {
              $nazev=$_POST["nazev"];
              $popis=$_POST["e1m1"];
              $priorita=$_POST["priorita"];
              $idcmenu=$_POST["idcmenu"];
          }
          
          if (!$priorita) {
              $sql="SELECT MAX(priorita) as maxp FROM galerie";
              $res = PrSql($spojeni,$sql );
              $zaznam = mysqli_fetch_array($res);
              $max=$zaznam["maxp"];
              if (!$max) $max = 1;
              else $max++;
              $priorita=$max;
          }
          
          if ($odeslat) {
            if (!$nazev) {
              $chyba.=" název ";
              $carka=",";
            }
          }
          if ($odeslat && !$chyba) {
          
          if ($odeslat=="Uložit") {
                 $sql = "INSERT INTO galerie (id_content_Menu,nazev,popis,priorita,datumvlozeni) VALUES ($idcmenu,'$nazev','$popis',$priorita,NOW())";
                 $res = PrSql($spojeni,$sql );
   	                    ?>
                      <script language="Javascript">
                        window.alert('Galerie byla úspěšně uložena.')
                        window.location="<? echo $_SERVER["PHP_SELF"] ?>";
                      </script>
                    <?
                }
                else {
                  $id=$_POST["id"];
                  $sql = "UPDATE galerie SET id_content_Menu=$idcmenu, nazev='$nazev', popis='$popis', priorita='$priorita' where id_galerie=$id";
                  $res = PrSql($spojeni,$sql );
   	                    ?>
                      <script language="Javascript">
                        window.location="<? echo $_SERVER["PHP_SELF"] ?>";
                      </script>
                    <?
               }
          }
          else {
          $text="Přidat";
          $butt="Uložit";
          if ($id) {
            $text="Editovat";
            $butt="Aktualizovat";
          }
      	?>
      	<h2><?echo $text ?> zprávu</h2>
      	<? if ($chyba) {
          ?><h3>Nebyly zadány údaje : <?echo $chyba?></h3><?
        }
        ?>
      	<form name="dokument" ENCTYPE="multipart/form-data"  method="post" action="?sekce=pridatg">
          <table>
          <tr>
            <td>Menu galerie :</td>

            <td>
            <select name="idcmenu">
            <?
              $sql="Select * from clanky";
              $res = PrSql($spojeni,$sql);
              while ($zaznam = mysqli_fetch_array($res)) {
              
              ?>
                <option <?if ($zaznam["clanky_id"]==$idcmenu) echo "selected"; ?> 
                value="<?echo $zaznam["clanky_id"]?>"><?echo $zaznam["titulek"]?></option>
              <?
              

              }
             ?>           
            </select>
            </td>
          </tr>
          <tr>
            <td>Název galerie :</td>
            <td><input name="nazev" type="text" size="120" value="<?echo $nazev ?>"></td>
          </tr>
          <tr>
            <td>Popis galerie :</td>
            <td>
      		<div>
      			<textarea id="elm1" name="e1m1" rows="15" cols="80" style="width: 80%" class="tinymce"><?echo $popis?></textarea>
      		</div>
          </td>
          </tr>
          <tr>
            <td>Umístění :</td>
            <td><input name="priorita" type="text" size="120" value="<?echo $priorita ?>"></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input name="odeslat" type="submit" value="<?echo $butt?>"></td>
          </tr>    </table>
          <input type="hidden" name="id" value="<?echo $id?>">
              
        </form>
      	<?
             
         }
      } // END function PridatDokument

function MoveFoto($spojeni){

  $nahoru=$_POST["nahoru_x"];
  $dolu =$_POST["dolu_x"];
  $id=$_POST["idf"];
  $idg=$_POST["idg"];
  $poradi=$_POST["poradi"];   

if ($nahoru || $dolu) {
    $poradi=$_POST["poradi"];
    if ($nahoru) {
    $sql = "SELECT * from foto where poradi<$poradi and id_galerie=$idg order by poradi DESC LIMIT 1";
    }
    else {
    $sql = "SELECT * from foto where poradi>$poradi and id_galerie=$idg order by poradi ASC LIMIT 1";
    }    
    $res = PrSQL($spojeni,$sql);
    $pocet = mysqli_num_rows($res);

    if ($pocet > 0) {
      $zaznam = mysqli_fetch_array($res);
      $idvrchni = $zaznam["id_foto"];
      $porvrchni = $zaznam["poradi"];
      $sql = "UPDATE foto SET poradi='$porvrchni' where id_foto=$id";
      $res = PrSql($spojeni,$sql);
      $sql = "UPDATE foto SET poradi='$poradi' where id_foto=$idvrchni";
      $res = PrSql($spojeni,$sql);
    }
  }
}

function Main(){

global $spojeni;

if ($_SERVER['SERVER_NAME']!="localhost") {
  $spojeni= mysqli_connect(SQL_HOST, SQL_USERNAME, SQL_PASSWORD);
  $db=mysqli_select_db($spojeni,SQL_DBNAME);
}
else {
  $spojeni= mysqli_connect('localhost', 'root', '');
  $db=mysqli_select_db($spojeni,'pmautocisteni');
}
 

$prikaz = $_GET["sekce"];
PrSql($spojeni,"SET NAMES utf8");
 
switch ($prikaz) :
  case "pridatg":
    PridatG($spojeni);
    break;
  case "pridatf":
    PridatF($spojeni);
    break;
  case "editf":
    EditovatF($spojeni);
    break;
  case "editfot":
    EditovatFoto($spojeni);
    break;
  case "smazatg":
    SmazatG($spojeni);
    echo "<h1>Galerie byla smazána.</h1>";
    SpravaGalerie($spojeni);
    break;
  case "smazatf":
    Smazatf($spojeni);
    echo "<h1>Foto úspěšně smazáno.</h1>";
    EditovatF($spojeni);
    break;
  case "MoveFoto":
    MoveFoto($spojeni);
    EditovatF($spojeni);
    break;  
  case "dolu":
    Dolu($spojeni);
    SpravaGalerie($spojeni);
    break;  
  case "nahoru":
    Nahoru($spojeni);
  default:
    SpravaGalerie($spojeni);
endswitch;

}

$sekce=$_GET["sekce"];

?>

<body>
    <div class="page">
       <div id="header">
       <span id="admin">Galerie MZ PT</span>
       
                <div id="menu">
                <ul>   
                    <li><a <?if ($sekce=="spravag") echo "id=\"aktivni\"";?> href="?sekce=spravag">Seznam galerií</a></li>
                    <li><a <?if ($sekce=="pridatg") echo "id=\"aktivni\"";?> href="?sekce=pridatg">Přidat galerii</a></li>
                </ul>

                </div>
        </div>
        <div id="main">
          <?
                Main()
          ?>
        </div>

        <div id="footer">
       <span><a href="/">Zpět na administraci hlavního menu</a></span> 
        
   
        </div>
    </div>
</body>
</html>