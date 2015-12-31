<?php
header('Content-type: text/javascript'); 
require_once("global.php");

                                             /*

 $ldir = list_dirs('./images/galerie/');         
 $gal[0] = end(explode('/', $ldir[$_GET['nr']-1]))  ; */
 
$gals2 =  (list_all('./images/galerie/'));  $gals=array();
foreach ($gals2 as $tmp){
$tmpa =  list_all($tmp.'/');

foreach ($tmpa as $tt) $gals[] =  $tt;
}           
                                     

arsort($gals);

 $ldir = $gals;//list_dirs('./images/galerie/');
            $gal = array();$gal[]='';

 $gal[0] =  str_replace("./images/galerie/", "", $ldir[$_GET['nr']-1])  ;

  $fc = file('./images/galerie/'.$gal[0].'/infos.txt');
$pic = list_files('./images/galerie/'.$gal[0].'/bilder/','jpg');
umlaute($fc[0]);
$text = "var g_".ranul($gal[0])." = [";
  for($i=0;$i<count($pic);$i++){
  $comm = explode('.', end(explode('/', $pic[$i])));
  
  $comment = (file_Exists('./images/galerie/'.$gal[0].'/txt/'.$comm[0].'.txt'))? file('./images/galerie/'.$gal[0].'/txt/'.$comm[0].'.txt'):"";
  
  $text.='{"caption": "'.str_replace(array("\n", "\r"), array('', ''), $fc[0]).'", "url": "'.str_replace('./images/', './', $pic[$i]).'", "comment": "'.$comment[0].'"}';
  $text.= ($i<(count($pic)-1))?  ",":"";
  }
$text.= '	];';
echo $text."\n\n";
                        
?>