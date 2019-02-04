<?php

require __DIR__.'/../autoload.php';

unset($_SESSION['all_posts']);
$loadAllUsers = $pdo -> query('SELECT * FROM users');
$loadAllUsers = $loadAllUsers -> fetchAll(PDO::FETCH_ASSOC);


foreach ($loadAllUsers as $user) {
    $loadPosts = $pdo -> prepare('SELECT * FROM posts WHERE user_id = :user_id');
    $loadPosts -> bindParam(':user_id', $user['user_id'], PDO::PARAM_INT);
    $loadPosts -> execute();
    $loadPosts = $loadPosts -> fetchAll(PDO::FETCH_ASSOC);
    foreach ($loadPosts as $loadPost) {
        $loadLikes = $pdo -> prepare('SELECT * FROM likes WHERE post_id = :post_id');
        $loadLikes -> bindParam(':post_id', $loadPost['post_id'], PDO::PARAM_INT);
        $loadLikes -> execute();
        $likes = $loadLikes -> fetchAll(PDO::FETCH_ASSOC);
        if (!$likes) {
            $count = 0;
            $isLiked = false;
        } else {
            $count = count($likes);
            foreach ($likes as $like) {
                if ($like['user_id'] == $_SESSION['user']['user_id']) {
                    $isLiked = true;
                } else {
                    $isLiked = false;
                }
            }
        }

        $loadPost['is_liked'] = $isLiked;
        $loadPost['likes'] = $count;

        $posts[] = $loadPost;
        $dates[] = $loadPost['timestamp'];
    }
}

rsort($dates);
foreach ($dates as $date) {
    foreach ($loadAllUsers as $user) {
        foreach ($posts as $post) {
            if ($user['user_id'] === $post['user_id']) {
                if ($post['timestamp'] === $date) {
                    $_SESSION['all_posts'][] =
                    [
                        'post_id' => $post['post_id'],
                        'image' => $post['image'],
                        'username' => $post['username'],
                        'user_id' => $post['user_id'],
                        'profile_image' => $user['profile_image'],
                        'timestamp' => $date,
                        'caption' => $post['caption'],
                        'likes' => $post['likes'],
                        'is_liked' => $post['is_liked']
                    ];
                }
            }
        }
    }
}

if (isset($_SESSION['like_post_id'])) {
    redirect('../../explore.php#' . $_SESSION['like_post_id']);
}

redirect('../../explore.php');
