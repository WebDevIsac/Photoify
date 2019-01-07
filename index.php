<?php require __DIR__.'/views/header.php' ?>

<?php 
	if (!isset($_SESSION['user'])) {
		redirect('login.php');
	} 
?>

	<div class="content">
		<?php 
			// foreach ($posts as $post):
		?>
	</div>

	<a href="app/users/logout.php" class="logout">Logout</a>
<?php require __DIR__.'/views/footer.php' ?>
