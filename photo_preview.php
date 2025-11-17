<?php
include "db.php";
include "likes.php";
session_start();
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Id not found.");
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM photos WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$stmt->execute();
$photo = $stmt->fetch();

$stm = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stm->bindParam(":id", $photo['user_id'], PDO::PARAM_INT);
$stm->execute();
$user = $stm->fetch();

$category = $conn->prepare("SELECT * FROM categories WHERE id = :id");
$category->bindValue(":id", $photo['category_id'], PDO::PARAM_INT);
$category->execute();
$cat_name = $category->fetch(PDO::FETCH_ASSOC);

/* $stmt = $conn->prepare("SELECT * FROM photos WHERE photo_id = :id LIMIT 1");
$stmt -> bindValue(":id",$id,PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC); */

$userid = intval($_SESSION['px_id'] ?? $_COOKIE['px_userid']);
/* foreach ($rows as &$row) { */
if ($userid) {
    $lk = $conn->prepare("SELECT COUNT(*) FROM likes WHERE user_id = :userid AND photo_id = :photoid");
    $lk->bindValue(":userid", $userid, PDO::PARAM_INT);
    $lk->bindValue(":photoid", $photo['id'], PDO::PARAM_INT);
    $lk->execute();
    $photo['isLiked'] = $lk->fetchColumn() > 0;
} else {
    $photo['isLiked'] = false;
}
$cnt = $conn->prepare("SELECT COUNT(*) FROM likes WHERE photo_id = :photoid");
$cnt->bindValue(":photoid", $photo['id'], PDO::PARAM_INT);
$cnt->execute();
$totalLikes = $cnt->fetchColumn();
/* } */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Preview | Pixora</title>
    <link rel="shortcut icon" href="outils/favicons/favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="photo.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="bsicons/bsicons/bootstrap-icons.min.css">
    <link rel="stylesheet" href="fontawesome/fontawesome/css/all.min.css">
</head>

<body>
    <?php if (!empty($_SESSION['photomess'])): ?>
        <div class="alert mt-2 mb-2">
            <?= $_SESSION['photomess']; ?>
            <button type="button" class="btn btn-close" data-bs-dismiss="alert"></button>
            <?php unset($_SESSION['photomess']); ?>
        </div>
    <?php endif; ?>
    <?php include "navbar.php"; ?>
    <div class="modal fade" id="profil" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1>Profile</h1>
                </div>
                <div class="modal-body">
                    <div>
                        <table class="table">
                            <?php if (isset($_SESSION['px_email'])): ?>
                                <tr>
                                    <td>Username</td>
                                    <td><?= $_SESSION['px_name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?= $_SESSION['px_email']; ?></td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td>You have to sign first in <a href="#">Sign up</a> or <a href="login.php">Login</a></td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid photo-page mt-3 mb-3">
        <div class="photo-viewer">
            <img src="photos/<?= $photo['filename']; ?>" width="100%" class="img-fluid" alt="<?= $photo['title']; ?>">
        </div>
        <div class="details-panel">
            <div class="socialActions">
                <div>
                    <input type="hidden" name="photo_id" value="<?= $photo['id']; ?>">
                    <a href="#" class="likeButton <?= $photo['isLiked'] ? 'active' : '' ?>" data-photo-id="<?= $photo['id']; ?>">
                        <i class="fas fa-heart"></i>
                        <!-- <span id="likes_count-<?= $photo['id']; ?>"></span> --></a>
                </div>
                <div>
                    <a href="#" id="commentButton">
                        <i class="fa-solid fa-comment"></i>
                    </a>
                </div>
                <div>
                    <a href="#" id="shareButton">
                        <i class="fa-solid fa-share"></i>
                    </a>
                </div>
            </div>
            <ul class="list-group mt-3">
                <li>
                    <h4><?= $photo['title']; ?></h4>
                </li>
                <li>
                    <p><?= $photo['description']; ?></p>
                </li>
                <li>
                    <i class="fa-solid fa-calendar"></i>
                    <p><?= $photo['upload_date']; ?></p>
                </li>
                <li>
                    <i class="fa-solid fa-user"></i>
                    <p><?= $user['username']; ?></p>
                </li>
                <li>
                    <i class="fa-solid fa-tags"></i>
                    <p><?= $cat_name['name'] ?? "Null"; ?></p>
                </li>
                <li>
                    <i class="fa-solid fa-heart"></i>
                    <p><?= $totalLikes; ?> Likes</p>
                </li>
                <li>
                    <i class="fa-solid fa-comments"></i>
                    <p>..</p>
                </li>
                <li>
                    <i class="fa-solid fa-image"></i>
                    <p>...</p>
                </li>
                <li>
                    <i class="fa-solid fa-location-dot"></i>
                    <p>...</p>
                </li>
                <li>
                    <i class="fa-solid fa-photo-film"></i>
                    <p>...</p>
                </li>
            </ul>
            <div class="comments">
                <h5>Comments</h5>
                <form action="" class="comment-form" method="post">
                    <div class="input-group">
                        <textarea id="up_comment" placeholder="Type your comment ..." class="form-control" rows="1" cols="1"></textarea>
                        <button type="submit" class="btn btn-primary">Post</button>
                    </div>
                </form>
                <ul class="comments-list mt-4">
                    <li class="comment-item">
                        <img src="outils/pngs/useracc2.png" alt="user" class="comment-avatar">
                        <div class="comment-body">
                            <h6 class="comment-author">User</h6>
                            <p class="comment-text">Somthing :)</p>
                            <span class="comment-date">2025-05-22</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script src="likes.js"></script>
    <script src="rotate_icon.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>