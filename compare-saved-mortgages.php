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
    $product1 = $_POST['product1'] ?? null;
    $product2 = $_POST['product2'] ?? null;

    if (!empty($product1) && !empty($product2)) {
        $stmt = $db->prepare("INSERT INTO SavedComparisons (UserID, Product1, Product2, DateSaved) VALUES (:user_id, :product1, :product2, :date_saved)");
        $stmt->bindValue(':user_id', $user_id, SQLITE3_INTEGER);
        $stmt->bindValue(':product1', $product1, SQLITE3_TEXT);
        $stmt->bindValue(':product2', $product2, SQLITE3_TEXT);
        $stmt->bindValue(':date_saved', date('Y-m-d H:i:s'), SQLITE3_TEXT);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success text-center'>Comparison saved successfully!</div>";
        } else {
            echo "<div class='alert alert-danger text-center'>Failed to save comparison. Try again.</div>";
        }
    } else {
        echo "<div class='alert alert-warning text-center'>Both products must be selected.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Save Comparison</title>
    <link rel="icon" href="logo.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <?php include("navbar.php"); ?>

    <main class="container text-center my-5">
        <div class="mortgage-container mx-auto" style="max-width: 500px;">
            <h1 class="h3 fw-bold mb-2">Save Comparison</h1>
            <h2 class="h5 mb-4">Compare Mortgage Products</h2>

            <form method="POST" action="save-comparison.php">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="product1" name="product1" placeholder="Product 1" required>
                    <label for="product1">Product 1</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="product2" name="product2" placeholder="Product 2" required>
                    <label for="product2">Product 2</label>
                </div>

                <button class="btn btn-primary w-100 py-2 mb-2" type="submit">Save Comparison</button>
            </form>

            <a href="logged-in-home.php" class="btn btn-outline-secondary w-100 py-2">Back</a>
        </div>
    </main>

    <?php include("footer.php"); ?>
</body>
</html>
