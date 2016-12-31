<?php
function gettemplate($tpl){
if(!file_exists($tpl)){
$tpl = './templates/index.tpl';
}
return utf8_encode(str_replace("\"", "\\\"", implode("", file($tpl))));
}
function outtpl($print){

echo((($print)));
}
?>