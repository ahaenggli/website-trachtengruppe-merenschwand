<?php


// returns true if $needle is a substring of $haystack
function contains($haystack, $needle)
{
    return strpos($haystack, $needle) !== false;
}


function check_mobile() {
  $agents = array(
    'Windows CE', 'Pocket', 'Mobile',
    'Portable', 'Smartphone', 'SDA',
    'PDA', 'Handheld', 'Symbian',
    'WAP', 'Palm', 'Avantgo',
    'cHTML', 'BlackBerry', 'Opera Mini',
    'Nokia'
  );

  // Prüfen der Browserkennung
  for ($i=0; $i<count($agents); $i++) {
    if(isset($_SERVER["HTTP_USER_AGENT"]) && strpos($_SERVER["HTTP_USER_AGENT"], $agents[$i]) !== false)
      return true;
  }

  return false;
}

function sicherung($txt){
$txt = utf8_decode($txt);
$txt = str_replace("\"", "", $txt);
$txt = strip_tags($txt);
return $txt;
}

function list_all($dir){
$r = glob($dir.'*');
$add = array();
foreach ($r as $re) {
$gal = @end(explode("/", $re));
if($gal != 'diverses')
$add[]=$re;//str_replace($dir.'00', '', $re);
}

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

   $inhalt =  str_replace('Â„', '&bdquo;', $inhalt);
   $inhalt =  str_replace("Â“", "&rdquo;", $inhalt);
   
   $inhalt =  str_replace('„', '&bdquo;', $inhalt);
   $inhalt =  str_replace("“", "&rdquo;", $inhalt);

   
    $inhalt = str_replace("ö","&ouml;",$inhalt);
    $inhalt = str_replace("ä","&auml;",$inhalt);
    $inhalt = str_replace("ü","&uuml;",$inhalt);
    $inhalt = str_replace("Ö","&Ouml;",$inhalt);
    $inhalt = str_replace("Ä","&Auml;",$inhalt);
    $inhalt = str_replace("Ü","&Uuml;",$inhalt);
    }


function save($name, $text){

 $datei = fopen($name,"w+");
  fwrite($datei, $text);
  fclose($datei);
  @chmod($name, 0777);
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