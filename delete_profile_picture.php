<?php
include "verify_profile.php";
$f = $user['photo_profile'];
$file = basename($f);
$path = "profile_pictures/". $file;
if(!empty($user['photo_profile'])){
    if(file_exists($path)){
        unlink($path);
    }
}

$del = $conn -> prepare("UPDATE users SET photo_profile = NULL WHERE id = :id AND token = :tk");
$del -> bindValue(":id",$id,PDO::PARAM_INT);
$del -> bindValue(":tk",$tk,PDO::PARAM_STR);
$del -> execute();
header("Location:myprofile.php");
exit();