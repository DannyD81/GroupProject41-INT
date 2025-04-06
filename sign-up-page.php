<?php
session_start();

$db = new SQLite3('MortgageSystem.db');
if (!$db) {
    die("Database connection failed.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $usertype = $_POST['usertype'];

    $checkQuery = $db->prepare("SELECT Username FROM User WHERE Username = :username");
    $checkQuery->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $checkQuery->execute();

    if ($result->fetchArray(SQLITE3_ASSOC)) {
        $error = "Username already taken. Please choose another.";
    } else {
        $query = $db->prepare("INSERT INTO User (
            Username, Email, Password, usertype,
            firstName, lastName, dob, employmentStatus,
            annualIncome, monthlyOutgoings, creditScore
        ) VALUES (
            :username, :email, :password, :usertype,
            '', '', '', '', 0, 0, 0
        )");

        $query->bindValue(':username', $username, SQLITE3_TEXT);
        $query->bindValue(':email', $email, SQLITE3_TEXT);
        $query->bindValue(':password', $password, SQLITE3_TEXT);
        $query->bindValue(':usertype', $usertype, SQLITE3_TEXT);

        if ($query->execute()) {
            $_SESSION['UserID'] = $db->lastInsertRowID();
            $_SESSION['username'] = $username;
            $_SESSION['usertype'] = $usertype;

            header("Location: login-page.php");
            exit;
        } else {
            $error = "Error registering user. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link rel="icon" href="logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <script src="script.js" defer></script>
</head>
<body>
    <main class="form-signin w-50 m-auto my-5">
        <form action="sign-up-page.php" method="post">
            <h1 class="h3 mb-4 fw-normal text-center">Please sign up</h1>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                <label for="email">Email address</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="username" class="form-control" id="username" placeholder="user123" required>
                <label for="username">Username</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>

            <div class="mb-3">
                <label for="usertype" class="form-label">User Type:</label>
                <select class="form-select" id="usertype" name="usertype" required>
                    <option selected disabled>Choose...</option>
                    <option value="User">User</option>
                    <option value="Broker">Broker</option>
                </select>
            </div>

            <button class="btn btn-primary w-100 py-2 mb-3" type="submit">Sign up</button>

            <p class="text-center mb-0">Already got an account? <a href="login-page.php">Click here</a></p>
        </form>
    </main>

    <?php include("footer.php"); ?>
</body>
</html>
