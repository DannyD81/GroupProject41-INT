<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Saved Mortgages</title>

    <link rel="icon" href="logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <?php include("navbar.php"); ?>

    <main class="container text-center mortgage-container my-5">
        <h1 class="h3 fw-bold mb-4">View Saved Mortgages</h1>

        <div class="d-flex flex-column flex-md-row gap-2 justify-content-center mb-4">
            <a href="compare-saved-mortgages.php" class="btn btn-primary">Quote 1</a>
            <a href="compare-saved-mortgages.php" class="btn btn-outline-secondary">Quote 2</a>
            <a href="compare-saved-mortgages.php" class="btn btn-outline-secondary">Quote 3</a>
        </div>

        <a href="logged-in-home.php" class="btn btn-secondary w-100 py-2">Back</a>
    </main>

    <?php include("footer.php"); ?>
</body>
</html>