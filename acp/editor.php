<?php


include('global.php');

$tpl = $_GET['tpl'];

$content = "";

if(file_exists('../templates/'.$tpl.'.tpl')){

if(isset($_POST['sender'])){
$content = file_put_contents('../templates/'.$tpl.'.tpl', $_POST['datei_inhalt']);
}


$content = file_get_contents('../templates/'.$tpl.'.tpl');


$inhalt = '   
<form action="./editor_'.$tpl.'.shtml" method="post" style="text-align:left;">
<textarea rows="20" cols="105" type="text" name="datei_inhalt" style="background-color:FFFFFF;font-family:Arial;">'.$content.'</textarea>
<input type="submit" name="sender" value="Speichern">
</form>           
';


} else $inhalt = 'Datei nicht gefunden...';
?>