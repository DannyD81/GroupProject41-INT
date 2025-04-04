<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compare Mortgages</title>
    
    <link rel="icon" href="logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" defer></script>
</head>
<body>
    <?php include("loggedinnavbar.php"); ?>

    <main class="container text-center mortgage-container">
        <h1 class="h3 fw-bold mb-3">View Quotes</h1>

        <div class="row justify-content-center g-4">
            <div class="col-md-3">
                <div class="quote-box">
                    <div class="quote-title">Quote 1</div>
                    <div class="quote-text">
                        Sample interest rate: 3.5%<br>
                        Term: 25 years<br>
                        Monthly repayment: £850
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="quote-box">
                    <div class="quote-title">Quote 2</div>
                    <div class="quote-text">
                        Sample interest rate: 3.2%<br>
                        Term: 20 years<br>
                        Monthly repayment: £910
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="quote-box">
                    <div class="quote-title">Quote 3</div>
                    <div class="quote-text">
                        Sample interest rate: 3.8%<br>
                        Term: 30 years<br>
                        Monthly repayment: £790
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-2">
            <a href="select-saved-mortgages.php" class="mt-3">
                <button class="btn btn-secondary w-100 py-2">Back</button>
            </a>
        </div>
    </main>

    <?php include("footer.php"); ?>
</body>
</html>