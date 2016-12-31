<?php
include('global.php');
$db = new mysql;
$db->connect();
$file = "gb_bearbeiten.html";
$eintraege = "";
$button = "Bearbeiten";
if(!isset($_POST['beab']))
{
$db->query("SELECT * FROM gaestebuch WHERE aktiv = 1 ORDER BY id DESC;");
$eintraege = "";
while($row = $db->fetch_array())
{
$inhalt = smilies(bbcode($row['inhalt']));
$datum = date("d.m.Y - H:i", $row['datum']);
$website = ($row['website'] != '')? '<a href="http://'.$row['website'].'" target="_blank">[<u>Homepage</u>]</a>&nbsp;&nbsp;':"";
$email = ($row['email'] != '')? '<a href="mailto:'.$row['email'].'">[<u>E-Mail</u>]</a>':""; 
$kommentar = ($row['kommentar'] != "")? '<b><br>Kommentar:</b><br> '.$row['kommentar']:"";
$kommentar = smilies(bbcode($kommentar));

//$inhalt = iconv("ISO-8859-1", "UTF-8//TRANSLIT", $inhalt);

eval("\$eintraege .= \"".gettemplate("./templates/gb_eintrag.tpl")."\";");
}
   
  }

if(isset($_POST['beab']))
{

$id = $_POST['id'];


$db->query("SELECT * FROM gaestebuch WHERE id='".$id."'");
while($row = $db->fetch_object())
    {
/*
$row->inhalt = iconv("ISO-8859-1", "UTF-8//TRANSLIT", $row->inhalt);
$row->name = iconv("ISO-8859-1", "UTF-8//TRANSLIT", $row->name);
$row->kommentar = iconv("ISO-8859-1", "UTF-8//TRANSLIT", $row->kommentar);
*/

eval("\$eintraege .= \"".gettemplate("./templates/gb_bearbeiten_sa.tpl")."\";");
}

}




if (isset($_POST['save']))
{
$name = $_POST["name"];
$email = $_POST["email"];
$inhalt = $_POST["inhalt"];
$website = $_POST["website"];

$kommentar=$_POST['kommentar'];
$aktiv = $_POST['aktiv'];
$ip=$_POST['ip'];
$id=$_POST['id'];

   /*
$inhalt  = utf8_decode($inhalt);
$kommentar  = utf8_decode($kommentar);
$name  = utf8_decode($name);
     */

$update = $db->query("UPDATE `gaestebuch` SET `id` = '$id',`email` = '$email',`name` = '$name',`inhalt` = '$inhalt',`aktiv` = '$aktiv',`website` = '$website',`kommentar` = '$kommentar',`ip` = '$ip' WHERE `id` =$id LIMIT 1 ;");

if($update == true) $eintraege = "<h3>Beitrag erfolgreich gespeichert.";
   else $eintraege = "Fehler beim Speichern";
}
$db->close();
 eval("\$inhalt =\"".gettemplate("./templates/gb_bearbeiten.tpl")."\";");
?>
