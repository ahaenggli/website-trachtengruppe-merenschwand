<?php
$beschreibung = "Die Kindergruppe beim &quot;Chlaushock&quot;";
if(!isset($_GET['nr'])){
$i=0;
$images = "";
if ($handle = opendir('./images/galerie/tumbs/KG/')) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != ".." && $file != 'Thumbs.db') {
        
          if($i==0){
          $images .='<tr>';
          }
       
        $a=ereg_replace('.jpg', '', $file);
        $images .='<td><a href="./kg_'.$a.'.shtml"><img src="./images/galerie/tumbs/KG/'.$file.'" border="0"></a></td>';  
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
$ueb = 'kg.html';
$a=$_GET['nr'];
$file_n = str_pad($a+1, 2 ,'0', STR_PAD_LEFT);
$file_v = str_pad($a-1, 2 ,'0', STR_PAD_LEFT);

if(file_exists('./images/galerie/bilder/KG/'.$file_n.'.jpg'))
{
$weiter='<a href="./kg_'.$file_n.'.shtml"><b>Weiter</b></a>';
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
$zur='<a href="kg_'.$file_v.'.shtml"><b>Zur&uuml;ck</b></a>';
}
$bild = './images/galerie/bilder/KG/'.$a.'.jpg';
eval("\$inhalt = \"".gettemplate("./templates/galerie_bild.tpl")."\";");
}
?>