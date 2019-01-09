<?php 

require __DIR__.'/../autoload.php';

if (isset($_SESSION['following'])) {

	foreach ($_SESSION['following'] as $follow) {
		echo $follow;
	}

}


?>
