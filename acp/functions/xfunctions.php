<?php
function save($name, $text){

 $datei = fopen($name,"w+");
  fwrite($datei, $text);
  fclose($datei);
  @chmod($name, 0777);
}

function bbcodes_news($bb)
{
    //$bb = htmlentities($bb, ENT_QUOTES, "ISO-8859-1") ;//htmlentities($bb);
    $bb = preg_replace('/\[Geburtstag:Anfang\](.*?)\[Geburtstag:Ende\]/', '<div style=@display:block;background-image:url(*./images/baer.gif*);width:350px;height:200px;position:relative;background-position:50px 0px;background-repeat:no-repeat;font-size: 14px;@><ul style=@margin-left:80%;list-style-type:none;font-weight: bold; @>$1</ul></div>', $bb);
     
     $bb = preg_replace('/\[Person:Anfang\](.*?)\[Person:Ende\]/', '<li style=@white-space:nowrap@>$1</li>', $bb);
      $bb = preg_replace('/\[Kleeblatt\]/', '<img src=*./images/klee.gif* border=*0px* alt=*Kleeblatt*>', $bb);
     
    /*$bb = preg_replace('/\[i\](.*?)\[\/i\]/', '<i>$1</i>', $bb);
    $bb = preg_replace('/\[u\](.*?)\[\/u\]/', '<u>$1</u>', $bb);
    $bb = preg_replace('/\[color:(.*?)\](.*?)\[\/color\]/', '<span style="color:$1">$2</span>', $bb);
    $bb = preg_replace('/\[url\](.*?)\[\/url\]/', '<a href="$1">$1</a>', $bb);
    $bb = preg_replace('/\[url=([^ ]+).*\](.*)\[\/url\]/', '<a href="$1">$2</a>', $bb);
    $bb = preg_replace('/\n/', "<br>\n", $bb);
    */return $bb;
}

function oldnews_2_bbcodes($bb){
        
$bb = preg_replace('/\<li style=@white-space:nowrap@\>(.*?)\<\/li\>/','[Person:Anfang]$1[Person:Ende]',  $bb);
$bb = preg_replace('/\<img src=\*.\/images\/klee.gif\* border=\*0px\* alt=\*Kleeblatt\*\>/','[Kleeblatt]',  $bb);
  return $bb;
}

function bbcode($bb)
{
    $bb = htmlentities($bb, ENT_QUOTES, "ISO-8859-1") ;//htmlentities($bb);
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
$inhalt = str_replace(':(D:', '<img src="./images/smilies/D.gif">', $inhalt);
$inhalt = str_replace(':):', '<img src="./images/smilies/C.gif">', $inhalt);
$inhalt = str_replace(':-):', '<img src="./images/smilies/CC.gif">', $inhalt);
$inhalt = str_replace(':-:', '<img src="./images/smilies/m.gif">', $inhalt);
$inhalt = str_replace(':00:', '<img src="./images/smilies/00.gif">', $inhalt);
$inhalt = str_replace(':xD:', '<img src="./images/smilies/xD.gif">', $inhalt);
$inhalt = str_replace(':winki:', '<img src="./images/smilies/winki.gif">', $inhalt);
$inhalt = str_replace(':17:', '<img src="./images/smilies/17.gif">', $inhalt);
$inhalt = str_replace(':blabla:', '<img src="./images/smilies/blabla.gif">', $inhalt);
$inhalt = str_replace(':angel:', '<img src="./images/smilies/angel.gif">', $inhalt);
return $inhalt;
}
function sicherung($txt){
$txt = str_replace("\"", "", $txt);
$txt = strip_tags($txt);
return $txt;
}

function list_all($dir){
$r = glob($dir.'*');
$add = array();
foreach ($r as $re) $add[]=$re;//str_replace($dir.'00', '', $re);
return $add;
}
function list_files($dir){
return glob($dir."*.*");//.$type);
}
function list_file($dir, $nr=0){
$g = glob($dir."*.*");
  return $g[$nr];
}
 function list_dirs($dir){
$r = glob($dir.'*');
$add = array();
foreach ($r as $re) $add[]=$re;//str_replace($dir.'00', '', $re);
return $add;
}
                     function ranul($s){
    $s = str_replace("/", "_", $s) ;
    return $s;
    }
    function umlaute(&$inhalt){
    $inhalt = str_replace("ö","&ouml;",$inhalt);
    $inhalt = str_replace("ä","&auml;",$inhalt);
    $inhalt = str_replace("ü","&uuml;",$inhalt);
    $inhalt = str_replace("Ö","&Ouml;",$inhalt);
    $inhalt = str_replace("Ä","&Auml;",$inhalt);
    $inhalt = str_replace("Ü","&Uuml;",$inhalt);
    }



function delete ($path) {
    // schau' nach, ob das ueberhaupt ein Verzeichnis ist
    if (!is_dir ($path)) {
        return -1;
    }
    // oeffne das Verzeichnis
    $dir = @opendir ($path);
    
    // Fehler?
    if (!$dir) {
        return -2;
    }
    
    // gehe durch das Verzeichnis
    while (($entry = @readdir($dir)) !== false) {
        // wenn der Eintrag das aktuelle Verzeichnis oder das Elternverzeichnis
        // ist, ignoriere es
        if ($entry == '.' || $entry == '..') continue;
        // wenn der Eintrag ein Verzeichnis ist, dann 
        if (is_dir ($path.'/'.$entry)) {
            // rufe mich selbst auf
            $res = delete ($path.'/'.$entry);
            // wenn ein Fehler aufgetreten ist
            if ($res == -1) { // dies duerfte gar nicht passieren
                @closedir ($dir); // Verzeichnis schliessen
                return -2; // normalen Fehler melden
            } else if ($res == -2) { // Fehler?
                @closedir ($dir); // Verzeichnis schliessen
                return -2; // Fehler weitergeben
            } else if ($res == -3) { // nicht unterstuetzer Dateityp?
                @closedir ($dir); // Verzeichnis schliessen
                return -3; // Fehler weitergeben
            } else if ($res != 0) { // das duerfe auch nicht passieren...
                @closedir ($dir); // Verzeichnis schliessen
                return -2; // Fehler zurueck
            }
        } else if (is_file ($path.'/'.$entry) || is_link ($path.'/'.$entry)) {
            // ansonsten loesche diese Datei / diesen Link
            $res = @unlink ($path.'/'.$entry);
            // Fehler?
            if (!$res) {
                @closedir ($dir); // Verzeichnis schliessen
                return -2; // melde ihn
            }
        } else {
            // ein nicht unterstuetzer Dateityp
            @closedir ($dir); // Verzeichnis schliessen
            return -3; // tut mir schrecklich leid...
        }
    }
    
    // schliesse nun das Verzeichnis
    @closedir ($dir);
    
    // versuche nun, das Verzeichnis zu loeschen
    $res = @rmdir ($path);
    
    // gab's einen Fehler?
    if (!$res) {
        return -2; // melde ihn
    }
    
    // alles ok
    return 0;
}
?>