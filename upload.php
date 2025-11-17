<?php
ob_start();
include "upload_photo.php";
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixora : Upload Photo</title>
    <link rel="shortcut icon" href="outils/favicons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="upload.css">
    <link rel="stylesheet" href="fontawesome/fontawesome/css/all.min.css">
    <script src="Jquery File/jquery-3.7.1.min.js"></script>
</head>

<body>
    <header>
        <?php if (!empty($_SESSION['upload_mess'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['upload_mess']; ?>
                <button type="button" class="btn btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['upload_mess']); ?>
        <?php endif; ?>
        <nav class="navbar navbar-expand nav1 p-2">
            <div class="container-fluid p-0">
                <ul class="navbar-nav me-auto" id="ul1">
                    <li class="nav-item" title="Welcome to DeluxeGallery">
                        <a style="cursor: pointer;" onclick="return location.reload();"
                            class="nav-link nav-brand p-0 m-0">
                            <img src="outils/pngs/dark_logo.png" style="padding: 0%;width: 100px;;height: auto;margin: 0;"
                                id="logo">
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <div>
                            <img src="outils/pngs/useracc.png" id="imgAcc" alt="<?= $_SESSION['px_name']; ?>" onclick="window.open('dasheboard.php','_self')" width="40px" height="auto">
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container-fluid mt-2 mb-2">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">Pixora</h1>
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" id="photosForm">
                    <div>
                        <input type="file" name="photoFile" class="form-control d-none" id="uploadPhoto" accept=".png, .jpg, .jpeg" required>
                        <p id="uploadErr"></p>
                        <div id="upload">
                            <img src="outils/pngs/upload_icon.png" id="icon" width="150px" height="auto" alt="uplaod icon">
                            <p id="para">Click here for upload a photo</p>
                            <img src="" style="width:100%;display:none;" id="preview"></img>
                        </div>
                    </div>
                    <div id="file_selected" class="mt-2 mb-2"></div>
                    <div>
                        <label for="titlePhoto" class="form-label">Title</label>
                        <textarea name="title" id="titlePhoto" required class="form-control" placeholder="Title of photo ..."></textarea>
                        <p id="titleErr"></p>
                    </div>
                    <div>
                        <label for="descriptionPhoto" class="form-label">Description</label>
                        <textarea name="description" id="descriptionPhoto" class="form-control" required placeholder="Description of photo ..."></textarea>
                        <p id="descriptionErr"></p>
                    </div>
                    <div>
                        <label for="categoriePhoto" class="form-label">Categorie</label>
                        <input name="categorie" type="text" class="form-control" id="categoriePhoto" required placeholder="Categorie photo ...">
                        <p id="categorieErr"></p>
                    </div>
                    <!-- <div>
                        <label for="visibilityPhoto">Visibility</label>
                        <select name="visibility" class="form-select" id="visiblityPhoto">
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                        </select>
                    </div> -->
                    <div>
                        <button type="submit" class="btn" id="uploadButton">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="upload.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>