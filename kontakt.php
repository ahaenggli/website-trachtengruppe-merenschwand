<?php
$file = "kontakt.html";
$Zahl_1 = intval(rand(1, 5));
$Zahl_2 = intval(rand(1, 5));
$error = "";
$true = true;if(!isset($_SESSION['spam'])) $_SESSION['spam']="NO";
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
$error .="<p><font style=\"color:darkred; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:16px\"><b>Die Rechenaufgabe wurde falsch gel&ouml;st!</b></font></p>";
}
if($_POST['number'] == md5($_POST['arithmetic']))
{
$_POST['emaila']=$_POST['email'];
$_POST['email']='info@trachtengruppe-merenschwand.ch';
if(!ereg ("^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$", $_POST['email']))
{
$true = false;
$error .="<p><font style=\"color:darkred; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:16px\"><b>Die eingegebene E-Mail-Adresse ist ung&uuml;ltig!</b></font></p>";
}
if(ereg ("^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$", $_POST['email']))
{
if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message']) && $true == true)
{
$name          = nl2br(stripslashes(htmlspecialchars($_POST['name'])));
$IP            = getenv("REMOTE_ADDR");
$absender      = preg_replace( "/[^a-z0-9 !?:;,.\/_\-=+@#$&\*\(\)]/im", "", $_POST['emaila'] );
$absender      = preg_replace( "/(content-type:|bcc:|cc:|to:|from:)/im", "", $absender );
$nachricht     = $_POST['message'];
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
$error .="<p><font style=\"color:darkgreen; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:16px\"><b>Vielen Dank f&uuml;r Ihre Nachricht!</b> <br>
Ich lasse Ihnen umgehend eine Antwort zukommen und/oder behebe den Fehler, den Sie gemeldet haben.</font></p>";
}}
else
{
$error .="<p><font style=\"color:darkred; font-family:Geneva, Arial, Helvetica, sans-serif; font-size:16px\"><b>Bitte f&uuml;llen Sie alle Felder aus!</b></font></p>";
}
}
}
}
} 
eval("\$inhalt =\"".gettemplate("./templates/kontakt.tpl")."\";");
?>