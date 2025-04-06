<?php
session_start();
$username = $_SESSION['username'] ?? null;
$usertype = $_SESSION['usertype'] ?? null;

if ($usertype === 'Broker') {
    $homeLink = 'broker-homepage.php';
} elseif ($username) {
    $homeLink = 'logged-in-home.php';
} else {
    $homeLink = 'index.php';
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">

<div class="container">
  <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <div class="col-md-3 mb-2 mb-md-0">
      <a href="<?= $homeLink ?>" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <img src="logo.png" alt="Logo" width="50" height="50" class="me-1">
        <h3 class="mb-0">Rose Brokers</h3>
      </a>
    </div>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <li><a href="<?= $homeLink ?>" class="nav-link px-2 link-secondary">Home</a></li>
      <li><a href="mortgage-calculator-options.php" class="nav-link px-2">Mortgage Calculator</a></li>
      <li><a href="about.php" class="nav-link px-2">About</a></li>
    </ul>

    <div class="col-md-3 text-end d-flex align-items-center justify-content-end gap-2">
      <?php if ($username): ?>
        <p class="mb-0 text-white">User: <?= htmlspecialchars($username) ?></p>
        <a href="logout.php" class="btn btn-primary">Log Out</a>
      <?php else: ?>
        <a href="login-page.php" class="me-2">
          <button type="button" class="btn btn-outline-primary">Login</button>
        </a>
        <a href="sign-up-page.php">
          <button type="button" class="btn btn-primary">Sign-up</button>
        </a>
      <?php endif; ?>
    </div>
  </header>
</div>
