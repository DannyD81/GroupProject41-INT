<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repayment Calculator</title>

    <?php include("navbar.php"); ?>

    <link rel="icon" href="logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous" defer></script>
</head>
<body>
    <?php
    $mortgage_amount = 0;
    $mortgage_term_year = 0;
    $mortgage_term_month = 0;
    $interest_rate = 0;
    $monthly_payment = 0;
    $total_repay = 0;
    $error_message = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mortgage_amount = $_POST["mortgage_amount"];
        $mortgage_term_year = $_POST["mortgage_term_year"];
        $mortgage_term_month = $_POST["mortgage_term_month"];
        $interest_rate = $_POST["interest_rate"];

        if ($mortgage_amount <= 0 || ($mortgage_term_year <= 0 && $mortgage_term_month <= 0) || $interest_rate <= 0) {
            $error_message = "Please enter valid values for all fields.";
        } else {
            $loan_term_months = ($mortgage_term_year * 12) + $mortgage_term_month;
            $monthly_interest_rate = ($interest_rate / 100) / 12;

            if ($monthly_interest_rate > 0) {
                $monthly_payment = $mortgage_amount * ($monthly_interest_rate * pow(1 + $monthly_interest_rate, $loan_term_months)) / (pow(1 + $monthly_interest_rate, $loan_term_months) - 1);
            } else {
                $monthly_payment = $mortgage_amount / $loan_term_months;
            }

            $total_repay = $monthly_payment * $loan_term_months;
        }
    }
    ?>

    <div class="container mt-5 text-center">
        <h1 class="h3 fw-bold mb-2">Repayment Calculator</h1>
        <h2 class="h4 mb-3">Fill Out Information</h2>
        <form method="POST" action="repayment-calculator.php">
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="mortgage_amount" name="mortgage_amount" placeholder="Mortgage Amount (£)" required>
                <label for="mortgage_amount">Mortgage Amount (£)</label>
            </div>
            <h2 class="h4 mb-3">Length of Mortgage</h3>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="mortgage_term_year" name="mortgage_term_year" placeholder="Mortgage Term (Years)" required>
                <label for="mortgage_term_year">Mortgage Term (Years)</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="mortgage_term_month" name="mortgage_term_month" placeholder="Mortgage Term (Months)" required>
                <label for="mortgage_term_month">Mortgage Term (Months)</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="interest_rate" name="interest_rate" placeholder="Interest Rate (%)" required>
                <label for="interest_rate">Interest Rate (%)</label>
            </div>
            <button type="submit" class="btn btn-primary text-center">Calculate</button>
        </form>

        <?php if ($error_message): ?>
            <div class="alert alert-danger mt-4">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <?php if ($monthly_payment > 0): ?>
            <div class="mt-5">
                <h3>Your Results</h3>
                <p><strong>Your monthly payment will be:</strong> £<?php echo number_format($monthly_payment, 2); ?></p>
                <p><strong>Total you’ll repay over the term:</strong> £<?php echo number_format($total_repay, 2); ?></p>
            </div>
        <?php endif; ?>
    </div>

    <div class="text-center mt-4">
        <button onclick="location.href='mortgage-calculator-options.php'" class="btn btn-secondary">Back</button>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>