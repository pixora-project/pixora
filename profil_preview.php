<?php
    include "db.php";
    if((!isset($_GET['id']) || !is_numeric($_GET['id'])) && (!isset($_SESSION['px_id']))){
        $_SESSION['logerr'] = "You have to logged first for show any photographer.";
        header("Location:login.php");
        exit;
    }
    
    $id = intval($_GET['id']);
    
    $us = $conn -> prepare("SELECT * FROM users WHERE id = :id");
    $us -> bindValue(":id",$id,PDO::PARAM_INT);
    $us -> execute();
    $user = $us -> fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deluxe Gallery : Profil Preview</title>
    <link rel="shortcut icon" href="outils/favicons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="dasheboard.css">
    <link rel="stylesheet" href="fontawesome/fontawesome/css/all.min.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand nav1 p-2">
            <div class="container-fluid p-0 d-flex">
                <ul class="navbar-nav me-auto" id="ul1">
                    <li class="nav-item" title="Welcome to DeluxeGallery">
                        <a style="cursor: pointer;" onclick="return location.reload();"
                            class="nav-link nav-brand p-0 m-0">
                            <img src="outils/pngs/dark_logo.png" style="padding: 0%;width: 100px;;height: auto;margin: 0;"
                                id="logo">
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto" id="ul2">
                    <li class="nav-item">
                        <div>
                            <img src="outils/pngs/useracc.png" id="imgAcc" alt="<?php if (isset($_SESSION['px_name'])) echo $_SESSION['px_name'];
                                                                                else echo "User"; ?>" width="40px" height="auto" data-bs-target="#profil" data-bs-toggle="modal">
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container-fluid">
        <div class="row div">
            <div>
                <div class="mt-2 mb-2" id="info">
                    <h2>Personal informations</h2>
                    <div class=" mt-2 mb-2" style="flex-direction: column;gap:5px;">
                        <div>
                            <img src="outils/pngs/useracc.png" width="100px" id="imgAcc" alt="<?= $_SESSION['px_name']; ?>" title="<?= $_SESSION['px_name']; ?>">
                        </div>
                    </div>
                    <div class="list-group" id="listGroup1">
                        <div class="list">
                            <li class="list-group-item">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" value="<?= $user['username']; ?>" id="name" readonly>
                            </li>
                            <li class="list-group-item">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" value="<?= $user['email']; ?>" id="email" readonly>
                            </li>
                            <li class="list-group-item">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control" id="bio" readonly><?php if (isset($user['bio'])) echo $user['bio'];
                                                                                    else echo "Bio not yet"; ?></textarea>
                            </li>
                            <li class="list-group-item">
                                <label for="date" class="form-label">Created at</label>
                                <input type="text" class="form-control" value="<?= $user['created_at']; ?>" id="date" readonly>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>