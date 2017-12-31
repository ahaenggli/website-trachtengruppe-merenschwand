<?php
function bbcode($bb)
{
    $bb = htmlentities($bb);
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
?>