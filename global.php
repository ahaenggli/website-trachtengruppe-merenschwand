<?php
require_once('./acp/functions/tpl.php');
require_once('./acp/functions/mysql.php');
require_once('./acp/functions/functions.php');
require_once('./acp/functions/image.php');
require_once('./acp/functions/phpmailer.php');

$style = './css/style.css';
$page = (!isset($_GET['p']) OR $_GET['p']=='index'OR ($_GET['p']=='news' && !is_numeric($_GET['id'])))? "anfang": $_GET['p'];

$array=array(
'index'=>'Startseite',
'anfang'=>'Startseite',
''=>'Startseite',
'news'=>'News',
'infos'=>'&Uuml;ber Uns',
'vorstand'=>'Vorstand',
'aktuell'=>'Aktuell',
'geschichte'=>'Geschichte',
'archiv'=>'Archiv',
'fotos'=>'Galerie',
'links'=>'Links',
'gb'=>'G&auml;stebuch',
'eintragen'=>'GB-Eintrag',
'kontakt'=>'Kontakt',
'gv_08'=>'Archiv',
'archiv_theater'=>'Archiv',
'reg'=>'Archiv',
'75'=>'Archiv',
'75_p'=>'Archiv',
'brauchtumswoche'=>'Brauchtumswoche',
'galerie'=>'Galerie',
'presis'=>'Pr&auml;sidentinnen',
'tgm1940'=>'Trachtengruppe um 1940',
'anfaenge'=>'Anf&auml;nge der Trachtengruppe',
'singproben'=>'Singgruppe',
'tanzproben'=>'Tanzgruppe',
'schrebergarten_2013'=>'Schrebergarten'
);

$inhalt = "";
$menu   = "";
$title = (!empty($array[$page]))? "..:: ".$array[$page]." ::..":"..:: ".$_GET['p']." ::..";
$title  = "Trachtengruppe Merenschwand [".$title."]";
$news ="<ul><li>";//<ul><li><a href=\"index.html\">Heimatabend 2011</a><a href=\"anmeldung_heimatabend.html\">Platzreservation</a>";
$db = new mysql;
$db->connect();
$select = $db->query("SELECT * FROM cms WHERE aktiv='1' ORDER BY id DESC LIMIT 5");
while($row = $db->fetch_array()){
$header   = $row['header'];

$header = bbcodes_news($header);
$header= str_replace("&", "&amp;", $header);
$header= str_replace("\n", "<br/>", $header);
$header= str_replace("ä", "&auml;", $header);
$header= str_replace("ö", "&ouml;", $header);
$header= str_replace("ü", "&uuml;", $header);
$header= str_replace(" & ", " &amp; ", $header);
$header= str_replace("Ä", "&Auml;", $header);
$header= str_replace("Ö", "&Ouml;", $header);
$header= str_replace("Ü", "&Uuml;", $header);
$header = str_replace("*","'", $header);
$header = str_replace('@', '"', $header);
$news.='<a href="news_'.$row['id'].'.shtml">'.$header.'</a>';
}
$db->close();$news.="</li></ul>";


$gals2 =  (list_all('./images/galerie/'));
foreach ($gals2 as $tmp){
$tmpa =  list_all($tmp.'/');
foreach ($tmpa as $tt) $gals[] =  $tt;}
$cco = count($gals); 

$gals =  (list_all('./images/galerie/'));
$menu_fotos_uno = '';
arsort($gals);

   $a=0;
foreach ($gals as $gal)  {
    $gal = @end(explode("/", $gal));
    
    
 if($a<2){   
  $menu_fotos_uno.= '<a href="galerie_'.$gal.'.shtml" ><b>'.$gal.'</b></a>';
  $gals3 =  (list_all('./images/galerie/'.$gal.'/'));
  arsort($gals3);
  foreach($gals3 as $gg){
  $lf = list_files($gg.'/');
  $fc = file($lf[0]);
    $menu_fotos_uno.= '<a href="galerie_'.($cco).'-1.shtml" >'.$fc[0].'</a>';
    $cco--;
  }}
    $a++;
  

} 
$menu_fotos_uno .= '';


?>
