<?php
$is_y = false;
$Anchor = (check_mobile())? "#main":'';

$gals2 =  (list_all('./images/galerie/'));  $gals=array();
foreach ($gals2 as $tmp){
$tmpa =  list_all($tmp.'/');

foreach ($tmpa as $tt) {
if($tt!='diverses') $gals[] =  $tt;
}
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
$inhalt.= '<section><h1>Fotogalerie '.(($is_y)?$_GET['y']:"").'</h1>
'.pager($anzahl_eintraege, $aktuelle_seite, $eintraege_pro_seite, "fotos").'';

for($i=$beginn;$i>=$ende;$i--) {
      if ($gals[$i]<>''){  
$lf = list_files($gals[$i].'/');
    
$fc = file($lf[0]);
$fc[0] = trim($fc[0]);
  $inhalt.= '<article class="design design-ok galerie"><a href="galerie_'.($i+1).'-1.shtml'.$Anchor.'" style="text-decoration:none;"><h2 class="hell">'.$fc[0].'</h2></a>
  <a href="galerie_'.($i+1).'-1.shtml'.$Anchor.'" style="text-decoration:none;">
  <img src="'.(list_file($gals[$i].'/thumbs/', 0)).'" alt="'.$fc[0].'" title="'.$fc[0].'" style="max-width:250px;max-height:150px;">
  <img src="'.(list_file($gals[$i].'/thumbs/', 1)).'" alt="'.$fc[0].'" title="'.$fc[0].'" style="max-width:250px;max-height:150px;">
  <img src="'.(list_file($gals[$i].'/thumbs/', 2)).'" alt="'.$fc[0].'" title="'.$fc[0].'" style="max-width:250px;max-height:150px;">
  </a>
                              
</article>';       }
}
 $inhalt.= ''.pager($anzahl_eintraege, $aktuelle_seite, $eintraege_pro_seite, "fotos").'</section>';


?>