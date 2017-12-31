<?php
require_once('../acp/functions/tpl.php');
require_once('../acp/functions/mysql.php');
require_once('../acp/functions/functions.php');
require_once('../acp/functions/image.php');
require_once('../acp/functions/phpmailer.php');
$title = 'Admin Control-Panel';
$style = '../css/style.css';
$page = (!isset($_GET['p']) OR $_GET['p']=='index')? "anfang": $_GET['p'];
$inhalt = "";
$menu = "";
?>