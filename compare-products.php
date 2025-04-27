<?php
session_start();

if (!isset($_SESSION['UserID'])) {
    header('Location: login-page.php');
    exit();
}

if (!isset($_POST['selected_products']) || empty($_POST['selected_products'])) {
    header('Location: select-products.php'); // No products selected
    exit();
}

$db = new SQLite3('MortgageSystem.db');
$selectedProducts = [];

$productIDs = array_map('intval', $_POST['selected_products']);
$placeholders = implode(',', array_fill(0, count($productIDs), '?'));

$stmt = $db->prepare("SELECT * FROM Products WHERE ProductsID IN ($placeholders)");
foreach ($productIDs as $index => $id) {
    $stmt->bindValue($index + 1, $id, SQLITE3_INTEGER);
}
$results = $stmt->execute();

while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $selectedProducts[] = $row;
}
$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Compare Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

<?php include("navbar.php"); ?>

<main class="container my-5">
    <h1 class="h3 mb-4 fw-bold text-center">Compare Selected Products</h1>

    <div class="row row-cols-1 row-cols-md-<?= count($selectedProducts) > 2 ? 3 : count($selectedProducts) ?> g-4">
        <?php foreach ($selectedProducts as $product): ?>
            <div class="col">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($product['Name']) ?></h5>
                        <p class="card-text">
                            <strong>Type:</strong> <?= htmlspecialchars($product['productType']) ?><br>
                            <strong>Affordability:</strong> 
                            <?php
                            $ranges = [
                                1 => "£30,000–£80,000",
                                2 => "£80,000–£130,000",
                                3 => "£130,000–£260,000",
                                4 => "£260,000–£500,000"
                            ];
                            echo isset($ranges[$product['affordabilityRange']]) ? $ranges[$product['affordabilityRange']] : "Unknown";
                            ?><br>
                            <strong>Interest Rate:</strong> <?= htmlspecialchars(number_format($product['interestRate'], 2)) ?>%
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="text-center mt-5">
        <a href="select-products.php" class="btn btn-outline-primary me-2">Select Again</a>
        <a href="logged-in-home.php" class="btn btn-secondary">Back Home</a>
    </div>

    <hr class="my-5">

    
    <div class="card p-4 shadow-sm">
        <h2 class="h5 mb-3 text-center">Save This Comparison</h2>
        
        <form method="post" action="save-comparison.php">
            <div class="mb-3">
                <label for="comparison_name" class="form-label">Comparison Name</label>
                <input type="text" class="form-control" id="comparison_name" name="comparison_name" placeholder="Enter a name for this comparison" required>
            </div>

            <?php foreach ($productIDs as $id): ?>
                <input type="hidden" name="selected_products[]" value="<?= htmlspecialchars($id) ?>">
            <?php endforeach; ?>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">Save Comparison</button>
            </div>
        </form>
    </div>
</main>

<?php include("footer.php"); ?>

</body>
</html>
