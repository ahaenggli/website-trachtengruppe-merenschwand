<?php
// Get real path for our folder
$rootPath = realpath('./');
$savePath = realpath('./Backup/');
$excludes = array($savePath);

// Initialize archive object
$zip = new ZipArchive();
$zip->open($savePath.'/TG2015.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Initialize empty "delete list"
$filesToDelete = array();

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        $found = false;
        // Add current file to archive 
        foreach($excludes as $ex){
        if($found==false) $found = preg_match('#('.$ex.')#',  $filePath);
        }
        
    if (!$file->isDir()){ if(!$found) $zip->addFile($filePath, $relativePath);}
    else {                if(!$found) $zip->addEmptyDir($relativePath);} 
    
}

// Zip archive will be created only after closing object
$zip->close();

?>