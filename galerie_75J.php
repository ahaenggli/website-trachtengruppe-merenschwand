<?php
$beschreibung = "75 Jahre Trachtengruppe Merenschwand";
if(!isset($_GET['nr'])){
$i=0;
$images = "";
if ($handle = opendir('./images/galerie/tumbs/75/')) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != ".." && $file != 'Thumbs.db') {
        
          if($i==0){
          $images .='<tr>';
          }
       
        $a=ereg_replace('.jpg', '', $file);
        $images .='<td><a href="./galerie_75J_'.$a.'.shtml"><img src="./images/galerie/tumbs/75/'.$file.'" border="0"></a></td>';  
        $i++;
           if($i==2){
           $images .='</tr>';
           $i=0;
           }

  }
  }
    closedir($handle);
}
eval("\$inhalt = \"".gettemplate("./templates/galerie.tpl")."\";");
}else{
$ueb = 'galerie_75J.html';
$a=$_GET['nr'];
$file_n = str_pad($a+1, 3 ,'0', STR_PAD_LEFT);
$file_v = str_pad($a-1, 3 ,'0', STR_PAD_LEFT);

if(file_exists('./images/galerie/bilder/75/'.$file_n.'.jpg'))
{
$weiter='<a href="./galerie_75J_'.$file_n.'.shtml"><b>Weiter</b></a>';
}
else
{
$weiter='<b>Weiter</b>';
}
if($a==1)
{
$zur='<b>Zur&uuml;ck</b>';
}
else
{
$zur='<a href="galerie_75J_'.$file_v.'.shtml"><b>Zur&uuml;ck</b></a>';
}
$bild = './images/galerie/bilder/75/'.$a.'.jpg';
eval("\$inhalt = \"".gettemplate("./templates/galerie_bild.tpl")."\";");
}
?>