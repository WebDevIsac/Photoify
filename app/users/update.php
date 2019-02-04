<?php

require __DIR__.'/../autoload.php';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];

    if (isset($_FILES['image'])) {
        $image = $_FILES['image'];
        if ($image['size'] > 1) {
            $type = $image['type'];
            $size = $image['size'];
            
            if ($type === 'image/jpg' || $type === 'image/png' || $type === 'image/gif' || 'image/jpeg' && $size < 5 * MB) {
                $imagePath = __DIR__.'/../../assets/images/profile-pictures/';
                $imageName =  uniqid() . "-$date-" . $image['name'];
                
                move_uploaded_file($image['tmp_name'], $imagePath . $imageName);
                
                $insertImage = $pdo -> prepare('UPDATE users SET profile_image = :profile_image WHERE user_id = :user_id');
                $insertImage -> bindParam(':profile_image', $imageName, PDO::PARAM_STR);
                $insertImage -> bindParam(':user_id', $user['user_id'], PDO::PARAM_INT);
                $insertImage -> execute();
                
                $_SESSION['user']['profile_image'] = $imageName;
            }
        }
    }



    if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) !== $user['email']) {
        $email = $_POST['email'];

        $insertEmail = $pdo -> prepare('UPDATE users SET email = :email WHERE user_id = :user_id');
        $insertEmail -> bindParam(':email', $email, PDO::PARAM_STR);
        $insertEmail -> bindParam(':user_id', $user['user_id'], PDO::PARAM_INT);
        $insertEmail -> execute();

        $_SESSION['user']['email'] = $email;
    }



    if (isset($_POST['old-password'], $_POST['new-password'])) {
        $checkPassword = $pdo -> prepare('SELECT password FROM users WHERE user_id = :user_id');
        $checkPassword -> bindParam(':user_id', $user['user_id'], PDO::PARAM_INT);
        $checkPassword -> execute();
        $oldPassword = $checkPassword -> FETCH(PDO::FETCH_ASSOC);
        if (password_verify($_POST['old-password'], $oldPassword['password'])) {
            $password = password_hash(filter_var($_POST['new-password'], FILTER_SANITIZE_STRING), PASSWORD_DEFAULT);

            $insertPassword = $pdo -> prepare('UPDATE users SET password = :password WHERE user_id = :user_id');
            $insertPassword -> bindParam(':password', $password, PDO::PARAM_STR);
            $insertPassword -> bindParam(':user_id', $user['user_id'], PDO::PARAM_INT);
            $insertPassword -> execute();
        }
    }



    if (isset($_POST['bio']) && filter_var($_POST['bio'], FILTER_SANITIZE_STRING) !== $user['bio']) {
        $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);


        $insertBio = $pdo -> prepare('UPDATE users SET bio = :bio WHERE user_id = :user_id');
        $insertBio -> bindParam(':bio', $bio, PDO::PARAM_STR);
        $insertBio -> bindParam(':user_id', $user['user_id'], PDO::PARAM_INT);
        $insertBio -> execute();

        $_SESSION['user']['bio'] = $bio;
    }
}

redirect('../follows/load.php');
