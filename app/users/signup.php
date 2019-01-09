<?php 

require __DIR__.'/../autoload.php';

if (isset($_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['password'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$password = password_hash(filter_var($_POST['password'], FILTER_SANITIZE_STRING), PASSWORD_DEFAULT);
	
	$checkStatement = $pdo -> query('SELECT * FROM users');
	$checkUsers = $checkStatement -> fetchAll(PDO::FETCH_ASSOC);

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
		} 
		
		else if ($username === $checkUser['username']) {
			$_SESSION['error'] = [
				'username' => 'The username is not available.'
			];
			redirect('../../signup.php');
		}
		// if ($checkUser[] < 10) {

		// }
	}

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
        'name' => $newUser['firstname'],
        'username' => $newUser['username'],
	];
	
	unset($_SESSION['error']);

    redirect('../../index.php');
}

$error = 'Please fill in all required fields.';

redirect('../../signup.php');

?>
