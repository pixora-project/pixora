<?php
    include "db.php";
    session_start();
    if((!isset($_SESSION['px_email']) || !isset($_SESSION['px_id']))){
        die("User not found.");
        exit;
    }

    $id = intval($_SESSION['id']);
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
    }
?>