<?php require __DIR__.'/views/header.php'; ?>

<?php
if (isset($_SESSION['user'])) {
	redirect('home.php');
}
?>

<article>
    <form action="app/users/login.php" method="post">
        <div class="form-username">
            <label for="username">Username:</label>
            <input name="username" type="text" required>
        </div>
        <div class="form-password">
            <label for="password">Password:</label>
            <input name="password" type="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
