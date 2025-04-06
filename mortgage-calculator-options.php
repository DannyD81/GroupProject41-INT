<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mortgage Calculator</title>

    <link rel="icon" href="logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <script src="script.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous" defer></script>
</head>
<body>
    <div class="home">
        <?php include("navbar.php"); ?>

        <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold text-body-emphasis">Mortgage Calculator</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Select your calculator.</p>
                <div class="d-flex flex-column flex-md-row gap-2 justify-content-center py-2">
                    <a href="affordability-calculator.php" class="btn btn-primary">Affordability Calculator</a>
                    <a href="repayment-calculator.php" class="btn btn-outline-secondary">Repayment Calculator</a>
                </div>
            </div>
        </div>

        <?php include("footer.php"); ?>
    </div>
</body>
</html>