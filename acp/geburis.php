<?php
include('global.php');
$db = new mysql;
$db->connect();
$file = "geburis.html";
$eintrag = "";
  
if(!isset($_POST['beab'])){

$name = "beab";
$button = "Bearbeiten";

$db->query("SELECT * FROM cms WHERE header like '%Geburtstag%' ORDER BY id DESC;");

while($row = $db->fetch_array())
{
$header   = $row['header'];
$header = bbcodes_news($header);

$header = str_replace("*", '"', str_replace("./ima", "../ima", str_replace("´", "'", $header)));



$message  = $row['message'];
$message = bbcodes_news($message);

$message = str_replace("´", "'", $message);$message = str_replace("@", "\"", $message);
                  $message = str_replace("*", "'", str_replace("./ima", "../ima", str_replace("´", "'", $message)));
$aktiv    = $row['aktiv'];
$datum    = $row['datum'];
$id       = $row['id'];
eval("\$eintrag .= \"".gettemplate("./templates/cms_eintrag.tpl")."\";");
}

}

if(isset($_POST['beab']))
{
$db->query("SELECT * FROM cms WHERE id='".$_POST['id']."' LIMIT 1;");
$name = "save";
$button = "Speichern";
while($row = $db->fetch_object()){
$header   = (($row->header));


$message  = $row->message;
$header = str_replace("'", "´", $header);
$message = str_replace("'", "´", $message);$message = str_replace("\"", "@", $message);

$aktiv    = $row->aktiv;
$datum    = $row->datum;
$id       = $row->id;
$message  = str_replace("<br>","\n", $message);
eval("\$eintrag .= \"".gettemplate("./templates/cms_hinzu.tpl")."\";");
}
}

if(isset($_POST['save'])){
$u = $db->query("UPDATE cms SET 
header='".oldnews_2_bbcodes(addslashes($_POST['header']))."', 
message='".oldnews_2_bbcodes(str_replace("\n", "<br>", $_POST['message']))."', 
aktiv='".$_POST['aktiv']."' 
WHERE id=".$_POST['id'].";");
$eintrag = ($u == true)? "Erfolgreich ge&auml;ndert":"Fehler beim &auml;ndern";
}

eval("\$inhalt .=\"".gettemplate("./templates/cms.tpl")."\";");
?>
