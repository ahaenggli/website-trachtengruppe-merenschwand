<?php
include('global.php');
$db = new mysql;
$db->connect();
$file = "cms_beab.html";
$eintrag = "";

if(isset($_GET['cms_beab']) && $_GET['cms_beab']=='ok') $_POST['cms_beab'] = 'ok';
elseif(isset($_GET['cms_beab'])) unset($_GET['cms_beab']);
elseif(isset($_POST['cms_beab']) && $_POST['cms_beab']=='ok') $_POST['cms_beab'] = 'ok'; 
elseif(isset($_POST['cms_beab'])) unset($_POST['cms_beab']);

if(isset($_GET['cms_id']) && is_numeric($_GET['cms_id'])) $_POST['cms_id']=$_GET['cms_id'];
elseif(isset($_GET['cms_id'])) unset($_GET['cms_id']);
elseif(isset($_POST['cms_id']) && is_numeric($_POST['cms_id'])) $_POST['cms_id']=$_POST['cms_id'];
elseif(isset($_POST['cms_id'])) unset($_POST['cms_id']);


if(isset($_POST['cms_delete']) && isset($_POST['cms_id'])){
$u = $db->query("DELETE FROM cms WHERE id=".$_POST['cms_id'].";");
$eintrag .= ($u == true)? '<div class="design design-ok">Eintrag Erfolgreich gel&ouml;scht</div>':'<div class="design design-wichtig">Fehler beim L&ouml;schen</div>';
unset($_POST['cms_id']);

}


if(!isset($_POST['cms_beab']) || !isset($_POST['cms_id'])){

$db->query("SELECT * FROM cms WHERE header not like '%Geburtstag%' ORDER BY id DESC;");

while($row = $db->fetch_array())
{
$header   = $row['header'];
$header = str_replace("*", '"', str_replace("./ima", "../ima", str_replace("´", "'", $header)));
$message  = $row['message'];

$message = str_replace("´", "'", $message);
$message = str_replace("@", "\"", $message);
$message = str_replace("*", "'", str_replace("./ima", "../ima", str_replace("´", "'", $message)));

$aktiv    = $row['aktiv'];
$datum    = $row['datum'];
$datum    = date('d.m.Y', $datum);
$id       = $row['id'];
$file = "cms_beab_".$id.".shtml";
eval("\$eintrag .= \"".gettemplate("./templates/cms_eintrag.tpl")."\";");
}

}

if(isset($_POST['cms_beab']) && isset($_POST['cms_id']))
{ 
if(isset($_POST['cms_save'])){
$u = $db->query("UPDATE cms SET 
header='".addslashes(($_POST['cms_header']))."', 
message='".str_replace("\n", "<br>", ($_POST['cms_message']))."', 
aktiv='".$_POST['cms_aktiv']."' 
WHERE id=".$_POST['cms_id'].";");
$eintrag .= ($u == true)? '<div class="design design-ok">Erfolgreich ge&auml;ndert</div>':'<div class="design design-wichtig">Fehler beim &auml;ndern!</div>';
}

$db->query("SELECT * FROM cms WHERE id='".$_POST['cms_id']."' LIMIT 1;");
while($row = $db->fetch_object()){
$header   = (($row->header));

$message  = $row->message;
$header = str_replace("'", "´", $header);
$message = str_replace("'", "´", $message);
$message = str_replace("@","\"",  $message);

$aktiv    = $row->aktiv;
$datum    = $row->datum;
$id       = $row->id;
$file = "cms_beab_".$id.".shtml";
//$message  = str_replace("<br>","\n", $message);
eval("\$eintrag .= \"".gettemplate("./templates/cms_hinzu.tpl")."\";");
}

}

//$eintrag = utf8_decode($eintrag);
//$eintrag = iconv("ISO-8859-1", "UTF-8//TRANSLIT", $eintrag);
eval("\$inhalt .=\"".gettemplate("./templates/cms.tpl")."\";");

if(isset($_POST['cms_beab']) && isset($_POST['cms_id']))
{
 $inhalt.='<br><h2>Bilder verwalten</h2>';
 $_POST['main_jahr'] = 'diverses';
 $dir = '../images/galerie/'.$_POST['main_jahr'].'/';
 $path = $dir.'cms_'.$_POST['cms_id'];
 $__parentFile = $file;
 
      if(!file_exists($path))
      {
      mkdir($path, 0777);     
      chmod($path, 0777);     
      }
      if(!file_exists($path.'/bilder/'))
      {
      mkdir($path.'/bilder/', 0777);     
      chmod($path.'/bilder/', 0777);     
      }
      
      if(!file_exists($path.'/thumbs/'))
      {
      mkdir($path.'/thumbs/', 0777);     
      chmod($path.'/thumbs/', 0777);     
      }
 $DivGalls = list_all($dir);
 $gid = array_keys($DivGalls, $path, false) ;
 $_GET['gid'] = $gid[0];
 
 require_once("gal.php");
}

?>
