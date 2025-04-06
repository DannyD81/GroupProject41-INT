<?php
$db = new SQLite3('MortgageSystem.db');
$products = [];

try {
    $results = $db->query("SELECT ProductsID, Name FROM Products");
    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
        $products[] = $row;
    }
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Error loading products: " . $e->getMessage() . "</div>";
}
$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    
    <link rel="icon" href="logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" defer></script>
</head>
<body>
    <?php include("navbar.php"); ?>

    <main class="container text-center mortgage-container my-5">
        <h1 class="h3 mb-4 fw-bold">View Products</h1>

        <?php if (isset($_GET["deleted"])): ?>
            <div class="alert alert-success">Product deleted successfully.</div>
        <?php elseif (isset($_GET["error"])): ?>
            <div class="alert alert-danger">Failed to delete product.</div>
        <?php endif; ?>

        <div class="d-flex flex-wrap gap-2 justify-content-center mb-4">
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $index => $product): ?>
                    <a href="update-product.php?id=<?= $product['ProductsID'] ?>" class="btn <?= $index === 0 ? 'btn-primary' : 'btn-outline-secondary' ?>">
                        <?= htmlspecialchars($product['Name']) ?>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-warning">No products found.</div>
            <?php endif; ?>
        </div>

        <div>
            <a href="broker-homepage.php" class="btn btn-secondary w-100 py-2">Back</a>
        </div>
    </main>

    <?php include("footer.php"); ?>
</body>
</html>
