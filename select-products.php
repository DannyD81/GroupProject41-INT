<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Products</title>

    <link rel="icon" href="logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <?php include("navbar.php"); ?>

    <main class="container text-center mortgage-container my-5">
        <h1 class="h3 fw-bold mb-2">Create Mortgage</h1>
        <h2 class="h5 mb-4">Select up to 3 quotes</h2>

        <form id="mortgageForm">
            <div class="row g-3 justify-content-center">
                <div class="col-md-6 d-flex align-items-center">
                    <button type="button" class="btn btn-light w-100">Mortgage 1</button>
                    <input type="checkbox" class="form-check-input ms-2 mortgage-checkbox">
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <button type="button" class="btn btn-light w-100">Mortgage 4</button>
                    <input type="checkbox" class="form-check-input ms-2 mortgage-checkbox">
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <button type="button" class="btn btn-light w-100">Mortgage 2</button>
                    <input type="checkbox" class="form-check-input ms-2 mortgage-checkbox">
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <button type="button" class="btn btn-light w-100">Mortgage 5</button>
                    <input type="checkbox" class="form-check-input ms-2 mortgage-checkbox">
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <button type="button" class="btn btn-light w-100">Mortgage 3</button>
                    <input type="checkbox" class="form-check-input ms-2 mortgage-checkbox">
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <button type="button" class="btn btn-light w-100">Mortgage 6</button>
                    <input type="checkbox" class="form-check-input ms-2 mortgage-checkbox">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary w-100 py-2">Compare Mortgage Quotes</button>
                <a href="create-quote.php" class="btn btn-outline-secondary w-100 py-2 mt-2">Back</a>
            </div>
        </form>
    </main>

    <script>
        document.getElementById("mortgageForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const selected = document.querySelectorAll(".mortgage-checkbox:checked");

            if (selected.length > 3) {
                alert("You can only select up to 3 mortgages.");
            } else if (selected.length === 0) {
                alert("Please select at least one mortgage.");
            } else {
                window.location.href = "compare-mortgages.php";
            }
        });
    </script>

    <?php include("footer.php"); ?>
</body>
</html>