<?php 

require __DIR__.'/../autoload.php';

if (isset($_POST['username'], $_POST['password'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    
    $loginStatement = $pdo -> query('SELECT * FROM users');
    $users = $loginStatement -> fetchAll(PDO::FETCH_ASSOC);


    foreach ($users as $user) {
        if ($username === $user['username']) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = 
                [
                    'id' => $user['id'],
                    'name' => $user['firstname'],
                    'username' => $user['username'],
				];
				
				unset($_SESSION['credentials']);

                redirect('/../../index.php');
            }
        }
	}
	
	$_SESSION['credentials'] = 'Sorry, wrong username or password';

}

redirect('/../../login.php');

?>
