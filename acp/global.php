<?php
/* Funktionen laden */
if($dir=opendir('./functions/'))
{
 while($file=readdir($dir)) {
  if (!is_dir('./functions/'.$file) && $file != "." && $file != "..") require_once('./functions/'.$file);
 }
closedir($dir);
}

$title = 'Admin Control-Panel';
$style = '../css/neu_style.css';
$page = (!isset($_GET['p']) OR $_GET['p']=='index')? "anfang": $_GET['p'];
$inhalt = "";
$menu = "";

  
?>