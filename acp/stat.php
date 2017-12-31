<?php 
include("global.php");
$ip = $_SERVER['REMOTE_ADDR'];
$file = "stat.html"; 
$users = "";
$db = new mysql;
$db->connect();
if(isset($_POST['ipl']))   $db->query('DELETE FROM logs WHERE ip = "'.$_POST['ipl'].'";');
if(isset($_POST['log'])) $db->query('DELETE FROM logs WHERE ip = "'.$_POST['log'].'";');
if(!isset($_POST['show'])){
$i=1;
$abfrage = "SELECT count(*) as counter, max(time) as zeit, ip, host, cc, browser, pc 
            FROM logs GROUP BY ip
            HAVING counter > 1 ORDER BY zeit DESC;";
            $db->query($abfrage);
            while($row = $db->fetch_array()){
             $background = ($i % 2) ? '#00DD55' : '#009900;';
            $besuch = date('d.m.Y - H:i:s', $row['zeit']);
            eval("\$users .=\"".gettemplate("./templates/stat_users.tpl")."\";");
            $i++;
            }
  eval("\$inhalt .=\"".gettemplate("./templates/stat.tpl")."\";");
}
  if(isset($_POST['show']))
  { 

  $db->query('SELECT * FROM logs WHERE ip="'.$_POST['show'].'" ORDER BY time DESC');

  $i=1;
  while($row = $db->fetch_array())
  {
             $background = ($i % 2) ? '#00DD55' : '#009900;';

  $row['referer']= ereg_replace('http://www.trachtengruppe-merenschwand.ch/', '', $row['referer']);
  $row['referer']= ereg_replace('http://trachtengruppe-merenschwand.ch/', '', $row['referer']);
  $besuch = date('d.m.Y - H:i:s', $row['time']);
  eval("\$users .=\"".gettemplate("./templates/stat_show_users.tpl")."\";");$i++;
  
  }
    $row = $db->fetch_array($db->query('SELECT ip FROM logs WHERE ip="'.$_POST['show'].'" ORDER BY time DESC'));
  $logs=$row['ip'];
  eval("\$inhalt .=\"".gettemplate("./templates/stat_show.tpl")."\";");
  }
$db->close();
?>