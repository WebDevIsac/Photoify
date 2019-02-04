<?php

require __DIR__.'/../autoload.php';

if (isset($_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['password'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $username = strtolower(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $password = password_hash(filter_var($_POST['password'], FILTER_SANITIZE_STRING), PASSWORD_DEFAULT);
    
    $statement = $pdo -> query('SELECT * FROM users');
    $checkUsers = $statement -> fetchAll(PDO::FETCH_ASSOC);

    foreach ($checkUsers as $checkUser) {
        if ($email === $checkUser['email']) {
            if ($username === $checkUser['username']) {
                $_SESSION['error'] = [
                    'email' => 'This email already exists in our system.',
                    'username' => 'The username is not available.',
                ];
            } else {
                $_SESSION['error'] = [
                    'email' => 'This email already exists in our system.',
                ];
            }
            redirect('../../signup.php');
        } elseif ($username === $checkUser['username']) {
            $_SESSION['error'] = [
                'username' => 'The username is not available.'
            ];
            redirect('../../signup.php');
        }
    }

    $addUser = $pdo -> prepare("INSERT INTO users(firstname, lastname, email, username, password, profile_image, bio) VALUES(:firstname, :lastname, :email, :username, :password, 'avatar.jpg', '')");
    $addUser -> bindParam(':email', $email, PDO::PARAM_STR);
    $addUser -> bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $addUser -> bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $addUser -> bindParam(':username', $username, PDO::PARAM_STR);
    $addUser -> bindParam(':password', $password, PDO::PARAM_STR);

    $addUser -> execute();

    $newUser = $pdo -> prepare('SELECT * FROM users WHERE username = :username');
    $newUser -> bindParam(':username', $username, PDO::PARAM_STR);

    $newUser -> execute();

    $newUser = $newUser -> FETCH(PDO::FETCH_ASSOC);

    $_SESSION['user'] =
        [
            'user_id' => $newUser['user_id'],
            'firstname' => $newUser['firstname'],
            'lastname' => $newUser['lastname'],
            'email' => $newUser['email'],
            'username' => $newUser['username'],
            'profile_image' => $newUser['profile_image'],
            'bio' => ''
        ];
    
    unset($_SESSION['error']);

    redirect('../follows/load.php');
}

$error = 'Please fill in all required fields.';

redirect('../../signup.php');
