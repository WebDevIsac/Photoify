<?php require __DIR__.'/views/header.php'; ?>

<div class="container">

	<?php 
		if (!isset($_SESSION['user'])) {
			redirect('login.php');
		} 
	?>

	<div class="feed">
		<?php 
			foreach ($posts as $post):
				?>
				
				<div class="post">
					<div class="image-container">
						<img src="" alt="">
					</div>
					<div class="text-container">
						<p class="likes"></p>
						<p class="date"></p>
						<p class="caption"></p>
					</div>
				</div> <!-- post -->
			
			<?php endforeach; ?>
	</div> <!-- feed -->

	<a href="app/users/logout.php" class="logout">Logout</a>

</div> <!-- container -->
	
<?php require __DIR__.'/views/footer.php'; ?>
