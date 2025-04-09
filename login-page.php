<?php
session_start();

$db = new SQLite3('MortgageSystem.db');
if (!$db) {
    die("Database connection failed.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $db->prepare('SELECT * FROM User WHERE Email = :email');
    if (!$stmt) {
        die("Failed to prepare SQL query.");
    }

    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();

    if (!$result) {
        die("Query execution failed.");
    }

    $user = $result->fetchArray(SQLITE3_ASSOC);

    if ($user && password_verify($password, $user['Password'])) {
        $_SESSION['user_id'] = $user['USERID'];
        $_SESSION['username'] = $user['Username'];
        $_SESSION['usertype'] = $user['usertype'];
    
        if ($user['usertype'] === 'Broker') {
            header("Location: broker-homepage.php");
        } else {
            header("Location: logged-in-home.php");
        }
        exit;
    } else {
        $error = "Incorrect email or password. Please try again.";
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link rel="icon" href="logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <script src="script.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <main class="form-signin w-50 m-auto my-5">
        <form method="post" action="login-page.php">
            <h1 class="h3 mb-4 fw-normal text-center">Please sign in</h1>

            <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <div class="form-floating mb-3">
                <input type="text" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                <label for="email">Email Address</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>

            <button class="btn btn-primary w-100 py-2 mb-3" type="submit">Sign in</button>

            <div class="text-center">
                <p class="mb-2">Continue as a guest? <a href="index.php">Click here</a></p>
                <p class="mb-0">Don't have an account? <a href="sign-up-page.php">Sign up</a></p>
            </div>
        </form>
    </main>

    <?php include("footer.php"); ?>
</body>
</html>

