<?php 
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); 
else ob_start(); 

//session_start();
error_reporting(E_ALL);
/* Cache für schnelleres laden*/
/*$cachefile = 'cache/'.basename($_SERVER['REQUEST_URI']);

if ( (file_exists ($cachefile) ) && (time () - filemtime ($cachefile) < 86400) )
{
    echo file_get_contents ($cachefile);
    exit ();
}
 
ob_start ();
*/

/* Funktionen laden */
if($dir=opendir('./acp/functions/'))
{
 while($file=readdir($dir)) {
  if (!is_dir('./acp/functions/'.$file) && $file != "." && $file != "..") require_once('./acp/functions/'.$file);
 }
closedir($dir);
}

/*Initial*/
$__PageRoot = 'http://www.trachtengruppe-merenschwand.ch';
$jss = "";
$inhalt = "";
$news = array();
$archivy = array();
$Titel_links = "";
$title = "";
$MyDesc = "";
$keywords = "";
$xml = "";
$mobile = (check_mobile())? '<link rel="stylesheet" type="text/css" href="./css/noscript.css">':'';
$Anchor = (check_mobile())? "#main":'';
$GetYear = Date("Y");
$app = (preg_match('/#TrachtenApp#/', $_SERVER['HTTP_USER_AGENT']))? "\r\n".'<link rel="stylesheet" type="text/css" href="./css/app.css">':'';
$app_menu = '';

/*Sets*/
$style = './css/neu_style.css';

$page = (!isset($_GET['p']) OR $_GET['p']=='index'OR ($_GET['p']=='neues' && (isset($_GET['id']) && !is_numeric($_GET['id']))))? "startseite": $_GET['p']; 
//echo $_GET['p'];
//echo $_GET['id'];

require_once("_menu.php");
/*
$find= $page;
$page = "";

function my_search($haystack, &$found)
{
    global $find;
    foreach($haystack as $v => $k){
    $v = str_replace(' ', '_',$v);
    $v = str_replace('&auml;', 'ae',$v);
    $v = str_replace('&ouml;', 'oe',$v);
    
    if( strpos($v, $find) !== false) $found[] = $v;
    if(is_array($k)) my_search($k, $found);
    }
    
}
$matches=array();
my_search($menu_items, $matches);

print_r($matches); */
/* Inhalt laden */
     
if(empty($page) || $page == 'index' || $page == 'anfang'|| $page == '_default'|| $page == 'startseite' ) $page = 'startseite';
$tmp_gal = $page;
if(empty($page) || $page == 'index' || $page == 'anfang'|| $page == '_default'|| $page == 'startseite' ) $page = '_default';

  if(file_exists("./".$page.".php")) require_once("./".$page.".php");
   elseif(file_exists("./templates/".$page.".tpl")) eval("\$inhalt .=\"".gettemplate("./templates/".$page.".tpl")."\";");
    //else {header('HTTP/1.0 404 Not Found'); header('Location: Error404.shtml');//eval("\$inhalt .=\"".gettemplate("./templates/_default.tpl")."\";");
//}
$page = $tmp_gal;    

/* $page bereinigen */
// Galerie mit Bildern
if($page == 'foto_galerie' && isset($_GET['gal']) && isset($_GET['los']) && is_numeric($_GET['gal']) && is_numeric($_GET['los']))
$page = 'galerie_'.$_GET['gal'].'-1';

// Galerie mit Jahr
if($page == 'fotos' && isset($_GET['y']) && is_numeric($_GET['y']))
$page = 'galerie_'.$_GET['y'];

// Galerie mit Bildern
if($page == 'foto_galerie' && isset($_GET['gal']) && isset($_GET['img']) && is_numeric($_GET['gal']) && is_numeric($_GET['img']))
$page = 'galerie_'.$_GET['gal'].'-1';

// News
if($page == 'neues' && isset($_GET['id']) && is_numeric($_GET['id']) && (isset($_GET['z']) && $_GET['z']=='archiv') )
$page = 'archiv_'.$_GET['id'];

// News
if($page == 'neues' && isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id']) > 0 )
$page = 'neues_'.$_GET['id'];

// News
if($page == 'neues' && isset($_GET['id']) && is_numeric($_GET['id']) && ($_GET['id']) ==-1 )
$page = 'neuigkeitenarchiv';

$menu_h = "";

foreach($menu_items as $menu=>$item){
$ex = explode('|', $menu);
$aktiv = 0;
$anzeigen = (!is_array($item) && $item == '0')? false : true;

$menu_h.=($anzeigen==false)? '': '<ul>'."\n".'<li>';
$menu_h.=($anzeigen==false)? '': '<a href="'.$__PageRoot.'/'.$ex[0].''.$Anchor.'"#aktiv1#>'.$ex[1].'</a>';

if ($page == str_replace('.shtml', '', str_replace('.html', '', $ex[0]))) $aktiv = 1;
$Titel_links =  ($aktiv == 0 || !empty($Titel_links))? $Titel_links : $ex[1];
$menu_h = ($aktiv == 0)? str_replace('#aktiv1#', '#aktiv1#', $menu_h): str_replace('#aktiv1#', ' style="color:red;" ', $menu_h);$aktiv = 0;

if(is_array($item)){
  $tmenu_h = "";
  foreach($item as $sub_menu=>$sub_item){
   $sub_anzeigen = (!is_array($sub_item) && $sub_item == '0')? false : true;
   $sub_ex = explode('|', $sub_menu);
   $tmenu_h.= ($sub_anzeigen==false)? '':"\n".'<li><a href="'.$__PageRoot.'/'/*.$ex[1].'/'*/.$sub_ex[0].''.$Anchor.'"#aktiv2#>'.$sub_ex[1].'</a>';
   if ($page == str_replace('.shtml', '', str_replace('.html', '', $sub_ex[0]))) $aktiv = 1;
   $Titel_links =  ($aktiv == 0 || !empty($Titel_links))? $Titel_links : '<a href="'.$__PageRoot.'/'.$ex[0].''.$Anchor.'">'.$ex[1].'</a> > '.$sub_ex[1];
   $tmenu_h = ($aktiv == 0)? str_replace('#aktiv2#', '#aktiv2#', $tmenu_h): str_replace('#aktiv2#', ' style="color:red;" ', $tmenu_h);
   $tmenu_h = ($aktiv == 0)? str_replace('#aktiv1#', '#aktiv1#', $tmenu_h): str_replace('#aktiv1#', ' style="color:red;" ', $tmenu_h);$aktiv = 0;
   
     if(is_array($sub_item)){
      
     $ttmenu_h = "";
     foreach($sub_item as $subsub_menu=>$subsub_item){
      $subsub_anzeigen = (!is_array($subsub_item) && $subsub_item == '0')? false : true;
      $subsub_ex = explode('|', $subsub_menu);
      $ttmenu_h.= ($subsub_anzeigen==false)? '':"\n".'<li><a href="'.$__PageRoot.'/'/*.$ex[1].'/'.$sub_ex[1].'/'*/.$subsub_ex[0].''.$Anchor.'"#aktiv3#>'.$subsub_ex[1].'</a></li>';
      if ($page == str_replace('.shtml', '', str_replace('.html', '', $subsub_ex[0]))) $aktiv = 1;
      $Titel_links =  ($aktiv == 0 || !empty($Titel_links))? $Titel_links : '<a href="'.$__PageRoot.'/'.$ex[0].''.$Anchor.'">'.$ex[1].'</a> > <a href="'.$__PageRoot.'/'/*.$ex[1].'/'*/.$sub_ex[0].''.$Anchor.'">'.$sub_ex[1].'</a> > '.$subsub_ex[1];
      $ttmenu_h = ($aktiv == 0)? str_replace('#aktiv3#', '', $ttmenu_h): str_replace('#aktiv3#', ' style="color:red;" ', $ttmenu_h);
      $ttmenu_h = ($aktiv == 0)? str_replace('#aktiv2#', '#aktiv2#', $ttmenu_h): str_replace('#aktiv2#', ' style="color:red;"', $ttmenu_h);
      $ttmenu_h = ($aktiv == 0)? str_replace('#aktiv1#', '#aktiv1#', $ttmenu_h): str_replace('#aktiv1#', ' style="color:red;"', $ttmenu_h);$aktiv = 0;
   
      }
      if(!empty($ttmenu_h)){
      $tmenu_h.= "\n".'<ul>';
      $tmenu_h.= $ttmenu_h;
      $tmenu_h.= "\n".'</ul>';
      }
     }

   $tmenu_h.=($sub_anzeigen==false)? '':"".'</li>';
   $tmenu_h = str_replace('#aktiv2#', '', $tmenu_h);
   }
   if(!empty($tmenu_h)){
      $menu_h.= "\n".'<ul>';
      $menu_h.= $tmenu_h;
      $menu_h.= "\n".'</ul>';
   }
}                      
$menu_h = str_replace('#aktiv1#', '', $menu_h);

$menu_h.=($anzeigen==false)? '': "\n".'</li>'."\n".'</ul>'."\n\n\n";

}


$Titel_links = (!empty($Titel_links)) ? $Titel_links : ucfirst($page);

$title = strip_tags($Titel_links).' Trachtengruppe Merenschwand';


$inhalt = bbcodes_news($inhalt);
umlaute($inhalt);
$MyDesc =  str_replace("\r\n", "\n", strip_tags($inhalt));
$MyDesc =  str_replace("\r", "\n", strip_tags($MyDesc));
$MyDesc =  str_replace("\n", "", strip_tags($MyDesc));
$MyDesc =  str_replace("\"", "", strip_tags($MyDesc));
$MyDesc =  str_replace("„", "", strip_tags($MyDesc));
$MyDesc =  str_replace("„", "", strip_tags($MyDesc));
$MyDesc =  str_replace("“", "", strip_tags($MyDesc));

while(str_replace("  ", " ", strip_tags($MyDesc)) <> $MyDesc) $MyDesc =  str_replace("  ", " ", strip_tags($MyDesc));
$MyDesc = trim($MyDesc);

$keywords = (html_entity_decode($MyDesc, ENT_COMPAT, 'UTF-8'));


$keywords =  str_replace(",", "", strip_tags($keywords));
$keywords =  str_replace("!", "", strip_tags($keywords));
$keywords =  str_replace("?", "", strip_tags($keywords));
$keywords =  str_replace(".", "", strip_tags($keywords));
$keywords =  str_replace(":", "", strip_tags($keywords));
$keywords =  str_replace("\"", "", strip_tags($keywords));
$keywords =  str_replace("@", "", strip_tags($keywords));
$keywords =  str_replace("/", "", strip_tags($keywords));
$keywords =  str_replace("(", "", strip_tags($keywords));
$keywords =  str_replace(")", "", strip_tags($keywords));

$keywords = explode(' ', $keywords);

foreach ($keywords as $key=>&$value) {
    if (strlen($value) < 5) {
        unset($keywords[$key]);
    }
}
$keywords = array_unique($keywords);
$keywords = implode(', ', $keywords);

umlaute($inhalt);

//$inhalt = iconv("ISO-8859-1", "UTF-8//TRANSLIT", $inhalt);
$inhalt = str_replace('./images/', $__PageRoot.'/images/', $inhalt);
                   

eval("outtpl(\"".gettemplate("./templates/neu_index.tpl")."\");");
require_once('./stat.php');
/*
$content = ob_get_clean();
$handle = fopen ($cachefile, 'w');
fputs ($handle, $content);
fclose ($handle);
echo $content;
*/

      /*



$db = new mysql;
$db->connect();

$select = $db->query("SELECT ip,host,cc FROM logs WHERE country = '' group by ip,host,cc;");

while($row = $db->fetch_array($select)){
$ip=$row['ip'];//$_SERVER['REMOTE_ADDR'];
$host = $row['host'];
$host = trim($host);
$host = (empty($host))? gethostbyaddr($ip):$host;
$cc=  @geoip_country_code_by_name($host);
if(empty($cc)) $cc=$row['cc'];

$country =  @geoip_country_name_by_name($host);
if(empty($country)) $country='unky';

$db->query("update logs SET host = '".$host."', cc = '".$cc."', country='".$country."' WHERE ip='".$ip."';");

} 
$db->close();
    */
/*
$ip='95.211.203.202';//$_SERVER['REMOTE_ADDR'];
$host = gethostbyaddr($ip);
$cc=  @geoip_country_code_by_name($host);
echo 'cc.'.$host;
*/

?>