<?php 
session_start();
error_reporting(E_ALL);
require_once('global.php');
  
  if(file_exists("./".$page.".php"))require_once("./".$page.".php");
   elseif(file_exists("./templates/".$page.".tpl")) eval("\$inhalt .=\"".gettemplate("./templates/".$page.".tpl")."\";");
    else eval("\$inhalt .=\"".gettemplate("./templates/anfang.tpl")."\";");


eval("\$menu = \"".gettemplate("./templates/menu.tpl")."\";");
eval("outtpl(\"".gettemplate("./templates/index.tpl")."\");");
require_once("stat.php");
?>