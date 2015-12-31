<?php
include_once('global.php');

function HandleError($message) {
	header("HTTP/1.1 500 Internal Server Error");
	echo $message;
}

if(isset($_POST['CreateJahr'])){
      if(file_exists('../images/galerie/'.$_POST['titel'].'/')) {}
      else{
      $path = '../images/galerie/'.$_POST['titel'].'/'   ;
      mkdir($path, 0777);     
      chmod($path, 0777);     
    }
}

if(isset($_POST['DelJahr'])){
    delete('../images/galerie/'.$_POST['DelJahr'].'/');
    header('LOCATION: gal.html');

}
    
if(isset($_POST['main_jahr']))
{
  $main_jahr =   $_POST['main_jahr'];
}elseif(isset($_GET['main_jahr'])){
  $main_jahr = $_GET['main_jahr'];
}
else
{


$gals = list_all('../images/galerie/'); 

$inhalt.='<fieldset style="text-align:left;width:500px;"><legend>Bestehende Hauptgalerien/Jahre:</legend><br>'; 
for($i=0;$i<=(count($gals)-1);$i++)//$i>=0;$i--) 
{
$gals[$i] = str_replace('../images/galerie/', '', $gals[$i]);        
$inhalt.= '<a href="gal_jahr_'.$gals[$i].'.shtml" style="font-size:14px;text-decoration:none;">>'.$gals[$i].'< bearbeiten</a><br>';
}     
$inhalt.= '</fieldset>

<br>
<form method="post" action="gal.html">
Eine Galerie f&uuml;r das Jahr <input type="text" name="titel" value=""><input type="submit" name="CreateJahr" value="erstellen">.'; 
$inhalt.= '</form>';
$inhalt.= '<br><br>'; 
}

if(isset($main_jahr)){

$main_path = '../images/galerie/'.$main_jahr.'/';

$gals = list_all($main_path);
   
if(!isset($_GET['gid'])){ 

$gals = list_all($main_path); 

$inhalt.='<fieldset style="text-align:left;width:650px;"><legend style="text-align:left;width:400px">Bestehende Galerien f&uuml;r >'.$main_jahr.'< ';
$inhalt.= '<form method="post" action="gal.html" style="display:inline;float:right;">'; 
$inhalt.= '<input type="hidden" name="DelJahr" value="'.$main_jahr.'"><input type="submit" name="Delly" value="Alles löschen"></form>';
$inhalt.= '</legend><br>'; 

for($i=0;$i<=(count($gals)-1);$i++)//$i>=0;$i--) 
{
$lf = list_files($gals[$i].'/');
$fc = file($lf[0]);
$inhalt.= '  <a href="gal_gid_'.$i.'_jahr_'.$main_jahr.'.shtml" style="font-size:14px;text-decoration:none;">'.($i+1).'. >'.trim($fc[0]).'< bearbeiten</a><br>';
}
$inhalt.= '</fieldset>';                

$inhalt.= '<br><br><br><form method="post" action="gal_gid_'.(count($gals)).'_jahr_'.$main_jahr.'.shtml"><table><tr><td>Galerietitel:</td><td><input type="text" style="width:500px;" name="titel" value=""></td></tr>'; 
$inhalt.= '<tr><td valign="top">Galerietext:</td><td><textarea name="text" style="width:500px;height:100px;"></textarea></td></tr></table>';
$inhalt.= '<input type="submit" name="submit" value="Neu erstellen"></form>';
$inhalt.= '<br><br>';     
    
}else{
      
if(isset($_POST['upload'])){


$gals = list_all($main_path);         
// Code for Session Cookie workaround
	if (isset($_POST["PHPSESSID"])) {
		session_id($_POST["PHPSESSID"]);
	} else if (isset($_GET["PHPSESSID"])) {
		session_id($_GET["PHPSESSID"]);
	}
     
	//session_start();                
  
    foreach($_FILES['datei']['name'] as $key => $value){
            
    
    
// Check post_max_size (http://us3.php.net/manual/en/features.file-upload.php#73762)
	$POST_MAX_SIZE = ini_get('post_max_size');
	$unit = strtoupper(substr($POST_MAX_SIZE, -1));
	$multiplier = ($unit == 'M' ? 1048576 : ($unit == 'K' ? 1024 : ($unit == 'G' ? 1073741824 : 1)));
          
	if ((int)$_SERVER['CONTENT_LENGTH'] > $multiplier*(int)$POST_MAX_SIZE && $POST_MAX_SIZE) {
		header("HTTP/1.1 500 Internal Server Error");
		echo "POST exceeded maximum allowed size.";
		exit(0);
	}

// Settings
	$save_path = getcwd() . "/uploads/";				// The path were we will save the file (getcwd() may not be reliable and should be tested in your environment)
	$upload_name = "datei";
	$max_file_size_in_bytes = 2147483647;				// 2GB in bytes
	$extension_whitelist = array("jpg", "gif", "png", "jpeg", "JPG", "JPEG");	// Allowed file extensions
	$valid_chars_regex = '.A-Z0-9_ !@#$%^&()+={}\[\]\',~`-';				// Characters allowed in the file name (in a Regular Expression format)
	
  
 // Other variables	
	$MAX_FILENAME_LENGTH = 260;
	$file_name = "";
	$file_extension = "";
	$uploadErrors = array(
        0=>"There is no error, the file uploaded with success",
        1=>"The uploaded file exceeds the upload_max_filesize directive in php.ini",
        2=>"The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
        3=>"The uploaded file was only partially uploaded",
        4=>"No file was uploaded",
        6=>"Missing a temporary folder"
	);



     
// Validate the upload
	if (!isset($_FILES[$upload_name])) {
		HandleError("No upload found in \$_FILES for " . $upload_name);
		exit(0);
	} else if (isset($_FILES[$upload_name]["error"][$key]) && $_FILES[$upload_name]["error"][$key] != 0) {
		HandleError($uploadErrors[$_FILES[$upload_name]["error"][$key]]);
		exit(0);
	} else if (!isset($_FILES[$upload_name]["tmp_name"][$key]) || !@is_uploaded_file($_FILES[$upload_name]["tmp_name"][$key])) {
		HandleError("Upload failed is_uploaded_file test.");
		exit(0);
	} else if (!isset($_FILES[$upload_name]['name'][$key])) {
		HandleError("File has no name.");
		exit(0);
	}
	              
// Validate the file size (Warning the largest files supported by this code is 2GB)
	$file_size = @filesize($_FILES[$upload_name]["tmp_name"][$key]);
	if (!$file_size || $file_size > $max_file_size_in_bytes) {
		HandleError("File exceeds the maximum allowed size");
		exit(0);
	}


// Validate file name (for our purposes we'll just remove invalid characters)
	$file_name = preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', "", basename($_FILES[$upload_name]['name'][$key]));
	if (strlen($file_name) == 0 || strlen($file_name) > $MAX_FILENAME_LENGTH) {
		HandleError("Invalid file name");
		exit(0);
	}


// Validate that we won't over-write an existing file
	if (file_exists($save_path . $file_name)) {
		HandleError("File with this name already exists");
		exit(0);
	}

// Validate file extention
	$path_info = pathinfo($_FILES[$upload_name]['name'][$key]);
	$file_extension = $path_info["extension"];
	$is_valid_extension = false;
	foreach ($extension_whitelist as $extension) {
		if ($file_extension == $extension) {
			$is_valid_extension = true;
			break;
		}
	}
	if (!$is_valid_extension) {
		HandleError("Invalid file extension");
		exit(0);
	}

                
      $pb = $gals[$_GET['gid']].'/bilder/';
      $pt = $gals[$_GET['gid']].'/thumbs/';
                 $lfpb = list_files($pb);
      $name = end($lfpb);
      $name = explode('/', $name);
      $name = end($name);
      $ne = explode('.', $name);
      $datei = str_pad(($ne[0]+1).'.jpg', 8 ,'0', STR_PAD_LEFT); 
	
       move_uploaded_file($_FILES[$upload_name]['tmp_name'][$key], $pb.$datei);
                  $file        = $pb.$datei;
                  $target    = $pb.$datei;
                  $max_width   = "800"; //Breite ändern
                  $max_height   = "600"; //Höhe ändern
                  $quality     = "100"; //Qualität ändern (max. 100)
                  $src_img     = imagecreatefromjpeg($file);
                  $picsize     = getimagesize($file);
                  $src_width   = $picsize[0];
                  $src_height  = $picsize[1];
                  
            
                  if($src_height > $max_height)
                  {
                    $convert = $max_height/$src_height;
                    $dest_height = $max_height;
                    $dest_width = ceil($src_width*$convert);
                  }
                  else
                  {
                    $dest_height = $src_height;
                    $dest_width = $src_width;
                  }
                 
                  $dst_img = imagecreatetruecolor($dest_width,$dest_height);
                  imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dest_width, $dest_height, $src_width, $src_height);
                  imagejpeg($dst_img, "$target", $quality);
// Ab hier wird noch eine Thumbnail erstellt. 
                  $file2       = $pb.$datei;
                  $target2    = $pt.$datei;
                  $max_width   = "200"; //Thumbnailbreite
                  $max_height   = "150"; //Thumbnailhöhe
                  $quality     = "90"; //Thumbnailqualität
                  $src_img     = imagecreatefromjpeg($file2);
                  $picsize     = getimagesize($file2);
                  $src_width   = $picsize[0];
                  $src_height  = $picsize[1];
                       
                
                  if($src_width > $max_width)
                  {
                    $convert = $max_width/$src_width;
                    $dest_width = $max_width;
                    $dest_height = ceil($src_height*$convert);
                  }
                  else
                  {
                    $dest_width = $src_width;
                    $dest_height = $src_height;
                  }
                 
                  $dst_img = imagecreatetruecolor($dest_width,$dest_height);
                  imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dest_width, $dest_height, $src_width, $src_height);
                  imagejpeg($dst_img, "$target2", $quality);

	//echo "File Received ". $save_path.$file_name;
	}

    
    }
if(isset($_POST['delete'])){

    $gals = list_all($main_path);
    $lf = list_files($gals[$_GET['gid']].'/');
    delete($gals[$_GET['gid']]);
    header('LOCATION: gal.html');
}



if(isset($_POST['submit'])){
  $gals = list_all($main_path);

if ($_GET['gid']>=count($gals)) {

$egals = explode('/',end($gals));
     $path = $main_path. str_pad(end($egals)+1, 2 ,'0', STR_PAD_LEFT).'/';
      mkdir($path, 0777);    
      mkdir($path.'bilder/', 0777); 
      mkdir($path.'thumbs/', 0777); 
      chmod($path, 0777);    
      chmod($path.'bilder/', 0777); 
      chmod($path.'thumbs/', 0777); 
      
     
      
    }
    $gals = list_all($main_path);
    $lf = list_files($gals[$_GET['gid']].'/');
save($gals[$_GET['gid']].'/infos.txt', $_POST['titel']."\n\r".$_POST['text']);
}



$lf = list_files($gals[$_GET['gid']].'/');
$lt = list_files($gals[$_GET['gid']].'/thumbs/');
    
if (isset($_POST['save'])){
    $cbs = $_POST['cb'];
    for($i=0;$i<count($cbs);$i++){
      if (@$cbs[$i]!='') {
      unlink($cbs[$i]);
      unlink(str_replace('thumbs', 'bilder', $cbs[$i]));
      header('LOCATION: gal_gid_'.$_GET['gid'].'.shtml');
      }
    }
    }


$fc = file($lf[0]);
$inhalt.= '<form method="post" action="gal_gid_'.$_GET['gid'].'_jahr_'.$main_jahr.'.shtml"><table><tr><td>Galerietitel:</td><td><input type="text" style="width:500px;" name="titel" value="'.$fc[0].'"></td></tr>'; $fc[0]='';
$inhalt.= '<tr><td valign="top">Galerietext:</td><td><textarea name="text" style="width:500px;height:100px;">'.implode('', $fc).'</textarea></td></tr></table>';
$inhalt.= '<input type="submit" name="submit" value="Speichern"> <input type="submit" name="delete" value="Galerie löschen"></form>';
$inhalt.= '<br><br>';


$inhalt.='<div id="content">

	<form id="form1" action="gal_gid_'.$_GET['gid'].'_jahr_'.$main_jahr.'.shtml" method="post" enctype="multipart/form-data">
	
			<fieldset>
			<legend>Warteschlange</legend>
		
	
				 <input type="file" multiple="multiple" name="datei[]" id="files"   />
              <input type="submit" value="Hochladen">    (max. 20 gleichzeitig!)
              <input type="hidden" value="php" name="upload">
				</fieldset>

	</form>
</div>';
$inhalt.= '<br>';
$inhalt.= '<form METHOD="POST"><table><tr><td>Bild</td><td>Dateiname:</td><td>L&ouml;schen?</td><td style="padding-left:50px;">Bild</td><td>Dateiname:</td><td>L&ouml;schen?</td></tr>';
for($i=0;$i<count($lt);$i++){
$pic = $lt[$i];
$n = explode('/', $pic);
$n = $n[count($n)-1];
$inhalt.= '<tr><td><img src="'.$pic.'"></td><td><input type="text" name="name[]" value="'.$n.'" style="width:75px;"></td><td style="text-align:right;"><input type="checkbox" name="cb[]" value="'.$pic.'"></td>';
$i++;
if($i<count($lt)){
$pic = $lt[$i];
$n = explode('/', $pic);
$n = $n[count($n)-1];
$inhalt.= '<td style="padding-left:50px;"><img src="'.$pic.'"></td><td><input type="text" name="name[]" style="width:75px;" value="'.$n.'"></td><td style="text-align:right;"><input type="checkbox" value="'.$pic.'" name="cb[]"></td>';
}else '<td></td><td></td><td></td><td></td><td></td><td></td>';

$inhalt.= '</tr>';
}
$inhalt.= '</table><input type="submit" name="save" value="Speichern"></form>';
}
  
}


?>