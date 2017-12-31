<br>
<?php
if(isset($_GET['gva']))
{
$_POST['gva']=$_GET['gva'];
}
$a=$_POST['gva'];
$file_n = str_pad($a+1, 3 ,'0', STR_PAD_LEFT);
$file_v = str_pad($a-1, 3 ,'0', STR_PAD_LEFT);

if(file_exists('./GV/'.$file_n.'.jpg'))
{
$weiter='<a href="./gv2_'.$file_n.'.shtml"><b>Weiter</b></a>';
}
else
{
$weiter='<b>Weiter</b>';
}
if($a==1)
{
$zur='<b>Zur&uuml;ck</b>';
}
else
{
$zur='<a href="gv2_'.$file_v.'.shtml"><b>Zur&uuml;ck</b></a>';
}

?>
<img src="<?php echo './GV/'.$a.'.jpg'; ?>" alt="Bild">
<br><br>
<div align="center">
<?php echo $zur;?>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="./gv.html"><b>&Uuml;bersicht</b></a>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $weiter; ?>
</div>