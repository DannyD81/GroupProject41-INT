<?php
// Always start the session safely
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['UserID'])) {
    header("Location: login-page.php");
    exit();
}

// Connect to SQLite database
try {
    $db = new SQLite3('MortgageSystem.db', SQLITE3_OPEN_READWRITE);
} catch (Exception $e) {
    die("Database connection failed: " . htmlspecialchars($e->getMessage()));
}

$user_id = (int)$_SESSION['UserID'];

// Initialize error message
$error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $purchaseprice = $_POST['purchaseprice'] ?? null;
    $depositAmount = $_POST['depositAmount'] ?? null;

    if ($purchaseprice !== null && $depositAmount !== null && is_numeric($purchaseprice) && is_numeric($depositAmount)) {
        // Prepare and execute insert statement
        $stmt = $db->prepare("INSERT INTO UserQuotes (UserID, Purchaseprice, DepositAmount) VALUES (:user_id, :purchaseprice, :deposit_amount)");

        if (!$stmt) {
            die("Prepare failed: " . htmlspecialchars($db->lastErrorMsg()));
        }

        $stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);
        $stmt->bindValue(':purchaseprice', (float)$purchaseprice, SQLITE3_FLOAT);
        $stmt->bindValue(':deposit_amount', (float)$depositAmount, SQLITE3_FLOAT);

        $result = $stmt->execute();

        if ($result) {
            $stmt->close();
            $db->close();
            header("Location: select-products.php");
            exit();
        } else {
            $error = "Execute failed: " . htmlspecialchars($db->lastErrorMsg());
        }
    } else {
        $error = "Please enter valid numbers for both fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Mortgage</title>
    <link rel="icon" href="logo.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<?php include("navbar.php"); ?>

<main class="container text-center my-5">
    <div class="mortgage-container mx-auto" style="max-width: 500px;">
        <h1 class="h3 fw-bold mb-2">Create Mortgage</h1>
        <h2 class="h5 mb-4">Fill Out Information</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-floating mb-3">
                <input type="number" step="0.01" class="form-control" id="purchaseprice" name="purchaseprice" placeholder="Purchase Price" required>
                <label for="purchaseprice">Purchase Price</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" step="0.01" class="form-control" id="depositAmount" name="depositAmount" placeholder="Deposit Amount" required>
                <label for="depositAmount">Deposit Amount</label>
            </div>

            <button class="btn btn-primary w-100 py-2 mb-2" type="submit">Next</button>
        </form>

        <a href="logged-in-home.php" class="btn btn-outline-secondary w-100 py-2">Back</a>
    </div>
</main>

<?php include("footer.php"); ?>
</body>
</html>
