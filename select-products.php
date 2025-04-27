<?php
session_start();

if (!isset($_SESSION['UserID'])) {
    header('Location: login-page.php');
    exit();
}

$db = new SQLite3('MortgageSystem.db');
$products = [];

try {
    $query = "SELECT * FROM Products";
    $results = $db->query($query);

    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        $products[] = $row;
    }

    $db->close();
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Error loading products: " . htmlspecialchars($e->getMessage()) . "</div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

<?php include("navbar.php"); ?>

<main class="container my-5">
    <h1 class="h3 mb-4 fw-bold text-center">Select Products</h1>

    <form action="compare-products.php" method="post">
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <div class="card" style="width: 18rem;">
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
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="selected_products[]" value="<?= $product['ProductsID'] ?>" id="product<?= $product['ProductsID'] ?>">
                                <label class="form-check-label" for="product<?= $product['ProductsID'] ?>">
                                    Select
                                </label>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-warning">No products available.</div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Compare Selected Products</button>
        </div>
    </form>

    <div class="text-center mt-3">
        <a href="logged-in-home.php" class="btn btn-secondary">Back</a>
    </div>
</main>

<?php include("footer.php"); ?>

</body>
</html>
