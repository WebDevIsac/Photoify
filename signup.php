<?php require __DIR__.'/views/header.php'; ?>

<div class="form-container">
	<form action="app/users/signup.php" method="post">
		<div class="form-firstnmae">
			<label for="firstname">Firstname</label>
			<input name="firstname" type="text" required>
		</div>
		<div class="form-lastname">
			<label for="lastname">Lastname</label>
			<input name="lastname" type="text" required>
		</div>
		<div class="form-email">
			<label for="email">Email</label>
			<input name="email" type="email" required>
			<?php if (isset($_SESSION['error']['email'])): ?>
			<small><?php echo $_SESSION['error']['email']; ?></small>
			<?php endif; ?>
		</div>
		<div class="form-username">
			<label for="username">Username</label>
			<input name="username" type="text" required>
			<?php if (isset($_SESSION['error']['username'])): ?>
			<small><?php echo $_SESSION['error']['username']; ?></small>
			<?php endif; ?>
		</div>
		<div class="form-password">
			<label for="password">Password</label>
			<input name="password" type="password" required>
		</div>
		<button type="submit">Signup</button>
		<p>or <a href="index.php">back to login</a></p>
	</form>
</div>

<?php require __DIR__.'/views/footer.php'; ?>
