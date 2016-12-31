<?php


include('global.php');

$tpl = $_GET['tpl'];
if($tpl=='startseite') $tpl = '_default';

$content = "";

if(file_exists('../templates/'.$tpl.'.tpl')){

if(isset($_POST['sender'])){
$_POST['datei_inhalt'] = utf8_decode($_POST['datei_inhalt']);

//$_POST['datei_inhalt'] = iconv("ISO-8859-2", "UTF-8//TRANSLIT", $_POST['datei_inhalt']);

 umlaute($_POST['datei_inhalt']);
$copy = copy('../templates/'.$tpl.'.tpl', '../templates/archiv/'.$tpl.'.tpl_'.time().'.bak');
$content = file_put_contents('../templates/'.$tpl.'.tpl', $_POST['datei_inhalt']);
}


$content = file_get_contents('../templates/'.$tpl.'.tpl');

$content = str_replace('&rdquo;', '&amp;rdquo;', $content);
$content = str_replace('&bdquo;', '&amp;bdquo;', $content);
//$content = iconv("ISO-8859-1", "UTF-8//TRANSLIT", $content);
// umlaute($content);
$inhalt = '   
<form action="./editor_'.$tpl.'.shtml" method="post" style="text-align:left;">
<textarea rows="20" cols="105" type="text" name="datei_inhalt" style="background-color:FFFFFF;font-family:Arial;" id="edity">'.$content.'</textarea>
<input type="submit" name="sender" value="Speichern">
</form>  
           '."
<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
<script>
  tinymce.init({
    selector: '#edity',
    language_url : 'http://www.trachtengruppe-merenschwand.ch/acp/langs/de.js',      
      width : 900,
      height : 500,
         forced_root_block : false,
        element_format : 'html',
        statusbar: false,
        style_formats: [
    { title: 'Headers', items: [
      { title: 'h1', block: 'h1' },
      { title: 'h2', block: 'h2' },
      { title: 'h3', block: 'h3' },
      { title: 'h4', block: 'h4' },
      { title: 'h5', block: 'h5' },
      { title: 'h6', block: 'h6' }
    ] },

    { title: 'Blocks', items: [
      { title: 'p', block: 'p' },
      { title: 'div', block: 'div' },
      { title: 'pre', block: 'pre' }
    ] },

    { title: 'Container', items: [
      { title: 'Zitat', block: 'blockquote', wrapper: true },
      { title: 'Author', block: 'cite', wrapper: false },
      { title: 'Pfeil', block: 'div', classes: 'sym' },
      { title: 'Rahmen', block: 'fieldset', wrapper: false, exact: false },
      { title: 'Titel', block: 'legend', wrapper: false, exact: false },
      { title: 'Grün', block: 'div', wrapper: false, classes: 'design design-ok' },
      { title: 'Info', block: 'div', wrapper: false, classes: 'design design-info' },
      { title: 'Rot', block: 'div', wrapper: false, classes: 'design design-wichtig' },
      { title: 'Braun', block: 'div', wrapper: false, classes: 'design design-text' },
      
      
    ] }
  ],

  content_css: '../css/neu_style.css',
        menubar: false,
    toolbar: 'fieldset undo redo styleselect bold italic underline alignleft aligncenter alignright bullist numlist outdent indent removeformat image link unlink table code',
  plugins: 'code image link table'
  });
  </script>

<!--

   -->    ".'
         
';

$inhalt.='<br><h2>Bilder verwalten</h2>';
 $_POST['main_jahr'] = 'diverses';
 $dir = '../images/galerie/'.$_POST['main_jahr'].'/';
 $path = $dir.$tpl.'';
 $__parentFile = "./editor_'.$tpl.'.shtml";
      if(!file_exists($path))
      {
      mkdir($path, 0777);     
      chmod($path, 0777);     
      }
      if(!file_exists($path.'/bilder/'))
      {
      mkdir($path.'/bilder/', 0777);     
      chmod($path.'/bilder/', 0777);     
      }
      
            if(!file_exists($path.'/thumbs/'))
      {
      mkdir($path.'/thumbs/', 0777);     
      chmod($path.'/thumbs/', 0777);     
      }
 $DivGalls = list_all($dir);
 $gid = array_keys($DivGalls, $path, false) ;
 $_GET['gid'] = $gid[0];
 
 require_once("gal.php");


} else $inhalt = 'Datei nicht gefunden...';
?>