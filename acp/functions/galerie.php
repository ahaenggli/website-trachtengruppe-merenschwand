<?php
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - #
// Seitennavigation
// $navigationslinks = pager($zeilen, $seite, $daten_per_site, $url, $show_pageinfo);
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - #
function pager($zeilen, $seite, $pro_seite, $url, $show_pageinfo = 1, $is_img = 0) {
$Anchor = (check_mobile())? "#main":'';

$max_ausgabe = $pro_seite;
$gesamtseiten = floor(($zeilen - 1) / $pro_seite+1);

$aktuelle_seite = $seite ? $seite : 1;
$linkanzahlausgabe = ($seite<2)? 3:2;

$letzte = $linkanzahlausgabe + $aktuelle_seite;
if ($letzte > $gesamtseiten) {
$letzte = $gesamtseiten;
}

$startback = $aktuelle_seite - $linkanzahlausgabe;
if ($startback < 1) {
$startback = 1;
}

$navigationslinks = "";
if ($gesamtseiten != 1 && $zeilen) {
$seitenlink = "";

if ($startback > 1) {
$prevbl = $aktuelle_seite - 1;
$seitenlink .=  '<br class="nurMobile"><a href="'.$url.'-1.shtml'.$Anchor.'" title="Erste Seite aufrufen">&#171;&#171;</a> 
<a href="'.$url.'-'.$prevbl.'.shtml'.$Anchor.'" title="Eine Seite zurück">&#171;</a><br class="nurMobile"> ';
}

for ($i = $startback; $i <= $letzte; $i++) {
if ($aktuelle_seite == "$i") {
$seitenlink .= " <span class=\"pagecurrent\">$i</span> ";
} else {
$seitenlink .= ' <a href="'.$url.'-'.$i.'.shtml'.$Anchor.'">'.$i.'</a> ';  
}
}

if ($letzte < $gesamtseiten) {
$nextbl = $aktuelle_seite + 1;
$seitenlink .= "<br class=\"nurMobile\"><a href=\"".$url."-".$nextbl.".shtml".$Anchor."\" class=\"pages displaypageNum\" title=\"Eine Seite weiter\">&#187;</a>  
<a class=\"pages displaypageNum\" href=\"".$url."-".$gesamtseiten.".shtml".$Anchor."\" title=\"Letzte Seite aufrufen\">&#187;&#187;</a> <br class=\"nurMobile\">";
}

if ($show_pageinfo == 1) $pageinfo = "<span class=\"seiteninfo\">Seite: $aktuelle_seite von $gesamtseiten</span>"; else $pageinfo = '';
if ($is_img!=0) $galtext = "<br class=\"nurMobile\"> <a class=\"seiteninfo\" style=\"padding-left:3px;\" href=\"galerie_".$is_img."-1.shtml".$Anchor."\"> Zur&uuml;ck zur Galerie</a>"; else $galtext = '';
$navigationslinks = '<div class="blog-pager displaypageNum">'.$pageinfo.'<br class="nurMobile">'.$seitenlink.$galtext.'</div>';
}

return $navigationslinks;
}



?>