<?php
/* Funktionen laden */
if($dir=opendir('./acp/functions/'))
{
 while($file=readdir($dir)) {
  if (!is_dir('./acp/functions/'.$file) && $file != "." && $file != "..") require_once('./acp/functions/'.$file);
 }
closedir($dir);
}

$db = new mysql;
$db->connect();
$select = $db->query("SELECT * FROM cms ORDER BY Datum desc;");
while($row = $db->fetch_array()){
$header   = $row['header'];
$header = bbcodes_news($header);
$header= str_replace("&", "&amp;", $header);
$header= str_replace("\n", "<br/>", $header);
$header= str_replace("ä", "&auml;", $header);
$header= str_replace("ö", "&ouml;", $header);
$header= str_replace("ü", "&uuml;", $header);
$header= str_replace(" & ", " &amp; ", $header);
$header= str_replace("Ä", "&Auml;", $header);
$header= str_replace("Ö", "&Ouml;", $header);
$header= str_replace("Ü", "&Uuml;", $header);
$header = str_replace("*","'", $header);
$header = str_replace('@', '"', $header);
$header = str_replace("klee.gif", "klee.png", $header);
if($row['aktiv'] == 1)
$news['neues_'.$row['id'].'.shtml|'.$header] = $row['aktiv'];

$archivy['archiv_'.$row['id'].'.shtml|'.$header] = (preg_match('#Geburtstag#', $header))? "0":'1';
}

$news['neuigkeitenarchiv.shtml|Neuigkeitenarchiv']=$archivy;

$db->close();


/*Galerieindex für alle Jahre, für späteren durchgang weil neuste zuoberst sein muss*/
$gals = array();

foreach ((list_all('./images/galerie/')) as $tmp) foreach (list_all($tmp.'/') as $tt) $gals[] =  $tt;
$cco = count($gals); 

$gals =  (list_all('./images/galerie/'));     
$menu_fotos_uno = array();
arsort($gals);

foreach ($gals as $gal)  {


  $gal = @end(explode("/", $gal));
  
  //$menu_fotos_uno['galerie_'.$gal.'.shtml|'.$gal.''] = '';
  $gals3 =  (list_all('./images/galerie/'.$gal.'/'));
  arsort($gals3);
   foreach($gals3 as $gg){
  
    $lf = list_files($gg.'/');
    $fc = file($lf[0]);
    $fc[0] = utf8_encode($fc[0]);
    //$menu_fotos_uno['galerie_'.$gal.'.shtml|'.$gal.'']['galerie_'.($cco).'-1.shtml|'.$fc[0]] = '';
   
  $gal4 = @end(explode("/", $gg));
  $str = $gal4; 
  
  $gal4 =  (list_files('./images/galerie/'.$gal.'/'.$str.'/bilder/'));
  
  arsort($gal4);
  $i = 0;
   foreach($gal4 as $img){
   $i++;
      $img = @end(explode("/", $img));
    $menu_fotos_uno['galerie_'.$gal.'.shtml|'.$gal.'']['galerie_'.($cco).'-1.shtml|'.$fc[0]]['img_'.$cco.'-'.$i.'.shtml|Bild '.$i] = '';
    
   }    
   
    
    $cco--;
   } 
}
 
/* Menu aufbauen */
$menu_items_def = "array (
'neues.html|Neues'          =>\$news,
'infos.html|&Uuml;ber uns'  =>array('agenda.html|Agenda'=>''),
'vorstand.html|Vorstand'  =>array('praesidenten.html|Liste aller Pr&auml;sidentinnen'=>''),
'tanzgruppe.html|Tanzgruppe'=>array('tanzproben.html|Tanzproben'=>'',
                                    'kindertanz.html|Kindertanzen'=>'',
                                    'leitung_tanzen.html|Leitung'=>''),
'singgruppe.html|Singgruppe'=>array('singproben.html|Singproben'=>'',
                                    'leitung_singen.html|Leitung'=>''),
'geschichte.html|Geschichte'=>array('trachtengruppe_merenschwand_um_1940.html|Trachtengruppe Merenschwand um 1940'=>'',
                                    'anfaenge.html|Die Anf&auml;nge der Trachtengruppe'=>''),
'archiv.html|Archiv'        =>array('archiv_pressebericht_gv_2015.html|85. Generalversammlung 2015'=>'',
                                    'archiv_kigru_sommerausflug_2014.html|Sommerausflug der Kindertanzgruppe'=>'', 
                                    'archiv_pressebericht_gv_2014.html|84. Generalversammlung 2014'=>'',
                                    'archiv_pressebericht_gv_2013.html|83. Generalversammlung 2013'=>'',
                                    'archiv_fiesch_2012.html|Traumhafte Brauchtumswoche Fiesch 2012'=>'',       
                                    'archiv_reisebericht_suedtirol.html|Reisebericht S&uuml;dtirol 2012'=>'',
                                    'archiv_pressebericht_gv_2012.html|82. Generalversammlung 2012'=>'',
                                    'archiv_trachtenfenster1-2011.html|Trachtenfenster Nr. 1- 2011'=>'',
                                    'archiv_zuerioberland.html|Pressebericht Trachtengruppe im Z&uuml;rcher Oberland'=>'',
                                    'archiv_pressebericht_gv_2011.html|81. Generalversammlung 2011'=>'',
                                    'archiv_pressebericht_gv_2010.html|80. Generalversammlung 2010'=>'',
                                    'archiv_pressebericht_gv_2009.html|79. Generalversammlung 2009'=>'',
                                    'archiv_pressebericht_gv_2008.html|78. Generalversammlung 2008'=>'',
                                    'archiv_pressebericht_gv_2007.html|77. Generalversammlung 2007'=>'',
                                    'archiv_hochzeit_regula.html|Hochzeit Regula K&auml;ppeli &amp; Ernst Schuler (2006)'=>'',
                                    'archiv_pressebericht_gv_2006.html|76. Generalversammlung 2006'=>'',
                                    'archiv_75_jahre.html|75 Jahre Trachtengruppe Merenschwand (2005)'=>'',
                                    'archiv_75_jahre_pressebericht.html|75 Jahre Trachtengruppe Merenschwand (2005) &lt;=(Pressebericht dazu)'=>'',
                                    'archiv_pressebericht_gv_2005.html|75. Generalversammlung 2005'=>'',
                                    'archiv_pressebericht_gv_2004.html|74. Generalversammlung 2004'=>'',
                                    'archiv_brauchtumswoche.html|Trachten Brauchtumswoche (2003)'=>'',
                                    'archiv_theater.html|Aufgef&uuml;hrte Theater seit 1971'=>''
                                    ) ,
'fotos.html|Fotos'    =>\$menu_fotos_uno,
'links.html|Links'=>'',
'gaestebuch.html|G&auml;stebuch'    =>array('gaestebuch.html|Alle Eintr&auml;ge'=>'',          
                                    'gaestebuch_eintragen.html|Eintragen'=>'' ),
'kontakt.html|Kontakt'      =>''  

 
);";

     $bb = $menu_items_def;
     //$bb = str_replace("'", "\'", $bb);
     //$bb = str_replace("°*-*°", "'", $bb);
     //$bb = str_replace("#br#", "\n", $bb);
     $tmp = "";
     $bb = " \$tmp = ".$bb;
     //echo $bb;
     eval($bb);
     $menu_items = $tmp;
     
if(isset($_GET['gg'])){


 echo serialize($menu_items);
 
 }
?>