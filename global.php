<?php
require_once('./acp/functions/tpl.php');
require_once('./acp/functions/mysql.php');
require_once('./acp/functions/functions.php');
require_once('./acp/functions/image.php');
require_once('./acp/functions/phpmailer.php');
$style = './css/style.css';
$page = (!isset($_GET['p']) OR $_GET['p']=='index')? "anfang": $_GET['p'];

$array=array(
'index'=>'Startseite',
'anfang'=>'Startseite',
''=>'Startseite',
'infos'=>'&Uuml;ber Uns',
'vorstand'=>'Vorstand',
'aktuell'=>'Aktuell',
'geschichte'=>'Geschichte',
'archiv'=>'Archiv',
'fotos'=>'Galerie','gv'=>'GV','ha'=>'Heimatobig','galerie_75J'=>'75 Jahr-Jubil&auml;um','div'=>'Diverses','kg'=>'Kindergruppe',
'links'=>'Links',
'gb'=>'G&auml;stebuch',
'eintragen'=>'GB-Eintrag',
'kontakt'=>'Kontakt',
'gv_08'=>'Archiv','
archiv_theater'=>'Archiv',
'reg'=>'Archiv',
'75'=>'Archiv',
'75_p'=>'Archiv',
'brauchtumswoche'=>'Brauchtumswoche'
);

$inhalt = "";
$menu   = "";
$title  = "Trachtengruppe Merenschwand [".$array[$page]."]";
?>