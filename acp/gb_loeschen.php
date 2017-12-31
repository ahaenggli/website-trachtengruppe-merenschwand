<?php
include('global.php');
$db = new mysql;
$db->connect();
$file = "gb_loeschen.html";
$eintraege = "";
$button = "L&ouml;schen";
if(!isset($_POST['beab']))
{
$db->query("SELECT * FROM gaestebuch ORDER BY id DESC;");
           
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
  
  if (isset($_POST['beab']))
{
$id = $_POST['id'];
$update = $db->query("DELETE FROM gaestebuch WHERE id= $id;");
if($update == true) $eintraege = "<h3>Beitrag gel&ouml;scht</h3>";
   else $eintraege = "<h3>Fehler beim L&ouml;schen</h3>";
}
 eval("\$inhalt =\"".gettemplate("./templates/gb_bearbeiten.tpl")."\";");
?>