<?php 

declare(strict_types=1);

// Start the session
session_start();

// Include functions
require __DIR__.'/functions.php';

// Fetch global configuration array
$config = require __DIR__.'/config.php';

// Setup database connection
$pdo = new PDO($config['database_path']);


?>