<?php
if($_GET['sql']==='sqlquery'){
include "global.php";
$db = new mysql;
$db->connect();

if($db->query($_GET['query'])){
header('LOCATION: '.$_SERVER['HTTP_REFERER']);
echo 'Okay';
}else{
echo 'Sorry<br>';
echo $_GET['query'];
}


}else{
echo 'Error: You\'re an idiot!';
}


?>