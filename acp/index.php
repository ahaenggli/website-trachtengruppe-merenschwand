<?php 
session_start();
error_reporting(E_ALL);
require_once('global.php');
  
  $jss = "";
$inhalt = "";
$news = array();
$archivy = array();
$gals = array();
$Titel_links = "";
$title = "";
$MyDesc = "";
$keywords = "";
$xml = "";
$mobile = '';
$Anchor = '';


$app = '';
$app_menu = '';
/*Sets*/

$page = (!isset($_GET['p']) OR $_GET['p']=='index'OR ($_GET['p']=='neues' && (isset($_GET['id']) && !is_numeric($_GET['id']))))? "startseite": $_GET['p'];


  if(file_exists("./".$page.".php"))require_once("./".$page.".php");
   elseif(file_exists("./templates/".$page.".tpl")) eval("\$inhalt .=\"".gettemplate("./templates/".$page.".tpl")."\";");
    else eval("\$inhalt .=\"".gettemplate("./templates/anfang.tpl")."\";");
//$inhalt = utf8_decode($inhalt);    
//$inhalt = iconv("ISO-8859-1", "UTF-8//TRANSLIT", $inhalt);

eval("\$menu = \"".gettemplate("./templates/menu.tpl")."\";");

eval("\$menu_h = \"".gettemplate("./templates/menu.tpl")."\";");
eval("outtpl(\"".gettemplate("./templates/neu_index.tpl")."\");");





?>