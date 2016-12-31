<?php 
$Anchor = (check_mobile())? "#main":'';

$klick = '<div class="design design-info" style="width:360px;margin:auto;">Mit einem Klick auf ein Bild sehen Sie es in voller Gr&ouml;sse.</div>';

$images ='';

// Name des Scriptes
$progname = "foto_galerie.php";

$is_img = false;


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
$klick = '';
}
// und Default Startzahl setzen...
if(!isset($los) || $los == 0) {
$los = 1;
} 

// Daten pro Seite
 $jss = '<script type="text/javascript" src="'.$__PageRoot.'/js/foto_galerie_albumpics_'.$galnr.'.js"></script>';
 
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
'<div class="noscript MobileHide slideshow" style="width:200px;margin:auto;"><a href="#"  onclick="$.prettyPhoto.open(api_gallery,api_titles,api_descriptions); return false" title="Start Slideshow">Start Slideshow</a></div>':"";

$daten_per_site = (isset($_GET['img']) && is_numeric($_GET['img']))? 1:18;
// Ausgabespalten der Tabelle
$spalten = (isset($_GET['img']) && is_numeric($_GET['img']))? 1:3;
// Auslesen des Verzeichnisses mit der list_files function
$pic = ($is_img)? list_files('./images/galerie/'.$gal[0].'/bilder/','jpg'):list_files('./images/galerie/'.$gal[0].'/thumbs/','jpg');
$picG = list_files('./images/galerie/'.$gal[0].'/bilder/','jpg');
  
  
$file = file('./images/galerie/'.$gal[0].'/infos.txt');
  $beschreibung = $file[0];$file[0]='';
  $galerie_beschrieb = implode('<br>', $file).'<br>';


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

$images.=''.$navigationslinks.'<div  class="design design-ok galerie gallery"> <table>';


// Daten ausgeben des aktuellen Bereiches
$start     = 0;
$rows     = 0;
for ($i = $anz;  $i <= ($anz-1) + $daten_per_site; $i++) {
$pic[$i] = $i <= $zeilen -1  ? $pic[$i] : '&nbsp;'; 
$start++;

if(!$is_img){ 
// $lll = "<td><a href=\"".$__PageRoot.'/'.$pic[$i]."\"  rel=\"prettyPhoto[gallery1]\" title=\"Zeige Bild\">";
// $lll.= "<img style=\"border:0px;\" src=\"".$__PageRoot.'/'.$pic[$i]."\" alt=\"img_".$galnr."-".($i+1)."\"></a></td>";

 $n = explode('/', $pic[$i]);
$n = $n[count($n)-1];
 
 $d = explode('.', $n);
 $d = $d[0];
 $d = trim($d);
 $d = (!empty($d))? './images/galerie/'.$gal[0].'/txt/'.$d.'.txt':'';
 $d = (!empty($d))? (@implode("", @file($d))):'';   
 
 $lll = "<td><a href=\"".str_replace('thumbs', 'bilder', $pic[$i])."\"  rel=\"prettyPhoto[gallery1]\" title=\"$d\">";
 $lll.= "<img style=\"border:0px;\" src=\"".$pic[$i]."\" alt=\"\"></a></td>";

 
 }else{
 
 $n = explode('/', $pic[$i]);
$n = $n[count($n)-1];
 
 $d = explode('.', $n);
 $d = $d[0];
 $d = trim($d);
 $d = (!empty($d))? './images/galerie/'.$gal[0].'/txt/'.$d.'.txt':'';
 $d = (!empty($d))? (@implode("", @file($d))):'';   
 $lll = '<td><figure style="padding:0px;margin:0px;" class="bild_einzel"><img style="border:0px;" src="'.$pic[$i].'" alt="img_'.$galnr.'-'.($i+1).'"><figcaption>'.$d.'</figcaption></figure></td>';
 }
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


$images.='</table></div>'.$navigationslinks;

} else {
$images.= "Keine Daten gefunden!\n";
}
eval("\$inhalt = \"".gettemplate("./templates/galerie.tpl")."\";");
?>
