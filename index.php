<?php 
session_start();
#error_reporting(E_ALL);
require_once('global.php');
/*$cachefile = 'cache/'.basename($_SERVER['REQUEST_URI']);

if ( (file_exists ($cachefile) ) && (time () - filemtime ($cachefile) < 86400) )
{
    echo file_get_contents ($cachefile);
    require_once("stat.php");
    exit ();
}
 
ob_start ();*/


  if(file_exists("./".$page.".php")) require_once("./".$page.".php");
   elseif(file_exists("./templates/".$page.".tpl")) eval("\$inhalt .=\"".gettemplate("./templates/".$page.".tpl")."\";");
    else eval("\$inhalt .=\"".gettemplate("./templates/anfang.tpl")."\";");

eval("\$menu_h = \"".gettemplate("./templates/menu_h.tpl")."\";");
eval("\$menu = \"".gettemplate("./templates/menu.tpl")."\";");

$inhalt = bbcodes_news($inhalt);

eval("outtpl(\"".gettemplate("./templates/index.tpl")."\");");
@require_once("stat.php");
/*$content = ob_get_clean();
$handle = fopen ($cachefile, 'w');
fputs ($handle, $content);
fclose ($handle);
echo $content;*/
?>
