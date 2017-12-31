<?php 
 $db = new mysql;
 $db->connect();
$ip = $_SERVER['REMOTE_ADDR']; 
$browser = "";
$pc = "";
$url = basename($_SERVER['REQUEST_URI']);
$time = time();
if(!isset($_SERVER['HTTP_REFERER'])) $_SERVER['HTTP_REFERER'] = "http://cadac.trachtengruppe-merenschwand.ch/";

$referer = eregi_replace('http://cadac.trachtengruppe-merenschwand.ch/', '', $_SERVER['HTTP_REFERER']);


$db->query('SELECT cc from s_ip2n where ip_from <= inet_aton("'.$ip.'") and ip_to >= inet_aton("'.$ip.'")');
$row = $db->fetch_object();
@$cc = $row->cc;

if (ereg('Gecko' , $_SERVER['HTTP_USER_AGENT'])) $browser.= 'Mozilla'; 
if (ereg('Firefox' , $_SERVER['HTTP_USER_AGENT'])) $browser.= ' Firefox'; 
if (ereg('Netscape' , $_SERVER['HTTP_USER_AGENT'])) $browser.= ' Netscape'; 
if (ereg('MSIE' , $_SERVER['HTTP_USER_AGENT'])) $browser.= ' Internet Explorer'; 
if (ereg('Opera' , $_SERVER['HTTP_USER_AGENT'])) $browser.= ' Opera'; 
if (ereg('AppleWebKit' , $_SERVER['HTTP_USER_AGENT'])) $browser.= ' AppleWebKit'; 
if (ereg('Konqueror' , $_SERVER['HTTP_USER_AGENT'])) $browser.= ' Konqueror'; 
if (ereg('Avant',$_SERVER['HTTP_USER_AGENT'])) $browser.= ' Avant';
if (ereg('Safari',$_SERVER['HTTP_USER_AGENT']))    $browser.= ' Safari';

   if   (strstr($_SERVER['HTTP_USER_AGENT'], 'Windows 98'))      $pc='Windows 98';
   elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'NT 4.0'))        $pc='Windows NT ';
   elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'NT 5.1'))        $pc='Windows XP';
   elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'NT 6.0'))        $pc='Windows Vista';
      
   elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Win'))           $pc='Windows';
   elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Mac'))           $pc='Mac OS';
   elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Linux'))         $pc='Linux';
   elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Unix'))          $pc='Unix';

$db->query('INSERT INTO logs 
           (ip, 
            host, 
            cc, 
            time, 
            browser, 
            pc, 
            referer, 
            site) 
            VALUES 
           ("'.$ip.'", 
            "'.gethostbyaddr($ip).'", 
            "'.$cc.'", "'.$time.'", 
            "'.$browser.'", 
            "'.$pc.'", 
            "'.$referer.'", 
            "'.$url.'");');
$db->close();
?> 