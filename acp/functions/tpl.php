<?php
function gettemplate($tpl){
if(!file_exists($tpl)){
$tpl = './templates/index.tpl';
}
return str_replace("\"", "\\\"", implode("", file($tpl)));
}
function outtpl($print){
print($print);
}
?>