<?php
function Probeplan($termine, $quoi = 'Tanzen', $jahr = '2015')
{
$Fertig = false;
$return = '';
$monate = array(
   1=>"Januar",
   2=>"Februar",
   3=>"M&auml;rz",
   4=>"April",
   5=>"Mai",
   6=>"Juni",
   7=>"Juli",
   8=>"August",
   9=>"September",
   10=>"Oktober",
   11=>"November",
   12=>"Dezember");
$tage = array("So","Mo","Di", "Mi","Do","Fr","Sa");


$return.= '<div class="left" style="display: table;font-size:15px;margin:auto;">  ';

$a = 0;
$array = array();

  foreach($termine as $m=>$da)
  { 
    if($Fertig == false)
    {
      $t_z = (ceil(count($termine)/2));
      $ex = explode(',', $da);  
     // echo $m.'/'.  ($m+$t_z);
      $doWhile = true; 
      while ($doWhile){
            if (isset($termine[$m+$t_z]) && !in_array($m+$t_z, $array)) $doWhile = false;
            if ($t_z> 12) $doWhile = false;
            if ($doWhile) $t_z++;
            }
      // echo $m.'/'.  ($m+$t_z);
      if(!isset($termine[$m+$t_z])) $t_z="";
      $ex2 = (!empty($t_z))? explode(',', $termine[$m+$t_z]):"";

      $count = (count($ex)>=count($ex2))? count($ex):count($ex2);
      
      $return.=(utf8_decode('
             <div style="display: table-row;">
             <div style="display: table-cell;width:100px;"><b>'.((empty($m))? "":$monate[$m]).'</b></div>  
             <div style="display: table-cell;width:200px;"></div>     
             <div style="display: table-cell;width:100px;"><b>'.((empty($t_z))? "":$monate[$m+$t_z]).'</b></div>   
             <div style="display: table-cell;width:200px;"></div>  
             </div>'));
       
        
      $array[]=$m;
      $array[]=$m+$t_z;
          
      for($i=0;$i<$count;++$i)
      {
        @$day = (!empty($ex[$i]))?$tage[date('w', mktime('20','00','00', $m, $ex[$i] ,$jahr))]:'';
        @$day2 = (!empty($ex2[$i]))?$tage[date('w', mktime('20','00','00', $m+$t_z, $ex2[$i] ,$jahr))]:'';
        
        if(!empty($ex[$i]) && is_numeric($ex[$i]))
        $ex[$i] = $ex[$i].'. '.$quoi;
        elseif(!empty($ex[$i]) && !is_numeric($ex[$i]))
        $ex[$i] = $ex[$i];
        else $ex[$i] = '';
        
        if(!empty($ex2[$i]) && is_numeric($ex2[$i]))
        $ex2[$i] = $ex2[$i].'. '.$quoi;
        elseif(!empty($ex2[$i]) && !is_numeric($ex2[$i]))
        $ex2[$i] = $ex2[$i];
        else $ex2[$i] = '';
         
        //$ex2[$i] = (!empty($ex2[$i]))? $ex2[$i].'. '.$quoi:'';
        $return.='
        <div style="display: table-row;">
        <div style="display: table-cell;width:100px;"></div>   
        <div style="display: table-cell;width:200px;white-space: nowrap;">'.$day.' '.$ex[$i].'</div>    
        <div style="display: table-cell;width:100px;"></div>    
        <div style="display: table-cell;width:200px;white-space: nowrap;">'.$day2.' '.$ex2[$i].'</div> 
        </div> ';
      }
      //}
      $a++;
      
      if($a >= count($termine)/2) 
      {
        $return.='</div>';
        $Fertig = true;
      }
      
    }
  }
  return $return;
}

function bbcodes_news($bb)
{      
    //$bb = htmlentities($bb, ENT_QUOTES, "ISO-8859-1") ;//htmlentities($bb);
    
    $bb = str_replace("\n", "#br#", $bb);
    $bb = preg_replace('/\[b\](.*?)\[\/b\]/', '<b>$1</b>', $bb);
    $bb = preg_replace('/\[i\](.*?)\[\/i\]/', '<i>$1</i>', $bb);
    $bb = preg_replace('/\[u\](.*?)\[\/u\]/', '<u>$1</u>', $bb);
    $bb = preg_replace('/\[color:(.*?)\](.*?)\[\/color\]/', '<span style="color:$1">$2</span>', $bb);
    $bb = preg_replace('/\[url\](.*?)\[\/url\]/', '<a href="$1">$1</a>', $bb);
    $bb = preg_replace('/\[url=([^ ]+).*\](.*)\[\/url\]/', '<a href="$1">$2</a>', $bb);
         
     $bb = preg_replace('/\[Geburtstag:Anfang\](.*?)\[Geburtstag:Ende\]/', '<div style=@display:block;background-image:url(*./images/baer.gif*);width:350px;height:200px;position:relative;background-position:0px 0px;background-repeat:no-repeat;font-size: 14px;@><ul style=@margin-left:55%;list-style-type:none;font-weight: bold; @>$1</ul></div>', $bb);
     
     $bb = preg_replace('/\[Person:Anfang\](.*?)\[Person:Ende\]/', '<li style=@white-space:nowrap@>$1</li>', $bb);
     $bb = preg_replace('/\[Kleeblatt\]/', '<img src=*./images/klee.gif* class="noborder" alt=*Kleeblatt*>', $bb);
     
     $bb = preg_replace('/\[Probeplan:(.*?),(.*?)\](.*?)\[\/Probeplan\]/', '°*-*°.Probeplan(array($3), "$1", "$2").°*-*°', $bb);
     
     $bb = str_replace("<center>", '<div class="center">', $bb);
     $bb = str_replace("</center>", '</div>', $bb);
     
     $bb = str_replace('<div align="right">', '<div class="right">', $bb);
     
     
     $bb = str_replace("'", "\'", $bb);
     $bb = str_replace("°*-*°", "'", $bb);
     $bb = str_replace("#br#", "\n", $bb);
     $tmp = "";
     $bb = " \$tmp = '".$bb."';";
     eval($bb);
     $bb = $tmp;
    
    return $bb;
}

function oldnews_2_bbcodes($bb){
$bb = str_replace("\n", "#br#", $bb);       
$bb = preg_replace('/\<li style=@white-space:nowrap@\>(.*?)\<\/li\>/','[Person:Anfang]$1[Person:Ende]',  $bb);
$bb = preg_replace('/\<img src=\*.\/images\/klee.gif\* border=\*0px\* alt=\*Kleeblatt\*\>/','[Kleeblatt]',  $bb);
   
$bb = str_replace("#br#", "\n", $bb);
  return $bb;
}

function bbcode($bb)
{
    //$bb = htmlentities($bb, ENT_QUOTES, "ISO-8859-1") ;//htmlentities($bb);
    $bb = preg_replace('/\[b\](.*?)\[\/b\]/', '<b>$1</b>', $bb);
    $bb = preg_replace('/\[i\](.*?)\[\/i\]/', '<i>$1</i>', $bb);
    $bb = preg_replace('/\[u\](.*?)\[\/u\]/', '<u>$1</u>', $bb);
    $bb = preg_replace('/\[color:(.*?)\](.*?)\[\/color\]/', '<span style="color:$1">$2</span>', $bb);
    $bb = preg_replace('/\[url\](.*?)\[\/url\]/', '<a href="$1">$1</a>', $bb);
    $bb = preg_replace('/\[url=([^ ]+).*\](.*)\[\/url\]/', '<a href="$1">$2</a>', $bb);
    $bb = preg_replace('/\n/', "<br>\n", $bb);
    
    return $bb;
}
function smilies($inhalt){
$inhalt = str_replace(':(D:', '<img src="./images/smilies/D.gif" alt=":(D:">', $inhalt);
$inhalt = str_replace(':):', '<img src="./images/smilies/C.gif" alt="):">', $inhalt);
$inhalt = str_replace(':-):', '<img src="./images/smilies/CC.gif" alt=":-):">', $inhalt);
$inhalt = str_replace(':-:', '<img src="./images/smilies/m.gif" alt=":-:">', $inhalt);
$inhalt = str_replace(':00:', '<img src="./images/smilies/00.gif" alt=":00:">', $inhalt);
$inhalt = str_replace(':xD:', '<img src="./images/smilies/xD.gif" alt=":xD:">', $inhalt);
$inhalt = str_replace(':winki:', '<img src="./images/smilies/winki.gif" alt=":winki:">', $inhalt);
$inhalt = str_replace(':17:', '<img src="./images/smilies/17.gif" alt="17:">', $inhalt);
$inhalt = str_replace(':blabla:', '<img src="./images/smilies/blabla.gif" alt=":blabla:">', $inhalt);
$inhalt = str_replace(':angel:', '<img src="./images/smilies/angel.gif" alt=":angel:">', $inhalt);
return $inhalt;
}

?>