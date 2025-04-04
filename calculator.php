<?php
$loan_amount = 0;
$deposit = 0;
$loan_term = 0;
$interest_rate = 0;
$monthly_payment = 0;
$total_repay = 0;
$capital = 0;
$interest = 0;
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $mortgage_amount = $_POST["mortgage_amount"];
    $mortgage_term_year = $_POST["mortgage_term_year"];
    $mortgage_term_month = $_POST["mortgage_term_month"];
    $interest_rate = $_POST["interest_rate"];

    
    if ($loan_amount <= 0 || $deposit < 0 || $loan_term <= 0 || $interest_rate <= 0) {
        $error_message = "Please enter valid values for all fields.";
    } else {
        
        $loan_amount_after_deposit = $loan_amount - $deposit;
        $monthly_interest_rate = ($interest_rate / 100) / 12;
        $total_payments = $loan_term * 12;

    
        $monthly_payment = $loan_amount_after_deposit * ($monthly_interest_rate * pow(1 + $monthly_interest_rate, $total_payments)) / (pow(1 + $monthly_interest_rate, $total_payments) - 1);

        
        $total_repay = $monthly_payment * $total_payments;

        
        $capital = $loan_amount_after_deposit;
        $interest = $total_repay - $capital;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affordability Calculator</title>
    
    <?php include("navbar.php"); ?> 
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>
<body>

    
    <h2> Mortgage Calculator</h2> 

    <div class="container mt-5">
        <h2>Enter Loan Details</h2>
        <form method="POST" action="calculator.php">
            <div class="mb-3">
                <label for="mortgage_amount" class="form-label">Mortgage Amount (£)</label>
                <input type="number" class="form-control" id="mortgage_amount" name="mortgage_amount" value="<?php echo htmlspecialchars($mortgage_amount); ?>" required>
            </div>
            <h3>Length of Mortgage</h3>

            <div class="mb-3">
                <label for="mortgage_term_year" class="form-label">Mortgage Term (years) </label>
                <input type="number" class="form-control" id="mortgage_term_year" name="mortgage_term_year" value="<?php echo htmlspecialchars($mortgage_term_year); ?>" required>
            </div>

            <div class="mb-3">
                <label for="mortgage_term_month" class="form-label">Mortgage Term (Monthly)</label>
                <input type="number" class="form-control" id="mortgage_term_month" name="mortgage_term_month" value="<?php echo htmlspecialchars($mortgage_term_month); ?>" required>
            </div>

            <div class="mb-3">
                <label for="interest_rate" class="form-label">Interest Rate (%)</label>
                <input type="number" class="form-control" id="interest_rate" name="interest_rate" value="<?php echo htmlspecialchars($interest_rate); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>

        <?php if ($error_message): ?>
            <div class="alert alert-danger mt-4">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        
        <?php if ($monthly_payment > 0): ?>
            <div class="mt-5">
                <h3>Your results</h3>
                <p><strong>Your monthly payment will be:</strong> £<?php echo number_format($monthly_payment, 2); ?></p>
                <p><strong>Total you’ll repay over the term:</strong> £<?php echo number_format($total_repay, 2); ?></p>
                <h4>Make sure you can afford it!</h4>
                <p><strong>For example, if your interest rate goes up by 3%, your payment will be:</strong></p>
                <?php
                $new_interest_rate = $interest_rate + 3;
                $new_monthly_payment = ($loan_amount - $deposit) * (($new_interest_rate / 100 / 12) * pow(1 + ($new_interest_rate / 100 / 12), $total_payments)) / (pow(1 + ($new_interest_rate / 100 / 12), $total_payments) - 1);
                ?>
                <p>£<?php echo number_format($new_monthly_payment, 2); ?> per month</p>
            </div>
        <?php endif; ?>
    </div>
    <center>
            <div class="nav-buttons">
            <button onclick="location.href='index.php'">Back</button>
            </center>

    <?php include("footer.php"); ?> <!-- Include your footer here -->

</body>
</html>
