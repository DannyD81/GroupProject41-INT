<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Mortgage</title>

    <link rel="icon" href="logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <?php include("loggedinnavbar.php"); ?>

    <main class="container text-center my-5">
        <div class="mortgage-container mx-auto" style="max-width: 500px;">
            <h1 class="h3 fw-bold mb-2">Create Mortgage</h1>
            <h2 class="h5 mb-4">Fill Out Information</h2>

            <form id="mortgageForm">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="propertyValue" placeholder="Property Value" required>
                    <label for="propertyValue">Property Value</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="depositAmount" placeholder="Deposit Amount" required>
                    <label for="depositAmount">Deposit Amount</label>
                </div>

                <button class="btn btn-primary w-100 py-2 mb-2" type="submit">Next</button>
            </form>

            <a href="logged-in-home.php" class="btn btn-outline-secondary w-100 py-2">Back</a>
        </div>
    </main>

    <script>
        document.getElementById("mortgageForm").addEventListener("submit", function(event) {
            event.preventDefault();
            window.location.href = "select-products.php";
        });
    </script>

    <?php include("footer.php"); ?>
</body>
</html>
