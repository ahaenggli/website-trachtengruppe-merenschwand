<?php

$db = new mysql;
$db->connect();

if(isset($_GET['id']) && ($_GET['id'] > 0)){ 
$select = $db->query("SELECT * FROM cms WHERE id='".$_GET['id']."' LIMIT 1;"); 
$row = $db->fetch_array();
$header   = $row['header'];
$header = bbcodes_news($header);
$message  = $row['message'];
$message = bbcodes_news($message);
$archiv = "";
$header = str_replace("klee.gif", "klee.png", $header);
$message= str_replace("&", "&amp;", $message);
$message= str_replace("\n", "<br>", $message);
$message= str_replace("ä", "&auml;", $message);
$message= str_replace("ö", "&ouml;", $message);
$message= str_replace("ü", "&uuml;", $message);
$message= str_replace("Ä", "&Auml;", $message);
$message= str_replace("Ö", "&Ouml;", $message);
$message= str_replace("Ü", "&Uuml;", $message);
$message= str_replace("é", "&eacute;", $message);
$header= str_replace("&", "&amp;", $header);
$header= str_replace("\n", "<br/>", $header);
$header= str_replace("ä", "&auml;", $header);
$header= str_replace("ö", "&ouml;", $header);
$header= str_replace("ü", "&uuml;", $header);
$header= str_replace(" & ", " &amp; ", $header);
$header= str_replace("Ä", "&Auml;", $header);
$header= str_replace("Ö", "&Ouml;", $header);
$header= str_replace("Ü", "&Uuml;", $header);
$header = str_replace("*","'", $header);
$header = str_replace("@", "\"", $header);
$message = str_replace("*","'", $message);
$message = str_replace("@", "\"", $message);
$message = str_replace("<br><li", "<li", $message);
$message = str_replace("<br></ul", "</ul", $message);

$archiv = (preg_match('#Geburtstag#', $header))? '':'<div class="right" style="font-size:10px;margin-top:-10px;"><a href="archiv_'.$row['id'].'.shtml" class="hell">[Direktlink: '.$header.']</a></div>';
$datum    = (preg_match('#Geburtstag#', $header))? "":'('.date("d.m.Y", $row['datum']).')';


eval("\$inhalt .=\"".gettemplate("./templates/neues.tpl")."\";"); 
}else{
if (isset($_GET['id']) && $_GET['id'] == -1) $db->query("SELECT * FROM cms WHERE header not like '%Geburtstag%' ORDER BY id DESC");
else $db->query("SELECT * FROM cms WHERE aktiv = '1' ORDER BY id DESC");
while($row = $db->fetch_array()){
$header   = $row['header'];
      
$header = bbcodes_news($header);
$message  = $row['message'];

$message = bbcodes_news($message);
$header = str_replace("klee.gif", "klee.png", $header);
$message= str_replace("&", "&amp;", $message);
$message= str_replace("\n", "<br>", $message);
$message= str_replace("ä", "&auml;", $message);
$message= str_replace("ö", "&ouml;", $message);
$message= str_replace("ü", "&uuml;", $message);
$message= str_replace("Ä", "&Auml;", $message);
$message= str_replace("Ö", "&Ouml;", $message);
$message= str_replace("Ü", "&Uuml;", $message);
$message= str_replace("é", "&eacute;", $message);
$header= str_replace("&", "&amp;", $header);
$header= str_replace("\n", "<br/>", $header);
$header= str_replace("ä", "&auml;", $header);
$header= str_replace("ö", "&ouml;", $header);
$header= str_replace("ü", "&uuml;", $header);
$header= str_replace(" & ", " &amp; ", $header);
$header= str_replace("Ä", "&Auml;", $header);
$header= str_replace("Ö", "&Ouml;", $header);
$header= str_replace("Ü", "&Uuml;", $header);
$header = str_replace("*","'", $header);
$header = str_replace("@", "\"", $header);
$message = str_replace("*","'", $message);
$message = str_replace("@", "\"", $message);
$message = str_replace("<br><li", "<li", $message);
$message = str_replace("<br></ul", "</ul", $message);

$archiv = (preg_match('#Geburtstag#', $header))? '':'<div class="right" style="font-size:10px;margin-top:-10px;"><a href="archiv_'.$row['id'].'.shtml" class="hell">[Direktlink: '.$header.']</a></div>';
$datum    = (preg_match('#Geburtstag#', $header))? "":'('.date("d.m.Y", $row['datum']).')';

eval("\$inhalt .=\"".gettemplate("./templates/neues.tpl")."\";"); 
}
}
$db->close();
?>

