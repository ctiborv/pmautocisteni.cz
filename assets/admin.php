<?
define('X_VISUAL_NAHLED', '940');   // RIGHT - Works OUTSIDE of a class definition.
define('Y_VISUAL_NAHLED', '500');
define('X_VISUAL_VELKE', '1200');   // RIGHT - Works OUTSIDE of a class definition.
define('X_DUM_NAHLED', '222');   // RIGHT - Works OUTSIDE of a class definition.
define('Y_DUM_NAHLED', '117');
define('X_PUDORYS_NAHLED', '474');   // RIGHT - Works OUTSIDE of a class definition.
define('Y_PUDORYS_NAHLED', '380');
define('X_PUDORYS_VELKE', '1200');   // RIGHT - Works OUTSIDE of a class definition.
define('CESTA_OBRAZKY', 'images/domy/');   // RIGHT - Works OUTSIDE of a class definition.
define('CESTA_SOUBORY', 'files/');   // RIGHT - Works OUTSIDE of a class definition.


global $glspojeni;
global $pokus;
include("include/db.php");
include("include/admfunkce.php"); 
echo $_SESSION["id"];
$glspojeni = MysqlSpojeni();
$GLOBALS["spojeni"]=$glspojeni;
if (!$_SESSION["id"]) InitSession();
?>
<!DOCTYPE html>


<html lang="cs">
<head>
    <title>Koně řídeč - Admin</title>
    
    <meta name="author" content="Ctibor Venus"/>
    <meta name="Googlebot" content="index,follow,archive" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0" />
	<!-- <link rel="icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" /> -->
    <link rel="stylesheet" href="css/reset.css" media="screen" />
    <link rel="stylesheet" href="css/style.css" media="screen" />
    <link rel="stylesheet" href="css/ui.totop.css" />
    <link rel="stylesheet" href="css/caption.css" />
    <link rel="stylesheet" href="css/admin.css" />
    
    <link rel="stylesheet" type="text/css" href="fancy/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<!-- place in header of your html document -->
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="fancy/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="fancy/fancybox/jquery.fancybox-1.3.4.pack.js"></script>


<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script>
<script>
tinymce.init({
    selector: "textarea#e1m1",
    theme: "modern",
    width: 800,
    height: 400,
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern jbimages"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
    language : 'cs',
    image_advtab: true,
    media_alt_source: true, 
    relative_urls:false,
   content_css: "css/content.css"
 }); 
</script>
    
</head>
<html>
<div class="admin">

  <!--==============================header=================================-->    
    <header>    	
      <div class="index-2">	      	
        <div class="container_12">	        	
          <div class="grid_12">	            	
            <div class="header-top">	                	
              <div class="wrapper">	                    	
                <div class="slogon">
                </div>	                    	
                <div class="fleft float-none-sw">				        		<h1>
                    <a href="?">Koně ŘÍDEČ</a></h1>	                        
                </div>	                	                    
              </div>	                
            </div>	                
            <nav id="main-menu">	                    
              <div class="menuback"> 
              </div>	                    
              <div class="clear">
              </div>	                
            </nav>	            
          </div>	        
        </div>        
      </div>      
    </header>  
 <div class="index-1">        	        
      <div class="slider-wrapper">	        	
        <div class="slider-left">	            	
          <div class="slider-right">				        
            <div class="slidesa">   				                      
              <div id="karta-domu33"> 
    
   <div id="text-admin">
  <?    

$cmd=$_GET["cmd"];
  switch ($cmd)     {
    case "prKoneMenu":
      prKoneMenu($spojeni);
      break;
    case "editKoneData":
      editKoneData($spojeni);
      break;
    case "zobrazKoneMenu":
      zobrazKoneMenu($spojeni);
    break;
    case "zobrazhlavni_Menu":
    zobrazHlavni_Menu($spojeni);
    break;
    case "edithlavni_Data":
      $idm=$_GET["idm"];
      $_SESSION["idhmenu"]=$idm;
      editHlavni_Data($spojeni);
      break;
      
    default :
    zobrazAdministraci($spojeni);
  }
    


?>
        
                      </div>                               	                             	                             	                             	                                                
                </div>				            	                  
    </div>	                
                </div>
        </div>	            
        </div>	        
      </div>        
    </div>    

</div>
</html>
 