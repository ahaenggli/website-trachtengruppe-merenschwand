<?php
$file = "kontakt.html";
$Zahl_1 = intval(rand(1, 5));
$Zahl_2 = intval(rand(1, 5));
$error = "";
$true = true;
if(!isset($_SESSION['spam'])) $_SESSION['spam']="NO";

if(!isset($_POST['message'])) $_POST['message']="";
if(!isset($_POST['name'])) $_POST['name']="";
if(!isset($_POST['email'])) $_POST['email']="";


$zahl = md5(($Zahl_1 + $Zahl_2));
if($_SESSION['spam'] != "Yes") $disabled = "";
else $disabled = "disabled=\"true\"";

if(isset($_POST['submit']))
{
if($_SESSION["spam"] != "Yes")
{
if($_POST['number'] != md5($_POST['arithmetic']))
{
$true = false;
$error .='<div class="design design-wichtig">
    <b>Die Rechenaufgabe wurde falsch gel&ouml;st!</b>
    </div>';
}
if($_POST['number'] == md5($_POST['arithmetic']))
{
$_POST['emaila']=$_POST['email'];
$_POST['email']='info@trachtengruppe-merenschwand.ch';
if(!filter_var($_POST['emaila'], FILTER_VALIDATE_EMAIL)){
$true = false;
$error .='<div class="design design-wichtig">
    <b>Die eingegebene E-Mail-Adresse ist ung&uuml;ltig!</b>
    </div>
    ';
}
if(preg_match ("/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$/", $_POST['email']))
{
if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message']) && $true == true)
{
$name          = utf8_decode(nl2br(stripslashes(htmlspecialchars($_POST['name']))));
$IP            = getenv("REMOTE_ADDR");
$absender      = preg_replace( "/[^a-z0-9 !?:;,.\/_\-=+@#$&\*\(\)]/im", "", $_POST['emaila'] );
$absender      = preg_replace( "/(content-type:|bcc:|cc:|to:|from:)/im", "", $absender );
$nachricht     = $_POST['message'];
$nachricht     = utf8_decode($nachricht);

$mailnachricht = "Name: $name\n
IP: $IP\n
E-Mail: $absender\n
Nachricht:\n$nachricht\n";
$from = "From: $name <$absender>\n";
$from.= "Reply-To: $absender\n";
$mail = mail('****', 'Website der Trachtengruppe Merenschwand', $mailnachricht, $from);
$_SESSION['spam']='Yes';
$_SESSION['dauer']=time()+500;
if($mail ==TRUE)
{
$error .='
    <div class="design design-ok">
    <b>Vielen Dank f&uuml;r Ihre Nachricht!</b> <br>
    Es wird schnellsm&ouml;glich versucht, darauf zu reagieren.
    </div>';
    
}}
else
{
$error .='<div class="design design-wichtig">
    <b>Bitte f&uuml;llen Sie alle Felder aus!</b>
    </div>';
}
}
}
}
} 

$_POST['email'] = (isset($_POST['emaila']))? $_POST['emaila']:$_POST['email'];
$_POST['message'] = utf8_decode($_POST['message']);
$_POST['name'] = utf8_decode($_POST['name']);

eval("\$inhalt =\"".gettemplate("./templates/kontakt.tpl")."\";");
?>