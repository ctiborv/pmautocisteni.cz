<?
include ("db.php");
//Header("Pragma: no-cache"); 
//Header("Cache-control: no-cache"); 
//Header("Expires: ".GMDate("D, d m Y H:i:s")." GMT");

setlocale(LC_TIME, 'cs_CZ.utf-8');

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs" dir="ltr">

<HEAD>

<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">

<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
<LINK href="../css/styleadmin.css" type=text/css rel=stylesheet>
<!-- Load jQuery -->
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("jquery", "1");
</script>

<!-- Load TinyMCE -->
<script type="text/javascript" src="includes/js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
	$().ready(function() {
		$('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : 'includes/js/tiny_mce/tiny_mce.js',

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


<?

 function SpravaNemovitosti($spojeni) {
      ?>
      <div>
             <table >
              <tr>
              <th>Název</th>
              <th>Popis</th>
              <th>Odkaz</th>
              <th>Obrazek</th>
              <th>Datumvlozeni</th>
              <th>Priorita</th>
              <th>Editovat</th>
              <th>Smazat</th>
              </tr>
        
        <?
          $sql="SELECT * FROM nemovitost order by priorita";  
          $res = PrSql($spojeni,$sql);
          while ($zaznam = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>".$zaznam['nazev']."</td>";
            echo "<td>".$zaznam['popis']."</td>";
            echo "<td>".$zaznam['obrazek']."</td>";
            echo "<td>".date("j.n.Y",strtotime($zaznam['datumvlozeni']))."</td>";
            echo "<td>".$zaznam['priorita']."</td>";
            echo "<td align=\"center\"><a href=\"?pod=pridatn&id=".$zaznam["id_nemovitost"]."\"><img src=\"../images/b_edit.png\"></a></td>";
             ?>
           <td align="center"><a href="?pod=smazatn&id=<? echo $zaznam["id_nemovitost"] ?>" onclick="return confirm('Opravdu smazat nemovitost?')"><img src="../images/b_drop.png"></a></td>
          <? 
          }
          ?>
          </table>
      </div>

      <?
      }


      function PridatN()
      { // BEGIN function PridatDokument
          $id=$_GET["id"];
          $odeslat=$_POST["odeslat"];
          if ($id) {
              $sql="Select * from zpravy where id=".$id;
              $spojeni = MysqlSpojeni('intranet');      
              $res = PrSql($spojeni,$sql);
              $zaznam = mysqli_fetch_array($res);
              $nadpis=$zaznam["nadpis"];
              $text=$zaznam["text"];
              $zverejnitod=date("j.n.Y",strtotime($zaznam['zverejnitod']));
              if ($zaznam['zverejnitdo']) $zverejnitdo=date("j.n.Y",strtotime($zaznam['zverejnitdo']));
              $vlozil=$zaznam["vlozil"];
              $nazevprilohy=$zaznam["nazevprilohy"];
              
          
          }
          else {
              $nadpis=$_POST["nadpis"];
              $text=$_POST["e1m1"];
              $zverejnitod=$_POST["zverejnitod"];        
              $zverejnitdo=$_POST["zverejnitdo"];
              $vlozil=$_POST["vlozil"];
              $nazevprilohy=$_POST["nazevprilohy"];        
          }
          if ($odeslat) {
            if (!$text) {
              $chyba.=" text zprávy";
              $carka=",";
            }
            if (!$nadpis) {
              $chyba.=$carka." nadpis zprávy ";
              $carka=",";
            }
            if (!$zverejnitod) {
              $chyba.=$carka." Datum zveřejnění  ";
              $carka=",";
            }
          }    
          if ($odeslat && !$chyba) {
                $tmp_name = $_FILES["userfile"]["tmp_name"];
                $name = $_FILES["userfile"]["name"];
                if ($tmp_name) {$soubor="./dokumenty/prilohy/".$name;}
                $zverejnitod=convertTime('%Y-%m-%d','%d.%m.%Y',$zverejnitod);
                if ($zverejnitdo) { $zverejnitdo="'".convertTime('%Y-%m-%d','%d.%m.%Y',$zverejnitdo)."'";}
                else {$zverejnitdo="null";}
                if ($odeslat=="Uložit") {
                  $nazevprilohy="null";
                  if ($tmp_name) {
                      $nazevprilohy="'".$_POST["nazevprilohy"]."'";
                      if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
                         echo "Soubor ". $_FILES['userfile']['name'] ." byl úspěšně nahrán.\n";
                         move_uploaded_file($tmp_name, $soubor);
                      } else {                                                                              
                         echo "Přenos souboru se nedařil: ";
                         echo "soubor '". $_FILES['userfile']['tmp_name'] . "'.";
                      }
                   }
                    $sql = "INSERT INTO zpravy (nadpis,text,zverejnitod,zverejnitdo,soubor,nazevprilohy,zverejnil,datumvlozeni) VALUES ('$nadpis','$text','$zverejnitod',$zverejnitdo,'$soubor',$nazevprilohy,'$vlozil',NOW())";
                    $spojeni = MysqlSpojeni('intranet');
                    $res = PrSql($spojeni,$sql );
                     echo "Dokument byl úspěšně uložen.";
                }
                else {
                    $id=$_POST["id"];
                    $tmp_name = $_FILES["userfile"]["tmp_name"];
                    $name = $_FILES["userfile"]["name"];
                    if ($tmp_name) {$soubor="./dokumenty/prilohy/".$name;}
                    if ($tmp_name) {
                      $sqlsoubor=",soubor='$soubor'";
                      if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
                           echo "Soubor ". $_FILES['userfile']['name'] ." byl úspěšně nahrán.\n";
                           move_uploaded_file($tmp_name, $soubor);
                        } else {                                                                              
                           echo "Přenos souboru se nedařil: ";
                           echo ",soubor '". $_FILES['userfile']['tmp_name'] . "'.";
                        }
                    }
                    else {
                      $sqlsoubor="";
                    }
                    $sql = "UPDATE zpravy SET nadpis='$nadpis', text='$text', zverejnitod='$zverejnitod',zverejnitdo=$zverejnitdo $sqlsoubor where id=$id";
                    $spojeni = MysqlSpojeni('intranet');
                    $res = PrSql($spojeni,$sql );
                    echo "Dokument byl úspěšně aktualizován.";                    
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
      	<form name="dokument" ENCTYPE="multipart/form-data"  method="post" action="?sekce=managment&pod=pridatz">
          <table>
          <tr>
            <td>Nadpis zprávy :</td>
            <td><input name="nadpis" type="text" size="50" value="<?echo $nadpis ?>"></td>
          </tr>
          <tr>
            <td>Text zprávy :</td>
            <td>
      		<div>
      			<textarea id="elm1" name="e1m1" rows="15" cols="80" style="width: 80%" class="tinymce">
                      <?echo $zaznam["text"]?>
      			</textarea>
      		</div>
      
      		<!-- Some integration calls -->
      		<a href="javascript:;" onclick="$('#elm1').tinymce().show();return false;">[Show]</a>
      		<a href="javascript:;" onclick="$('#elm1').tinymce().hide();return false;">[Hide]</a>
      		<a href="javascript:;" onclick="$('#elm1').tinymce().execCommand('Bold');return false;">[Bold]</a>
      		<a href="javascript:;" onclick="alert($('#elm1').html());return false;">[Get contents]</a>
      		<a href="javascript:;" onclick="alert($('#elm1').tinymce().selection.getContent());return false;">[Get selected HTML]</a>
      		<a href="javascript:;" onclick="alert($('#elm1').tinymce().selection.getContent({format : 'text'}));return false;">[Get selected text]</a>
      		<a href="javascript:;" onclick="alert($('#elm1').tinymce().selection.getNode().nodeName);return false;">[Get selected element]</a>
      		<a href="javascript:;" onclick="$('#elm1').tinymce().execCommand('mceInsertContent',false,'<b>Hello world!!</b>');return false;">[Insert HTML]</a>
      		<a href="javascript:;" onclick="$('#elm1').tinymce().execCommand('mceReplaceContent',false,'<b>{$selection}</b>');return false;">[Replace selection]</a>
      
          </td>
          </tr>
          <tr>
            <td>Zveřejnit od :</td>
            <td><input name="zverejnitod" class="tcal" value="<?echo $zverejnitod?>" type="text" size="20">
            	<script language="JavaScript">
            	new tcal ({
            		// form name
            		'formname': 'dokument',
            		// input name
            		'controlname': 'zverejnitod'
            	});
            	</script>
            </td>
          </tr>
          <tr>
            <td>Zveřejnit do :</td>
            <td><input name="zverejnitdo" class="tcal" value="<?echo $zverejnitdo?>" type="text" size="20">
            	<script language="JavaScript">
            	new tcal ({
            		// form name
            		'formname': 'dokument',
            		// input name
            		'controlname': 'zverejnitdo'
            	});
            	</script>
            </td>
          </tr>
          <? if ($_SESSION["ip"]=='192.168.10.87') {
          ?>
          <tr>
            <td>Vložil : </td>
            <td> <select name="vlozil">
                   <option value="Bc. Ctibor Venus">Bc. Ctibor Venus</option>
                   <option value="Vladimíra Urbášková">Vladimíra Urbášková</option>
                   <option value="MUDr. Dagmar Maltová, MBA">MUDr. Dagmar Maltová, MBA</option>
                 </select>
            
            </td>
          <?
          }
          else {
          ?>
            <td>Vložil : </td>
            <td><input name="vlozil" type="text" size="50" value="<?echo $SESSION["nazev"] ?>"></td>
           <?
          }
          ?>
          </tr>
           <tr>
            <td>Název přílohy :</td>
            <td><input name="nazevprilohy" type="text" size="50" value="<?echo $nazevprilohy ?>"></td>
          </tr>
          <tr>
            <td>Příloha :</td>
            <td><input type="file" name="userfile" ></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input name="odeslat" type="submit" value="<?echo $butt?>"></td>
          </tr>    </table>
          <input type="hidden" name="id" value="<?echo $id?>">
              
        </form>
      	<?
      	}
      } // END function PridatDokument



function Main(){

global $spojeni;


$spojeni= mysqli_connect(SQL_HOST, SQL_USERNAME, SQL_PASSWORD); 
$db=mysqli_select_db($spojeni,SQL_DBNAME);

$prikaz = $_GET["cmd"];
PrSql($spojeni,"SET NAMES utf8");
 
switch ($prikaz) :

  
  case "pridatn":
    Pridatn($spojeni)
    break;


  default:
    SpravaNemovitosti($spojeni,0);
//    Tlacitka($spojeni,0);
endswitch;
}
?>


<LINK href="styl.css" type=text/css rel=stylesheet>

<TITLE>Sprava alba</TITLE>


</head>

<body id=form1 name=form1  text="#003399"  >
<?
  Main();

?>  


</TABLE>

</font>
</body>      