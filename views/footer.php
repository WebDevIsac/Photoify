</div> <!-- container -->

<footer>

	<?php if (isset($_SESSION['user'])): ?>
	<nav>
		<ul class="nav-bar">
			<li class="nav-item">
				<a href="../index.php" class="nav-link"><img src="assets/images/home-50px.svg" alt=""></a>
			</li>
			<li class="nav-item">
				<a href="search.php" class="nav-link"><img src="assets/images/search-50px.svg" alt=""></a>
			</li>
			<li class="nav-item">
				<a href="../add.php" class="nav-link"><img src="assets/images/camera-50px.svg" alt=""></a>
			</li>
			<li class="nav-item">
				<a href="news.php" class="nav-link"><img src="assets/images/news-50px.svg" alt=""></a>
			</li>
			<li class="nav-item">
				<a href="profile.php" class="nav-link"><img src="assets/images/avatar-50px.svg" alt=""></a>
			</li>
		</ul>
	</nav>
	<?php elseif ($_SERVER['PHP_SELF'] === '/explore.php'): ?>
	<h1>Back to login page</h1>
	<?php else: ?>
	<nav>
		<a href="explore.php">Explore</a>
	</nav>
	<?php endif; ?>
</footer>

<script src="assets/script/script.js"></script>
</body>
</html>
