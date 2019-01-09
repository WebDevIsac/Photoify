<?php require __DIR__.'/views/header.php'; ?>

<?php
if (isset($_SESSION['user'])) {
	redirect('/index.php');
}
?>

<div class="form-container">
	<form action="app/users/login.php" method="post">
		<div class="form-username">
			<label for="username">Username</label>
			<input name="username" type="text" required>
		</div>
		<div class="form-password">
			<label for="password">Password</label>
			<input name="password" type="password" required>
			<?php if (isset($_SESSION['credentials'])): ?>
				<small><?php echo $_SESSION['credentials']; ?></small>
			<?php endif; ?>
		</div>
		<button type="submit">Login</button>
		<p>or <a href="signup.php">signup here</a></p>
	</form>
</div> <!-- form-container -->
<?php require __DIR__.'/views/footer.php'; ?>
