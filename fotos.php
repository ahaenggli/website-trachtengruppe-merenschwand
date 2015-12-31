<?php
function pager($zeilen, $seite, $pro_seite, $url) {

$max_ausgabe = $pro_seite;
$gesamtseiten = floor(($zeilen - 1) / $pro_seite+1);

$aktuelle_seite = $seite ? $seite : 1;
$linkanzahlausgabe = 3;

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

$pageinfo = "<td class=\"seiteninfo\">Seite: $aktuelle_seite von $gesamtseiten</td>";
$navigationslinks = "<table cellspacing=\"1\" cellpadding=\"0\" border=\"0\" class=\"sitenav\"><tr>$pageinfo $seitenlink $galtext</tr></table>";
}

return $navigationslinks;
}
$is_y = false;


$gals2 =  (list_all('./images/galerie/'));  $gals=array();
foreach ($gals2 as $tmp){
$tmpa =  list_all($tmp.'/');

foreach ($tmpa as $tt) $gals[] =  $tt;
}           
                                     

arsort($gals);


 if (isset($_GET['y']) && is_numeric($_GET['y']) && is_dir('./images/galerie/'.$_GET['y'].'/')){
 
 $gals2 =  (list_all('./images/galerie/'.$_GET['y'].'/'));
 $is_y = true;
 $title = "[&raquo; Fotogalerie ".$_GET['y'].' &laquo;]';
 for($i=0;$i<count($gals);$i++)
 if(!in_array($gals[$i], $gals2)) $gals[$i]='';
 }
   

  
$eintraege_pro_seite = ($is_y)?999:4;

$anzahl_eintraege = (count($gals)-1);
$aktuelle_seite = (isset($_GET['seite']) and is_numeric($_GET['seite']) and ($_GET['seite']>0) and ($_GET['seite']<$anzahl_eintraege))? $_GET['seite']:1;

$beginn = $anzahl_eintraege - ($aktuelle_seite*$eintraege_pro_seite-$eintraege_pro_seite);
$ende =   $anzahl_eintraege - ($aktuelle_seite*$eintraege_pro_seite)+1;
if ($ende<0) $ende = 0;
$inhalt.= '<h1>Fotogalerie '.(($is_y)?$_GET['y']:"").'</h1><br><center>'.pager($anzahl_eintraege, $aktuelle_seite, $eintraege_pro_seite, "fotos").'</center>';

for($i=$beginn;$i>=$ende;$i--) {
      if ($gals[$i]<>''){  
$lf = list_files($gals[$i].'/');
    
$fc = file($lf[0]);
  $inhalt.= '<div class="sym"><a href="galerie_'.($i+1).'-1.shtml" ><b>'.$fc[0].'</b></a><br><a href="galerie_'.($i+1).'-1.shtml"><img src="'.(list_file($gals[$i].'/thumbs/')).'" alt="trachtengruppe" title="'.$fc[0].'"><img src="'.(list_file($gals[$i].'/thumbs/', 1)).'" alt="trachtengruppe" title="'.$fc[0].'"><img src="'.(list_file($gals[$i].'/thumbs/', 2)).'" alt="trachtengruppe" title="'.$fc[0].'"></a>
                              
</div>
 <br>';       }
}
 $inhalt.= '<center>'.pager($anzahl_eintraege, $aktuelle_seite, $eintraege_pro_seite, "fotos").'</center>';


?>