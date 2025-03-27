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
    <?php include("loggedinnavbar.php"); ?>

    <main class="container text-center mortgage-container my-5">
        <h1 class="h3 mb-4 fw-bold">View Products</h1>

        <div class="d-flex gap-2 justify-content-center mb-4">
            <a href="update-product.php" class="btn btn-primary">Product 1</a>
            <a href="update-product.php" class="btn btn-outline-secondary">Product 2</a>
            <a href="update-product.php" class="btn btn-outline-secondary">Product 3</a>
        </div>

        <div>
            <a href="broker-homepage.php" class="btn btn-secondary w-100 py-2">Back</a>
        </div>
    </main>

    <?php include("footer.php"); ?>
</body>
</html>
