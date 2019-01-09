<?php 

require __DIR__.'/../autoload.php';

unset($_SESSION['user']);

redirect('../../login.php');

?>
