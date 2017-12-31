<?php
include('global.php');
$db = new mysql;
$db->connect();
$file = "gb_freischalten.html";
$eintraege = "";
$button = "Freischalten";
if(!isset($_POST['beab']))
{
$db->query("SELECT * FROM gaestebuch WHERE aktiv!='1' ORDER BY id DESC;");
           
while($row = $db->fetch_array())
{
$inhalt = smilies(bbcode($row['inhalt']));
$datum = date("d.m.Y - H:i", $row['datum']);
$website = ($row['website'] != '')? '<a href="http://'.$row['website'].'" target="_blank">[<u>Homepage</u>]</a>&nbsp;&nbsp;':"";
$email = ($row['email'] != '')? '<a href="mailto:'.$row['email'].'">[<u>E-Mail</u>]</a>':""; 
$kommentar = ($row['kommentar'] != "")? '<b><br>Kommentar:</b><br> '.$row['kommentar']:"";
$kommentar = smilies(bbcode($kommentar));
eval("\$eintraege .= \"".gettemplate("./templates/gb_eintrag.tpl")."\";");
}
   
  }
if(isset($_POST['beab']))
{
$id=$_POST['id'];
$update = $db->query("UPDATE `gaestebuch` SET `aktiv` = '1' WHERE `id` =$id LIMIT 1 ;");
if($update == true) $eintraege = "<h3>Beitrag freigeschalten</h3>";
   else $eintraege = "<h3>Fehler beim Freischalten</h3>";
}
$db->close();
 eval("\$inhalt =\"".gettemplate("./templates/gb_bearbeiten.tpl")."\";");
?>