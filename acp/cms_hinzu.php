<?php
include('global.php');
$db = new mysql;
$db->connect();
$file = "cms_hinzu.html";
$eintrag = "";
$value = "";
$aktiv = "";
$header = "";
$message = "";
$id = "";
if(!isset($_POST['hinzu'])){
$button = "Neue Nachricht";
$name   = "hinzu";
eval("\$eintrag .=\"".gettemplate("./templates/cms_hinzu.tpl")."\";");
}
if(isset($_POST['hinzu'])){
  
    $header  = $_POST['header'];
    $message = $_POST['message'];
    $aktiv   = (!empty($_POST['aktiv']))? $_POST['aktiv']: "1";
    $datum    = time();
    $message  = str_replace("\n", "<br>", $message );
    
    
    
    $update = $db->query("INSERT INTO cms (header ,message ,aktiv  ,datum)
                          VALUES ('".$header."', '".$message."', '".$aktiv."', '".$datum."');");
$eintrag = ($update == TRUE)? "<h3>Erfolgreich eingetragen</h3>": "<h3>Fehler beim Speichern</h3>";
    }
    $db->close();
eval("\$inhalt .=\"".gettemplate("./templates/cms.tpl")."\";");
?>
