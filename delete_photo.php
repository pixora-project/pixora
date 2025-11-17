<?php
    include "db.php";
    session_start();
    $id = htmlspecialchars($_POST['photo_id'],ENT_QUOTES,'UTF-8');
    if(!isset($id) && !is_numeric($id)){
        die("Id photo not found.");
        exit();
    }
    $user_id = intval($_SESSION['px_id'] ?? $_COOKIE['px_userid']);

    if(!isset($_POST['photo_id']) || !is_numeric($_POST['photo_id'])){
        die("Invalide request");
    }

    $check = $conn -> prepare("SELECT * FROM photos WHERE id = :pid AND user_id = :user_id");
    $check -> bindValue(":pid",$id,PDO::PARAM_INT);
    $check -> bindValue(":user_id",$user_id,PDO::PARAM_INT);
    $check -> execute();

    if($check -> rowCount() === 0){
        die("You don't have a permission for delete this photo");
    }

    $photo = $conn -> prepare("SELECT * FROM photos WHERE id = :id AND user_id = :user_id");
    $photo -> bindValue(":id",$id,PDO::PARAM_INT);
    $photo -> bindValue(":user_id",$user_id,PDO::PARAM_INT);
    $photo -> execute();
    $p = $photo -> fetch(PDO::FETCH_ASSOC);
    $photoPath = "photos / ".$p['filename'];
    if(file_exists($photoPath)){
        unlink($photoPath);
    }

    $deLikes = $conn -> prepare("DELETE FROM likes WHERE photo_id = :pid");
    $deLikes -> bindValue(":pid",$id,PDO::PARAM_INT);
    $deLikes -> execute();
    $sql = "DELETE FROM photos WHERE id = :id AND user_id = :user_id";
    $stmt = $conn -> prepare($sql);
    $stmt -> bindValue(":id",$id,PDO::PARAM_INT);
    $stmt -> bindValue(":user_id",$user_id,PDO::PARAM_INT);
    $stmt -> execute();
    $_SESSION['delmess'] = "Photo deleted successfully";
    header("Location:myphotos.php");
    exit();
?>