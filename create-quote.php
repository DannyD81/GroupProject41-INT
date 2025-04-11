<?php
session_start();
$db = new SQLite3('MortgageSystem.db');
if (!$db) {
    die("Database connection failed.");
}


if (!isset($_SESSION['UserID'])) {
    header("Location: login-page.php");
    exit();
}

$user_id = $_SESSION['UserID'];


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $purchaseprice = $_POST['purchaseprice'] ?? null;
    $depositAmount = $_POST['depositAmount'] ?? null;

    if (!empty($purchaseprice) && !empty($depositAmount)) {
        // Insert into UserQuotes table
        $stmt = $db->prepare("INSERT INTO UserQuotes (UserID, Purchaseprice, DepositAmount) VALUES (:user_id, :purchaseprice, :deposit_amount)");
        $stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);
        $stmt->bindValue(':purchaseprice', $purchaseprice, SQLITE3_FLOAT);
        $stmt->bindValue(':deposit_amount', $depositAmount, SQLITE3_FLOAT);

        if ($stmt->execute()) {
            header("Location: select-products.php"); // success page or next step
            exit();
        } else {
            echo "<div class='alert alert-danger text-center'>Failed to save quote. Try again.</div>";
        }
    } else {
        echo "<div class='alert alert-warning text-center'>All fields are required.</div>";
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

            <form method="POST" action="create-quote.php">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="purchaseprice" name="purchaseprice" placeholder="Purchase price" required>
                    <label for="purchaseprice">Purchase Price</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="depositAmount" name="depositAmount" placeholder="Deposit Amount" required>
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
