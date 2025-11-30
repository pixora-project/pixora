<?php
include "verify_profile.php";
$coverFile = $user['cover_image'];
$file = basename($coverFile);
$path = "cover_images/". $file;
if(!empty($user['cover_image'])){
    if(file_exists($path)){
        unlink($path);
    }
}

$del = $conn -> prepare("UPDATE users SET cover_image = NULL WHERE id = :id AND token = :tk");
$del -> bindValue(":id",$id,PDO::PARAM_INT);
$del -> bindValue(":tk",$tk,PDO::PARAM_STR);
$del -> execute();
header("Location:myprofile.php");
exit();
?>