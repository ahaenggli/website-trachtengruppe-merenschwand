<?php
include('global.php');
$db = new mysql;
$db->connect();
$file = "cms_del.html";
$eintrag = "";
  
if(!isset($_POST['delete'])){

$name = "delete";
$button = "L&ouml;schen";

$db->query("SELECT * FROM cms WHERE header not like '%Geburtstag%' ORDER BY id DESC;");

while($row = $db->fetch_array())
{
$header   = $row['header'];$header = str_replace("*", '"', str_replace("./ima", "../ima", str_replace("´", "'", $header)));
$message  = $row['message'];$message = str_replace("´", "'", $message);$message = str_replace("@", "\"", $message);
                  $message = str_replace("*", "'", str_replace("./ima", "../ima", str_replace("´", "'", $message)));
$aktiv    = $row['aktiv'];
$datum    = $row['datum'];
$id       = $row['id'];
eval("\$eintrag .= \"".gettemplate("./templates/cms_eintrag.tpl")."\";");
}

}

if(isset($_POST['del']))
{
$db->query("SELECT * FROM cms WHERE id='".$_POST['id']."' LIMIT 1;");
$name = "delete";
$button = "L&ouml;schen";
while($row = $db->fetch_object()){
$header   = addslashes(addslashes($row->header));
$message  = $row->message;
$aktiv    = $row->aktiv;
$datum    = $row->datum;
$id       = $row->id;
$message  = str_replace("<br>","\n", $message);
eval("\$eintrag .= \"".gettemplate("./templates/cms_hinzu.tpl")."\";");
}
}

if(isset($_POST['delete'])){
$u = $db->query("DELETE FROM cms WHERE id=".$_POST['id'].";");
$eintrag = ($u == true)? "Erfolgreich gel&ouml;scht":"Fehler beim l&ouml;schen";
}

eval("\$inhalt .=\"".gettemplate("./templates/cms.tpl")."\";");
?>
