<?php
header('Content-Type: application/xml; charset=utf8');
//header('Content-Type: application/rss+xml; charset=utf8');
echo file_get_contents('http://www.blick.ch/news/schweiz/rss');
?>