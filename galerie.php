<?php
include("global.php");
$db = new mysql;
$db->connect();
$images="";
$desc = array(
'1'=>'Heimatabend 2007',
'2'=>'GV 2008',
'3'=>'Kindertanzgruppe',
'4'=>'Diverses',
'5'=>'75-Jahr Jubil&auml;um',
'6'=>'<nobr>Delegiertenversammlung und Volksztanztreffen Herisau Samstag 14. Juni 08</nobr>',
'7'=>'<nobr>Delegiertenversammlung und Volksztanztreffen Herisau Sonntag 15. Juni 08</nobr>',
'8'=>'Trachtengruppe Merenschwand im Z&uuml;rcher Oberland',
'9'=>'85. Geburtstag Marie Burkart',
'10'=>'Chlaushock 2008',
'11'=>'Generalversammlung 2009',
'12'=>'Geburtstagsausfahren 24. Juni 2009',
'13'=>'Chlaushock 2009',
'14'=>'&quot;Heimatobig&quot;'  ,
'14'=>'Wanderung Freiämterweg'
);
$_GET['gal'] = (isset($_GET['gal']))? $_GET['gal']:"1-1";
$ex = explode('-',$_GET['gal']);
$g_id =  ($ex[0] != "" && is_numeric($ex[0])) ? $ex[0] : "1";
$seite = ($ex[1] != "" && is_numeric($ex[1])) ? $ex[1] : "1";
$beschreibung = $desc[$g_id];

if(isset($_GET['imgid']))
{
$ex = explode('-',$_GET['imgid']);
$imgid = (is_numeric($ex[0]))? $ex[0]:1;

$db->query("SELECT * FROM galerie WHERE id=".$imgid.";");
$row = $db->fetch_object();
$bild = $row->url;
$id = $row->id;
$ueb = '<a href="./galerie_'.$row->g_id.'-'.$row->seite.'.shtml"><b>&Uuml;bersicht</b></a>';

$nowa = $db->fetch_object($db->query("SELECT g_id FROM galerie WHERE id=".($id+1).";"));
$weiter = ($nowa->g_id == $row->g_id)? '<a href="./img_'.(($row->id)+(1)).'-'.$row->seite.'.shtml"><b>Weiter</b></a>':"<b>Weiter</b>";

$nowb = $db->fetch_object($db->query("SELECT g_id FROM galerie WHERE id=".($id-1).";"));
$zur =    ($nowb->g_id == $row->g_id)? '<a href="./img_'.(($row->id)-(1)).'-'.$row->seite.'.shtml"><b>Zur&uuml;ck</b></a>':'<b>Zur&uuml;ck</b>';

eval("\$inhalt = \"".gettemplate("./templates/galerie_bild.tpl")."\";");
}
else
{

$eintraege_pro_seite = 25;
$start = $seite * $eintraege_pro_seite - $eintraege_pro_seite;


$db->query("SELECT * FROM galerie WHERE g_id = $g_id ORDER BY id LIMIT $start, $eintraege_pro_seite ;");
$i = 0;
while($row = $db->fetch_object())
    {
if($i==0){ $images .='<tr>';}

$images .='<td><a href="./img_'.$row->id.'-'.$seite.'.shtml"><img style="border:0px;" src="'.$row->tumb.'"></a></td>';
$i++;
if($i==3){ $images .='</tr>'; $i=0;}
    }

$db->query("SELECT id FROM galerie WHERE g_id=$g_id");
$menge = $db->num_rows();

$wieviel_seiten = $menge / $eintraege_pro_seite;

$inhaltsverzeichnis="";
for($a=0; $a < $wieviel_seiten; $a++)
   {
   $b = $a + 1;
   if($seite == $b)
      {
      $inhaltsverzeichnis .= "  <b>$b</b> ";
      }
   else
      {
      $inhaltsverzeichnis .= ' <a href="./galerie_'.$g_id.'-'.$b.'.shtml">'.$b.'</a> ';
      }
   }
$seitennav = ($inhaltsverzeichnis=='  <b>1</b> ')? ' ':'<b><h2>Seite:</b> '.$inhaltsverzeichnis.'</h2>';
eval("\$inhalt = \"".gettemplate("./templates/galerie.tpl")."\";");
}
?> 
