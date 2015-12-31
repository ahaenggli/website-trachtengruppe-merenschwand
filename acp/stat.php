<?php 
require_once("global.php");

  


$ip = $_SERVER['REMOTE_ADDR'];
$file = "stat.html"; 
$users = "";
$inhalt = "";
$db = new mysql;
$db->connect();
if(isset($_POST['ipl']))   $db->query('DELETE FROM logs WHERE ip = "'.$_POST['ipl'].'";');
if(isset($_POST['log'])) $db->query('DELETE FROM logs WHERE ip = "'.$_POST['log'].'";');
$query = $db->query("SELECT count(*) as counter, max(datum) as zeit, min(datum) as mdat, ip, os, cc, wb, ref, page 
            FROM logs GROUP BY ip
            HAVING counter >= 1 ORDER BY zeit ASC; ");
   $cc = array();  
   $wbs = array();
   $visits = 0;    
   $visitors = 0;  
   $mdat = 0;
   $visitors_today = 0;
   while($row = $db->fetch_array()){ 
   if(date('Y', $row['zeit']) == date('Y')){
        if(!is_numeric(@$cc[$row['cc']])) @$cc[$row['cc']]=1;
        else @$cc[$row['cc']]++; 
        if ($mdat == 0) $mdat = $row['mdat'];
if (@eregi('explorer', $row['wb'])) $row['wb'] = str_replace('explorer', 'Internet Explorer', $row['wb']);
elseif (@eregi('firefox', $row['wb']))  $row['wb'] = str_replace('Firefox', 'Mozilla Firefox', $row['wb']);
elseif (@eregi('chrome', $row['wb'])) $row['wb'] = str_replace('chrome', 'Google Chrome', $row['wb']);
elseif (@eregi('iphone', $row['wb']))  $row['wb'] = str_replace('iphone', 'iPhone', $row['wb']);
elseif (@eregi('safari', $row['wb'])) $row['wb'] = str_replace('safari', 'Safari', $row['wb']);
elseif (@eregi('opera', $row['wb'])) $row['wb'] = str_replace('opera', 'Opera', $row['wb']);

       
        if(!is_numeric(@$wbs[$row['wb']])) @$wbs[$row['wb']]=1;
        else @$wbs[$row['wb']]++; 
        $dddd=$row['zeit'];
        $visits = $visits+$row['counter'];
        $visitors++;
        if( (date('Y-m-d', $row['zeit']) == date('Y-m-d', time()))  ) $visitors_today++  ;
         }
        }
        function diff_time($differenz)
   {  
   $tag  = ceil($differenz / (3600*24));
   $std  = floor($differenz / 3600 % 24);
   $min  = floor($differenz / 60 % 60);
   $sek  = floor($differenz % 60);

   return $tag;//array("sek"=>$sek,"min"=>$min,"std"=>$std,"tag"=>$tag,"woche"=>$woche);
   } 
        $days = diff_time($dddd-$mdat)+1;//dates_diff(date('Y-m-d', $mdat), date('Y-m-d', time()));
        
        
        
        $vpd = round($visitors/$days);
        $vpv = round($visits/$visitors,2);
 // To display flag
 foreach ($cc as $key => $sort) $krit1[$key]  = $sort;
  array_multisort($krit1, SORT_DESC, $cc);    $krit1=array();

         
  $inhalt.='<table><tr><td><h1>L&auml;nderstatistik</h1><table><tr><td>Land</td><td style="padding-left:10px;">Anzahl Besucher</td></tr>';
foreach($cc as $name => $value){
$file_to_check="./images/flags/".$name.".gif";
if (file_exists($file_to_check))      
$inhalt .= '<tr><td><img src="'.$file_to_check.'" style="display:inline;" width="30" height="15"> '.$name.' </td><td align="center"><!--<a href="./sql.php?sql=sqlquery&query=DELETE%20FROM%20logs%20WHERE%20cc=%27'.strtoupper($name).'%27;">--> '.$value.'<!--</a>--></td></tr>';               
 else $inhalt .= '<tr><td>'.$name.' </td><td align="center"> '.$value.'</td></tr>';
}
$inhalt.='</table></td>';

foreach ($wbs as $key => $sort) $krit1[$key]  = $sort;
array_multisort($krit1, SORT_DESC, $wbs);




$inhalt.='<td><h1>Browserstatistik</h1><table><tr><td>Browser</td><td style="padding-left:10px;">Anzahl Benutzer</td></tr>';
foreach($wbs as $name => $value){
if (@eregi('explorer 8', $name)) $file_to_check="./images/ie8.png";
elseif (@eregi('explorer 9', $name)) $file_to_check="./images/ie8.png";
elseif (@eregi('explorer', $name)) $file_to_check="./images/ie.png";  
elseif (@eregi('firefox', $name))  $file_to_check="./images/ff.png";
elseif (@eregi('chrome', $name)) $file_to_check="./images/browser_chrome.png";
elseif (@eregi('opera', $name)) $file_to_check="./images/browser_opera.png";
elseif (@eregi('safari', $name)) $file_to_check="./images/browser_safari.png";
if (file_exists($file_to_check))      
$inhalt .= '<tr><td><img src="'.$file_to_check.'" style="display:inline;" width="20"> '.$name.' </td><td align="center"> '.$value.'</td></tr>';               
 else $inhalt .= '<tr><td>'.$name.' </td><td align="center"> '.$value.'</td></tr>';
}
$inhalt.='</table></td></tr></table>';

//eval("\$inhalt .=\"".gettemplate("./templates/stat.tpl")."\";");
           

if(!isset($_POST['show'])){
$i=1;$us=1;

           
$abfrage = "SELECT count(*) as counter, max(datum) as zeit, min(datum) as mdat, ip, os as pc, cc, wb as browser, ref as host, page as site
            FROM logs GROUP BY ip
            HAVING counter >= 1 ORDER BY zeit DESC";
           $db->query($abfrage);
            while($row = $db->fetch_array()){
           // print_r($row['zeit']);
          

         if(date('Y', $row['zeit']) == date('Y')){
            $background = ($i % 2) ? '#00DD55' : '#009900;';
            $besuch = date('d.m.Y - H:i:s', $row['zeit']);
            $da = 1+floor(((time()-strtotime(date('Y-n-j H:i:s', $row['zeit']))))/(60*60*24));           
            $us++;
            eval("\$users .=\"".gettemplate("./templates/stat_users.tpl")."\";");
            }
            $i++;
            
            }
         $upd = round($us/$da,3);
  eval("\$inhalt .=\"".gettemplate("./templates/stat.tpl")."\";");
}/**/
  if(isset($_POST['show']))
  { 

  $db->query('SELECT * FROM logs WHERE ip="'.$_POST['show'].'" ORDER BY datum DESC');

  $i=1;
  while($row = $db->fetch_array())
  {
             $background = ($i % 2) ? '#00DD55' : '#009900;';

  $row['ref']=str_replace(array('http://trachtengruppe-merenschwand.ch/','http://www.trachtengruppe-merenschwand.ch/', '.html', '.shtml'), '', $row['ref']);
  $besuch = date('d.m.Y - H:i:s', $row['datum']);
  eval("\$users .=\"".gettemplate("./templates/stat_show_users.tpl")."\";");$i++;
  
  }
  $row = $db->fetch_array($db->query('SELECT ip FROM logs WHERE ip="'.$_POST['show'].'" ORDER BY datum DESC'));
  $logs=$row['ip'];
  eval("\$inhalt .=\"".gettemplate("./templates/stat_show.tpl")."\";");
  }         
$db->close();
?>
