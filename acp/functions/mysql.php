<?php
class mysql{
var $host = "";
var $name = "";
var $pswd = "";
var $db   = "";
var $verb = "";
var $query_id = 0;
var $link_id  = 0;
var $errno    = "";
var $error    = "";
var $retur   = "";
function connect($host="localhost", $name="123", $pswd="456", $db="789"){
$this->host = "$host";
$this->name = "$name";
$this->pswd = "$pswd";
$this->db   = "$db";
$this->verb = mysql_connect($this->host,$this->name,$this->pswd);
$this->link_id = mysql_select_db($this->db, $this->verb);
if(!$this->verb) $this->error("Verbindung nicht möglich");
if(!$this->link_id) $this->error("Datenbank existiert nicht");
}
function query($query){
  $this->query_id = mysql_query($query,$this->verb);
  if (!$this->query_id) $this->error("Invalid SQL: ".$query);
  return $this->query_id;
}
 function fetch_array($query_id=-1) {
  if ($query_id!=-1) $this->query_id=$query_id;
  $this->retur = mysql_fetch_array($this->query_id);
  return $this->retur;
 }
 
 function fetch_row($query_id=-1) {
  if ($query_id!=-1) $this->query_id=$query_id;
  $this->retur = mysql_fetch_row($this->query_id);
  return $this->retur;
 }
  function fetch_object($query_id=-1) {
  if ($query_id!=-1) $this->query_id=$query_id;
  $this->retur = mysql_fetch_object($this->query_id);
  return $this->retur;
 }
 function num_rows($query_id=-1) {
  if ($query_id!=-1) $this->query_id=$query_id;
  return mysql_num_rows($this->query_id);
 }
 function error($errormsg) {
  $this->error = mysql_error();
  $this->errno   = mysql_errno();    		
  $errormsg="<b>Datenbank Fehler:</b> $errormsg\n<br>";
  $errormsg.="<b>MySQL Fehler:</b> $this->error\n<br>";
  $errormsg.="<b>MySQL Fehlernummer:</b> $this->errno\n<br>";
  $errormsg.="<b>Datum:</b> ".date("d.m.Y - H:i")."\n<br>";
  $errormsg.="<b>Script:</b> ".$_SERVER["REQUEST_URI"]."\n<br>";
  echo $errormsg;
 }
 function close(){
mysql_close($this->verb);
}
}
?>
