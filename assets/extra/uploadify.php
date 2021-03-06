<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$targetFolder = '/uploads'; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
        mkdir('../css/user/content/'.$verifyToken);
	$targetPath =  '../css/user/content/'.$verifyToken;
	$targetFile = rtrim($targetPath,'/') . '/' . str_replace(" ", "a", $_FILES['Filedata']['name']);
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png','PNG','GIF','JPEG','JPG'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
	} else {
		echo 'Invalid file type.';
	}
} 

if(isset($_POST['id']))
{
    $tempFile = $_FILES['Filedata']['tmp_name'];
    
        if(!is_dir('../css/user/content/'.$_POST['id']))
            mkdir('../css/user/content/'.$_POST['id']);
        
	$targetPath =  '../css/user/content/'.$_POST['id'];
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
	} else {
		echo 'Invalid file type.';
	}
}
?>