<?php 

require __DIR__.'/../autoload.php';

// unset($_SESSION['user']);
// unset($_SESSION['followers']);
session_destroy();


redirect('../../login.php');

?>
