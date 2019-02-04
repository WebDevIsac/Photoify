<?php

require __DIR__.'/../autoload.php';

if (isset($_GET['post'])) {
    $postID = (int)$_GET['post'];
    $postID = filter_var($postID, FILTER_SANITIZE_NUMBER_INT);
    $caption = filter_var($_POST['caption'], FILTER_SANITIZE_STRING);

    $insertCaption = $pdo -> prepare('UPDATE posts SET caption = :caption WHERE post_id = :post_id');
    $insertCaption -> bindParam(':caption', $caption, PDO::PARAM_STR);
    $insertCaption -> bindParam(':post_id', $postID, PDO::PARAM_INT);
    $insertCaption -> execute();

    redirect('loadProfile.php');
}
