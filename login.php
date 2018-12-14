<?php require __DIR__.'/views/header.php'; ?>

<article>
    <form action="app/users/login.php" method="post">
        <div class="form-username">
            <label for="username"></label>
            <input name="username" type="text" required>
        </div>
        <div class="form-password">
            <label for="password"></label>
            <input name="password" type="password" required>
        </div>

        <button type="submit">Login</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>