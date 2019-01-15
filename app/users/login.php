<?php 

require __DIR__.'/../autoload.php';

if (isset($_POST['username'], $_POST['password'])) {
    $username = strtolower(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    
    $loginStatement = $pdo -> query('SELECT * FROM users');
    $users = $loginStatement -> fetchAll(PDO::FETCH_ASSOC);

	unset($_SESSION['user']);
    foreach ($users as $user) {
        if ($username === $user['username']) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = 
                [
                    'user_id' => $user['user_id'],
					'username' => $user['username'],
					'email' => $user['email'],
					'firstname' => $user['firstname'],
					'lastname' => $user['lastname'],
					'profile_pic' => $user['profile_pic_url'],
					'bio' => $user['bio']
				];
				
				unset($_SESSION['credentials']);

                redirect('../follows/load.php');
            }
        }
	}
	
	$_SESSION['credentials'] = 'Sorry, wrong username or password';

}

redirect('../../login.php');

?>
