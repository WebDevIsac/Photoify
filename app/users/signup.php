<?php 

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['password'])) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash(filter_var($_POST['email'], FILTER_SANITIZE_STRING), PASSWORD_DEFAULT);

    $addStatement = $pdo -> prepare('INSERT INTO users(email, firstname, lastname, username, password) VALUES(:email, :firstname, :lastname, :username, :password)');

    $addStatement -> bindParam(':email', $email, PDO::PARAM_STR);
    $addStatement -> bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $addStatement -> bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $addStatement -> bindParam(':username', $username, PDO::PARAM_STR);
    $addStatement -> bindParam(':password', $password, PDO::PARAM_STR);

    $addStatement -> execute();

    $signupStatement = $pdo -> prepare('SELECT * FROM users WHERE username = :username');
    $signupStatement -> bindParam(':username', $username, PDO::PARAM_STR);

    $signupStatement -> execute();

    $newUser = $signupStatement -> FETCH(PDO::FETCH_ASSOC);

    $_SESSION['user'] = 
    [
        'id' => $newUser['id'],
        'name' => $newUser['name'],
        'username' => $newUser['username'],
    ];
    redirect('../../index.php');
}

redirect('../..signup.php');


?>