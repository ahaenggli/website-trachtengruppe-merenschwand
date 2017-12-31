<?php
class image{
var $img = "";
var $text = "";
var $font = "";
var $white = "";
var $black = ""; 
var $red = ""; 
var $green = ""; 
var $blue = ""; 
var $type = "";
var $path = "";
function loadbild($path){
$this->path = $path;
$this->img = $this->imagecreatefromfile($path);
$this->type  =  $this->imagetype($path);
$this->white = imagecolorallocate($this->img,255,255,255); 
$this->black = imagecolorallocate($this->img,0,0,0); 
$this->red   =   imagecolorallocate($this->img,255,0,0); 
$this->green = imagecolorallocate($this->img,0,255,0); 
$this->blue  =  imagecolorallocate($this->img,0,0,255);  
}
function add($size, $angle, $x, $y, $color="",$font, $text){
imagettftext($this->img, $size, $angle  ,$x  , $y  ,$this->white  ,$font, $text);
}
function newbild($width, $height){
$this->img = ImageCreate($width, $height);
$this->white = imagecolorallocate($this->img,255,255,255); 
$this->black = imagecolorallocate($this->img,0,0,0); 
$this->red = imagecolorallocate($this->img,255,0,0); 
$this->green = imagecolorallocate($this->img,0,255,0); 
$this->blue = imagecolorallocate($this->img,0,0,255); 
}
function antialias(){
imageantialias($this->img, true);
}
function ausgabe(){

header("Content-Type: image/".$this->type.""); 
$this->imagefile($this->path, $this->img);
}
function save($name, $q = "100"){
ImageJPEG($this->img, $name, $q);
}
function close(){
ImageDestroy($this->img);
}function imagecreatefromfile($path, $user_functions = false)
{
    $info = @getimagesize($path);
       if(!$info)
    {
        return false;
    }
    $functions = array(
        IMAGETYPE_GIF => 'imagecreatefromgif',
        IMAGETYPE_JPEG => 'imagecreatefromjpeg',
        IMAGETYPE_PNG => 'imagecreatefrompng',
        IMAGETYPE_WBMP => 'imagecreatefromwbmp',
        IMAGETYPE_XBM => 'imagecreatefromwxbm',
        );
    if($user_functions)
    {
        $functions[IMAGETYPE_BMP] = 'imagecreatefrombmp';
    }
    if(!$functions[$info[2]])
    {
        return false;
    }
    if(!function_exists($functions[$info[2]]))
    {
        return false;
    }
    return $functions[$info[2]]($path);
}
function imagefile($path, $img)
{
    $info = @getimagesize($path);
       if(!$info)
    {
        return false;
    }
    $functions = array(
        IMAGETYPE_GIF => 'imagegif',
        IMAGETYPE_JPEG => 'imagejpeg',
        IMAGETYPE_PNG => 'imagepng',
        IMAGETYPE_WBMP => 'imagewbmp',
        IMAGETYPE_XBM => 'imagexbm',
        );

    if(!$functions[$info[2]])
    {
        return false;
    }
    if(!function_exists($functions[$info[2]]))
    {
        return false;
    }
    return $functions[$info[2]]($img);
}
function imagetype($path, $user_functions = false)
{
    $info = @getimagesize($path);
       if(!$info)
    {
        return false;
    }
    $functions = array(
        IMAGETYPE_GIF => 'gif',
        IMAGETYPE_JPEG => 'jpeg',
        IMAGETYPE_PNG => 'png',
        IMAGETYPE_WBMP => 'wbmp',
        IMAGETYPE_XBM => 'xbm',
        );
    if($user_functions)
    {
        $functions[IMAGETYPE_BMP] = 'bmp';
    }
    if(!$functions[$info[2]])
    {
        return false;
    }
    return $functions[$info[2]];
}
}
?>