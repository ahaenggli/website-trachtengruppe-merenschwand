<?php 
 // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - #
// Seitennavigation
// $navigationslinks = pager($zeilen, $seite, $daten_per_site, $url, $show_pageinfo);
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - #
function pager($zeilen, $seite, $pro_seite, $url, $show_pageinfo = 1, $is_img = 0) {

$max_ausgabe = $pro_seite;
$gesamtseiten = floor(($zeilen - 1) / $pro_seite+1);

$aktuelle_seite = $seite ? $seite : 1;
$linkanzahlausgabe = 2;

$letzte = $linkanzahlausgabe + $aktuelle_seite;
if ($letzte > $gesamtseiten) {
$letzte = $gesamtseiten;
}

$startback = $aktuelle_seite - $linkanzahlausgabe;
if ($startback < 1) {
$startback = 1;
}

$navigationslinks = "&nbsp;";
if ($gesamtseiten != 1 && $zeilen) {
$seitenlink = "";

if ($startback > 1) {
$prevbl = $aktuelle_seite - 1;
$seitenlink .=  "<td class=\"pl\"><a href=\"".$url."-1.shtml\" title=\"Erste Seite aufrufen\">&#171; &#171;</a></td><td class=\"pl\"><a href=\"$url-$prevbl.shtml\" title=\"Eine Seite zurück\">&#171;</a></td>";
}

for ($i = $startback; $i <= $letzte; $i++) {
if ($aktuelle_seite == "$i") {
$seitenlink .= "<td class=\"aktuelleseite\">$i</td>";
} else {
$seitenlink .= "<td class=\"pl\"><a href=\"".$url."-".$i.".shtml\">$i</a></td>";
}
}

if ($letzte < $gesamtseiten) {
$nextbl = $aktuelle_seite + 1;
$seitenlink .= "<td class=\"pl\"><a href=\"".$url."-".$nextbl.".shtml\" title=\"Eine Seite weiter\">&#187;</a></td><td class=\"pl\"><a href=\"".$url."-".$gesamtseiten.".shtml\" title=\"Letzte Seite aufrufen\">&#187; &#187;</a></td>";
}

if ($show_pageinfo == 1) $pageinfo = "<td class=\"seiteninfo\">Seite: $aktuelle_seite von $gesamtseiten</td>"; else $pageinfo = '';
if ($is_img>0) $galtext = " <td style=\"padding-left:3px;\"> <a href=\"galerie_".$is_img."-1.shtml\"> Zur&uuml;ck zur Galerie</a></td>"; else $galtext = '';
$navigationslinks = "<table cellspacing=\"1\" cellpadding=\"0\" border=\"0\" class=\"sitenav\"><tr>$pageinfo $seitenlink $galtext</tr></table>";
}

return $navigationslinks;
}



$images ='';

// Name des Scriptes
$progname = "iweb.php";
$is_img = false;
require_once("global.php");
if(isset($_GET['gal'])) { 
$galnr = intval($_GET['gal'])+0;
} 
// und Default Startzahl setzen...
if(!isset($galnr) || $galnr == 0) {
$galnr = 1;
}

// wenn Seitenvariable gesetzt, entschaerfen...
if(isset($_GET['los'])) { 
$los = intval($_GET['los'])+0;
} 
if(isset($_GET['img']) && is_numeric($_GET['img'])) {
$is_img = true; 
$los = intval($_GET['img'])+0;
}
// und Default Startzahl setzen...
if(!isset($los) || $los == 0) {
$los = 1;
} 

// Daten pro Seite
 $jss = '<script type="text/javascript" src="./iwebalbumpics_'.$galnr.'.js"></script>';
 
 $gals2 =  (list_all('./images/galerie/'));  $gals=array();
foreach ($gals2 as $tmp){
$tmpa =  list_all($tmp.'/');

foreach ($tmpa as $tt) $gals[] =  $tt;
}
 arsort($gals);
 $ldir = $gals;//list_dirs('./images/galerie/');
    $gal=array();$gal[]="";

 $gal[0] =  str_replace("./images/galerie/", "", $ldir[$galnr-1])  ;
   
//$gal = explode('|', $desc[]); 

$slideshow = ($is_img == false)?
'<div id="slideshow"><a href="#" onclick="return GB_showImageSet(g_'.ranul($gal[0]).', 1, \'startslideshow\')" title="Start Slideshow">Start Slideshow</a></div>':"";

$daten_per_site = (isset($_GET['img']) && is_numeric($_GET['img']))? 1:18;
// Ausgabespalten der Tabelle
$spalten = (isset($_GET['img']) && is_numeric($_GET['img']))? 1:3;
// Auslesen des Verzeichnisses mit der list_files function
$pic = ($is_img)? list_files('./images/galerie/'.$gal[0].'/bilder/','jpg'):list_files('./images/galerie/'.$gal[0].'/thumbs/','jpg');
  
  
$file = file('./images/galerie/'.$gal[0].'/infos.txt');
  $beschreibung = $file[0];$file[0]='';
  $galerie_beschrieb = implode('<br>', $file).'<br><br>';
$title = "..:: Galerie: ".ucfirst($beschreibung)." ::..";
    $title = str_replace("ö","&ouml;",$title);
    $title = str_replace("ä","&auml;",$title);
    $title = str_replace("ü","&uuml;",$title);
    $title = str_replace("Ö","&Ouml;",$title);
    $title = str_replace("Ä","&Auml;",$title);
    $title = str_replace("Ü","&Uuml;",$title);  

// Datensatzanzahl festellen des Array pic
$zeilen = count($pic);
// Maximale Seitenanzahl festellen...
$los_max = intval($zeilen / $daten_per_site)+1;
// ... und falls uebeberschritten auf $los_max setzen
$los = (($los > $los_max) OR ($los < 1)) ? $los_max : $los;

// Limit fuer Query erstellen - Eintraege pro Seite 
$anz = ($los-1) * $daten_per_site;

// Wenn Daten anliegen...
if ($zeilen > 0) {
$loi = ($is_img)? 'img':'galerie';
$galr= ($is_img)? $galnr:0;
// Seitennavi mit Parametern aufrufen
$navigationslinks = pager($zeilen, $los, $daten_per_site, $loi.'_'.$galnr.'', 1, $galr);

 $images.='
<table cellspacing="2" cellpadding="1" border="0" align="center">
<tr>
    <td colspan="'.$spalten.'">'.$navigationslinks.'</td>
</tr>     ';


// Daten ausgeben des aktuellen Bereiches
$start     = 0;
$rows     = 0;
for ($i = $anz;  $i <= ($anz-1) + $daten_per_site; $i++) {
$pic[$i] = $i <= $zeilen -1  ? $pic[$i] : '&nbsp;'; 
$start++;
 $lll = "<td><a href=\"#\" onclick=\"return GB_showImageSet2(g_".ranul($gal[0]).", ".($i+1).", 'showimage')\" title=\"Start Slideshow\">";
 /*<!--<a href=\"img_".$galnr."-".($i+1).".shtml\">-->*/
 
 $lll.= "<img style=\"border:0px;\" src=\"".$pic[$i]."\"></a></td>";
if ($pic[$i] != '&nbsp;' && $start == 1) {

$rows++;
$css         = $rows % 2 == 1 ? 'spb' : 'spa';

$images.= "<tr>\n\t$lll\n";     

} elseif ($start > 1 && $start < $spalten && $pic[$i] != '&nbsp;') {
$images.= "\t$lll\n";     

} elseif ($start == $spalten && $pic[$i] != '&nbsp;')  {

$start = 0;
$images.= "\t$lll\n</tr>\n";  

} else {
break;
}
}


$images.='
<tr>
     <td colspan="'.$spalten.'">'.$navigationslinks.'</td>
</tr>
</table>';

} else {
$images.= "Keine Daten gefunden!\n";
}
eval("\$inhalt = \"".gettemplate("./templates/galerie.tpl")."\";");
?>
