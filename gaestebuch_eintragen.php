<?php
$file = "gaestebuch_eintragen.html";
$Zahl_1 = intval(rand(1, 5));
$Zahl_2 = intval(rand(1, 5));
$error = "";
$vorschau = "";
$zahl = md5(md5(md5(md5($Zahl_1 + $Zahl_2))));
$datum = date("d.m.Y - H:i", time());


$website = (isset($_POST['website']) AND !empty($_POST['website']))? sicherung($_POST['website']):"";
$email = (isset($_POST['email']) AND !empty($_POST['email']))? sicherung($_POST['email']):"";
$inhalt = (isset($_POST['inhalt']) AND !empty($_POST['inhalt']))? sicherung($_POST['inhalt']):"";
$name  = (isset($_POST['name']) AND !empty($_POST['name']))? sicherung($_POST['name']):"";

if(isset($_POST['vorschau'])){
$website2 = (isset($website) AND !empty($website))? '<a href="'.addslashes(strip_tags($website)).'">[Homepage]</a>':"";
$email2 = (isset($email) AND !empty($email))? '<a href="'.addslashes(strip_tags($email)).'">[E-Mail]</a>':"";
$vorschau .= '
<div class="alert alert-success">
<b>Vorschau:</b>  <br>
<table align="center" border="1" cellspacing="0" cellpadding="5" width="75%">  <tr><td>Eintrag von <b>'.addslashes(strip_tags($name)).'</b> 
&nbsp;       '.$website2.'      '.$email2.'      <br>Am '.$datum.'       <br></td>  </tr>  <tr>   <td>  
 '.smilies(bbcode(addslashes(strip_tags($inhalt)))).'      </td>  </tr></table>
</div><br><br>
';
$true = false;
}

if(isset($_POST['submit']))
{
$true=true;
if($_POST['number'] != md5(md5(md5(md5(($_POST['arithmetic']))))))
{ 
$error .='<div class="alert alert-error">Rechenaufgabe falsch gelöst!</div>';
$true=false;
}

$db = new mysql;
$db->connect();

if(empty($_POST['name']) || empty($_POST['inhalt']))// || ereg_replace(" ", "", $_POST['name'])=="")// || empty(ereg_replace(" ", "", $_POST['inhalt'])))
  {
    $true=false;
    $error = '<div class="alert alert-error">Bitte die Felder "Name" und "Eintrag" ausf&uuml;llen, danke!</div>';
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
$error .='<div class="alert alert-success">Beitrag erfolgreich gespeichert.<br>
         Er wird so schnell wie m&ouml;glich freigeschaltet.</div>';

}
   else {
   $error .="Fehler beim Speichern<br>";
   }
   


}
}

eval("\$inhalt =\"".gettemplate("./templates/gaestebuch_eintragen.tpl")."\";");
?>
