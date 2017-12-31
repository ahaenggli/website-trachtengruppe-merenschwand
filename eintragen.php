<?php
$file = "eintragen.html";
$Zahl_1 = intval(rand(1, 5));
$Zahl_2 = intval(rand(1, 5));
$error = "";
$vorschau = "";
$zahl = md5(($Zahl_1 + $Zahl_2));
$datum = date("d.m.Y - H:i", time());
if(isset($_POST['vorschau'])){
$website = (isset($_POST['website']) AND !empty($_POST['website']))? '<a href="'.addslashes(strip_tags($_POST['website'])).'">[Homepage]</a>':"";
$email = (isset($_POST['email']) AND !empty($_POST['email']))? '<a href="'.addslashes(strip_tags($_POST['email'])).'">[E-Mail]</a>':"";
$vorschau .= '
<fieldset>
<legend><b>Vorschau:</b></legend>
<table align="center" border="1" cellspacing="0" cellpadding="5" width="75%">  <tr><td>Eintrag von <b>'.addslashes(strip_tags($_POST['name'])).'</b> &nbsp;       '.$website.'      '.$email.'      <br>Am '.$datum.'       <br></td>  </tr>  <tr>   <td>   '.smilies(bbcode(addslashes(strip_tags($_POST['inhalt'])))).'      </td>  </tr></table>
</fieldset><br><br>
';
$true = false;
}
$website = (isset($_POST['website']) AND !empty($_POST['website']))? sicherung($_POST['website']):"";
$email = (isset($_POST['email']) AND !empty($_POST['email']))? sicherung($_POST['email']):"";
$inhalt = (isset($_POST['inhalt']) AND !empty($_POST['inhalt']))? sicherung($_POST['inhalt']):"";
$name  = (isset($_POST['name']) AND !empty($_POST['name']))? sicherung($_POST['name']):"";

if(isset($_POST['submit']))
{
$true=true;
if($_POST['number'] != md5($_POST['arithmetic']))
{ 
$error .="<h1>Rechenaufgabe falsch gelöst!</h1>";
$true=false;
}

$db = new mysql;
$db->connect();

if(empty($_POST['name']) || empty($_POST['inhalt']))// || ereg_replace(" ", "", $_POST['name'])=="")// || empty(ereg_replace(" ", "", $_POST['inhalt'])))
  {
    $true=false;
    $error = 'Bitte die Felder "Name" und "Eintrag" ausf&uuml;llen, danke!';
   }
   if($true == true){
$query = $db->query('INSERT INTO gaestebuch (datum, name, email, inhalt, aktiv, website, kommentar, ip) VALUES 
("'.time().'", 
"'.addslashes(strip_tags($_POST['name'])).'", 
"'.addslashes(strip_tags($_POST['email'])).'", 
"'.addslashes(strip_tags($_POST['inhalt'])).'",  
"0", 
"'.addslashes(strip_tags($_POST['website'])).'", 
"", 
"'.$_SERVER['REMOTE_ADDR'].'");');

if($query == true) 
{
$error .="<h3>Beitrag erfolgreich gespeichert.</h3>";
$error .="<h3>Er wird so schnell wie m&ouml;glich freigeschaltet.</h3>";

}
   else {
   $error .="Fehler beim Speichern<br>";
   }
   


}
}

eval("\$inhalt =\"".gettemplate("./templates/eintragen.tpl")."\";");
?>
