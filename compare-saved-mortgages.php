<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['UserID'])) {
    header("Location: login-page.php");
    exit();
}

$db = new SQLite3('MortgageSystem.db');

// Get saved comparisons for this user
$user_id = $_SESSION['UserID'];

$stmt = $db->prepare("SELECT * FROM Comparisons WHERE UserID = :UserID ORDER BY created_at DESC");
$stmt->bindValue(':UserID', $user_id, SQLITE3_INTEGER);
$results = $stmt->execute();

$savedComparisons = [];
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $savedComparisons[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saved Comparisons</title>

    <link rel="icon" href="logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include("navbar.php"); ?>

<main class="container my-5">
    <h1 class="h3 mb-4 text-center fw-bold">Your Saved Mortgage Comparisons</h1>

    <?php if (count($savedComparisons) > 0): ?>
        <div class="row">
            <?php foreach ($savedComparisons as $comparison): ?>
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($comparison['ComparisonName']) ?></h5>
                            <p class="card-text">
                                <?php
                                // Get product names based on IDs
                                $productIDs = explode(',', $comparison['ProductIDs']);
                                foreach ($productIDs as $productID) {
                                    $productID = intval($productID);
                                    $productQuery = $db->prepare("SELECT Name FROM Products WHERE ProductsID = :id");
                                    $productQuery->bindValue(':id', $productID, SQLITE3_INTEGER);
                                    $productResult = $productQuery->execute()->fetchArray(SQLITE3_ASSOC);
                                    if ($productResult) {
                                        echo "<span class='badge bg-primary m-1'>" . htmlspecialchars($productResult['Name']) . "</span>";
                                    }
                                }
                                ?>
                            </p>
                            <p class="text-muted small mb-2">Saved on: <?= htmlspecialchars($comparison['created_at']) ?></p>

                            <!-- New View Comparison Button -->
                            <form action="view-comparison-details.php" method="post">
                                <input type="hidden" name="comparison_id" value="<?= htmlspecialchars($comparison['ComparisonID']) ?>">
                                <button type="submit" class="btn btn-outline-primary btn-sm">View Comparison</button>
                            </form>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">You have no saved comparisons yet.</div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="logged-in-home.php" class="btn btn-secondary">Back to Home</a>
    </div>
</main>

<?php include("footer.php"); ?>
</body>
</html>
