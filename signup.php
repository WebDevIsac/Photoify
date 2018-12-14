<?php require __DIR__.'/views/header.php'; ?>

<article>
    <form action="app/users/signup.php" method="post">
        <div class="form-information">
            <label for="firstname"></label>
            <input name="firstname" type="text" required>
            <label for="lastname"></label>
            <input name="lastname" type="text" required>
            <label for="email"></label>
            <input name="email" type="email" required>
            <label for="username"></label>
            <input name="username" type="text" required>
        </div>
        <div class="form-password">
            <label for="password"></label>
            <input name="password" type="password" required>
        </div>

        <button type="submit">Signup</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>