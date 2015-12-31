<?php 
include('global.php');
$db = new mysql;
$db->connect();
$db->query("SELECT * FROM gaestebuch WHERE aktiv = 1 ORDER BY id DESC;");
$eintraege = "";
while($row = $db->fetch_array())
{
$inhalt = smilies(bbcode($row['inhalt']));
$datum = date("d.m.Y - H:i", $row['datum']);
$website = ($row['website'] != '')? '<a href="http://'.$row['website'].'" target="_blank">[<u>Homepage</u>]</a>&nbsp;&nbsp;':"";
$email = ($row['email'] != '')? '<a href="mailto:'.$row['email'].'">[<u>E-Mail</u>]</a>':""; 
$kommentar = ($row['kommentar'] != "")? '<b><br>Kommentar:</b><br>':"";
$kommentar = $kommentar.smilies(bbcode($row['kommentar']));
eval("\$eintraege .= \"".gettemplate("./templates/gb_eintrag.tpl")."\";");
}
$db->close();
eval("\$inhalt =\"".gettemplate("./templates/gb.tpl")."\";");
?>