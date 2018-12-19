<?php require __DIR__.'/views/header.php'; ?>

<article>
    <form action="app/users/signup.php" method="post">
        <div class="form-information">
            <label for="firstname">Firstname:</label>
            <input name="firstname" type="text" required>
            <label for="lastname">Lastname:</label>
            <input name="lastname" type="text" required>
            <label for="email">Email:</label>
            <input name="email" type="email" required>
			<?php if (isset($emailError)): ?>
			<small><?php echo $emailError; ?></small>
			<?php endif; ?>
            <label for="username">Username:</label>
            <input name="username" type="text" required>
			<?php if (isset($usernameError)): ?>
			<small><?php echo $usernameError; ?></small>
			<?php endif; ?>
            <label for="password">Password:</label>
            <input name="password" type="password" required>
        </div>
        <button type="submit">Signup</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
