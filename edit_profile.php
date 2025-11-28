<?php
include "db.php";
$id = htmlspecialchars($_POST['user_id'],ENT_QUOTES,'UTF-8');
if(!isset($id) && !is_numeric($id)){
    die("User not found");
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $check = $conn -> prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
    $check -> bindValue(":id",$id,PDO::PARAM_INT);
    $check -> execute();

    if($check -> rowCount() === 0){
        die("You have not a permission for edit this profile");
    }

    $username = htmlspecialchars($_POST['update_name'],ENT_QUOTES,'UTF-8');
    $useremail = htmlspecialchars($_POST['update_email'],ENT_QUOTES,'UTF-8');
    $userphone = htmlspecialchars($_POST['update_phone'],ENT_QUOTES,'UTF-8');
    $userbirth = htmlspecialchars($_POST['update_birth'],ENT_QUOTES,'UTF-8');
    $userdisplayname = htmlspecialchars($_POST['update_dname'],ENT_QUOTES,'UTF-8');
    $usergender = htmlspecialchars($_POST['update_gender'],ENT_QUOTES,'UTF-8');
    $userlocation = htmlspecialchars($_POST['update_location'],ENT_QUOTES,'UTF-8');
    $userbio = htmlspecialchars(trim($_POST['update_bio']),ENT_QUOTES, 'UTF-8');
    
    $up_name = $conn -> prepare("UPDATE users SET username = :username WHERE id = :id");
    $up_name -> bindValue(":username",$username,PDO::PARAM_STR);
    $up_name -> bindValue(":id",$id,PDO::PARAM_INT);
    $up_name -> execute();

    $up_email = $conn -> prepare("UPDATE users SET email = :useremail WHERE id = :id");
    $up_email -> bindValue(":useremail",$useremail,PDO::PARAM_STR);
    $up_email -> bindValue(":id",$id,PDO::PARAM_INT);
    $up_email -> execute();

    $up_phone = $conn -> prepare("UPDATE users SET phone_number = :phoneNumber WHERE id = :id");
    $up_phone -> bindValue(":phoneNumber",$userphone,PDO::PARAM_INT);
    $up_phone -> bindValue(":id",$id,PDO::PARAM_INT);
    $up_phone -> execute();

    $up_dname = $conn -> prepare("UPDATE users SET display_name = :dname WHERE id = :id");
    $up_dname -> bindValue(":dname",$userdisplayname,PDO::PARAM_STR);
    $up_dname -> bindValue(":id",$id,PDO::PARAM_INT);
    $up_dname -> execute();

    $up_bio = $conn -> prepare("UPDATE users SET bio = :bio WHERE id = :id");
    $up_bio -> bindParam(":bio",$userbio,PDO::PARAM_STR);
    $up_bio -> bindParam(":id",$id,PDO::PARAM_INT);
    $up_bio -> execute();

    $up_gender = $conn -> prepare("UPDATE users SET gender = :gender WHERE id = :id");
    $up_gender -> bindValue(":gender",$usergender,PDO::PARAM_STR);
    $up_gender -> bindValue(":id",$id,PDO::PARAM_INT);
    $up_gender -> execute();

    $up_location = $conn -> prepare("UPDATE users SET country = :country WHERE id = :id");
    $up_location -> bindValue(":country",$userlocation,PDO::PARAM_STR);
    $up_location -> bindValue(":id",$id,PDO::PARAM_INT);
    $up_location -> execute();

    $up_birth = $conn -> prepare("UPDATE users SET birth_date = :bdate WHERE id = :id");
    $up_birth -> bindValue(":bdate",$userbirth,PDO::PARAM_STR);
    $up_birth -> bindValue(":id",$id,PDO::PARAM_INT);
    $up_birth -> execute();

    $_SESSION['edit_profile'] = "Suavegarde successfully";
    header("Location:myprofile.php");
    exit();
}
?>