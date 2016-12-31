<?php
header('Content-type: text/javascript'); 

/* Funktionen laden */
if($dir=opendir('./acp/functions/'))
{
 while($file=readdir($dir)) {
  if (!is_dir('./acp/functions/'.$file) && $file != "." && $file != "..") require_once('./acp/functions/'.$file);
 }
closedir($dir);
}
 

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
$text = "api_gallery=[";
  for($i=0;$i<count($pic);$i++){
  $text.= "'".str_replace('./images/', 'http://www.trachtengruppe-merenschwand.ch/images/', $pic[$i])."'"; 
  $text.= ($i<(count($pic)-1))?  ",":"";
  }
$text.= '	];'."\n\n";

$text.="api_descriptions=[";
  for($i=0;$i<count($pic);$i++){
  $comm = explode('.', end(explode('/', $pic[$i])));
  
  $comment = (file_Exists('./images/galerie/'.$gal[0].'/txt/'.$comm[0].'.txt'))? implode('', file('./images/galerie/'.$gal[0].'/txt/'.$comm[0].'.txt')):"";
  $comment = htmlentities($comment, ENT_QUOTES, "ISO-8859-1") ;
  $comment = str_replace("\n", '<br>', ($comment));
  $comment = str_replace("\r", '<br>', $comment);
  $comment = str_replace("<br><br>", '<br>', $comment);
 
  $text.= "'".$comment."'"; 
  $text.= ($i<(count($pic)-1))?  ",":"";
  }
$text.= '	];'."\n\n";
echo $text."\n\n";
                        
?>
api_titles=[];                                           